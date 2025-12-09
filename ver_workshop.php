<?php
// ---------------------------------------------------------------------
// 1. BACK-END: PROTEÇÃO, CONEXÃO E BUSCA DE DADOS (1:N)
// ---------------------------------------------------------------------

session_start();

// 1. VERIFICAÇÃO DE AUTENTICAÇÃO
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'db/conexao.php'; 

$workshop = null;
$aulas = [];
$erro = null;

// 2. OBTÉM O ID DO WORKSHOP DA URL
$id_workshop = $_GET['id'] ?? null;

if (!filter_var($id_workshop, FILTER_VALIDATE_INT)) {
    $erro = "ID do workshop inválido.";
} else {
    try {
        // A. BUSCA DO WORKSHOP PRINCIPAL 
        $sql_workshop = "SELECT id_workshop, titulo, descricao, data_inicio, preco FROM workshops WHERE id_workshop = ?";
        $stmt_workshop = $pdo->prepare($sql_workshop);
        $stmt_workshop->execute([$id_workshop]);
        $workshop = $stmt_workshop->fetch(PDO::FETCH_ASSOC);

        if (!$workshop) {
            $erro = "Workshop não encontrado.";
        } else {
            // B. BUSCA DAS AULAS RELACIONADAS 
            $sql_aulas = "SELECT titulo, descricao, link_video FROM aulas WHERE id_workshop = ? ORDER BY id_aula ASC";
            $stmt_aulas = $pdo->prepare($sql_aulas);
            $stmt_aulas->execute([$id_workshop]);
            $aulas = $stmt_aulas->fetchAll(PDO::FETCH_ASSOC);
        }

    } catch (PDOException $e) {
        $erro = "Erro ao carregar detalhes do workshop.";
    }
}

$titulo_pagina = $workshop ? $workshop['titulo'] : 'Detalhes do Workshop';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARTSY - <?= htmlspecialchars($titulo_pagina) ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light-subtle">

    <nav class="navbar navbar-expand-lg navbar-dark bg-artsy-red shadow">
        <div class="container">
            <a class="navbar-brand h1 fw-bold fs-3 text-white" href="dashboard.php">ARTSY</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <span class="navbar-text text-white me-3 fw-bold">Olá, <?= explode(' ', $_SESSION['user_name'])[0] ?>!</span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark fw-bold rounded-0" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        
        <?php if ($erro): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= htmlspecialchars($erro) ?>
            </div>
            <p class="text-center"><a href="dashboard.php" class="text-artsy-red">← Voltar para a Dashboard</a></p>
        
        <?php elseif ($workshop): ?>
            
            <div class="row mb-5 border-bottom border-dark pb-4">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold text-dark mb-3"><?= htmlspecialchars($workshop['titulo']) ?></h1>
                    
                    <p class="lead text-secondary fs-5">
                        <?= nl2br(htmlspecialchars($workshop['descricao'])) ?>
                    </p>
                    
                    <p class="h4 mt-4 fw-bold text-artsy-red">
                        R$ <?= number_format($workshop['preco'], 2, ',', '.') ?>
                        <span class="fs-6 fw-normal text-dark ms-3">
                            (Início: <?= date('d/m/Y', strtotime($workshop['data_inicio'])) ?>)
                        </span>
                    </p>
                    
                    <button class="btn btn-hero mt-3" style="border: 2px solid #BF0000; padding: 10px 40px; border-radius: 5px;">
                        INSCREVA-SE AGORA
                    </button>
                </div>
                
                <div class="col-lg-4 text-center d-none d-lg-block">
                     <div class="card p-4 card-block h-100">
                        <h4 class="text-dark">ID do Curso: <?= $workshop['id_workshop'] ?></h4>
                        <p class="text-secondary small">Este bloco pode ser usado para uma imagem ou vídeo de introdução.</p>
                     </div>
                </div>
            </div>

            <h2 class="h3 fw-bold mb-4 text-dark">Módulos e Aulas</h2>
            
            <?php if (count($aulas) > 0): ?>
                
                <div class="accordion" id="accordionAulas">
                    <?php $contador = 1; ?>
                    <?php foreach ($aulas as $aula): ?>
                        <div class="accordion-item card-block mb-2">
                            <h2 class="accordion-header" id="heading<?= $contador ?>">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $contador ?>" aria-expanded="false" aria-controls="collapse<?= $contador ?>">
                                    Aula <?= $contador ?>: <?= htmlspecialchars($aula['titulo']) ?>
                                </button>
                            </h2>
                            <div id="collapse<?= $contador ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $contador ?>" data-bs-parent="#accordionAulas">
                                <div class="accordion-body text-secondary">
                                    <p><?= nl2br(htmlspecialchars($aula['descricao'])) ?></p>
                                    <?php if (!empty($aula['link_video'])): ?>
                                        <a href="<?= htmlspecialchars($aula['link_video']) ?>" target="_blank" class="text-artsy-red fw-bold text-decoration-none">
                                            Acessar Vídeo da Aula →
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php $contador++; ?>
                    <?php endforeach; ?>
                </div>

            <?php else: ?>
                <div class="alert alert-warning">Nenhuma aula cadastrada para este workshop ainda.</div>
            <?php endif; ?>
            
            <p class="text-center mt-5"><a href="dashboard.php" class="text-artsy-red fw-bold text-decoration-none">← Voltar para a Lista de Workshops</a></p>

        <?php endif; // Fim do bloco principal de exibição ?>
        
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>