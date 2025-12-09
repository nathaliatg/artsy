<?php
// ---------------------------------------------------------------------
// 1. BACK-END: PROTEÇÃO, CONEXÃO E LEITURA (SELECT)
// ---------------------------------------------------------------------

// Inicia a sessão (essencial para o login)
session_start();

// VERIFICAÇÃO DE AUTENTICAÇÃO 
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// CONEXÃO COM O BANCO DE DADOS
require_once 'db/conexao.php'; 

$nome_usuario = $_SESSION['user_name'];
$nivel_acesso = $_SESSION['nivel_acesso'];
$workshops = []; // Array para armazenar os resultados
$erro_bd = null;

// BUSCA DOS WORKSHOPS (Operação SELECT)
try {
    // Usando PDO para buscar todos os workshops
    $sql = "SELECT id_workshop, titulo, descricao, preco FROM workshops ORDER BY data_inicio DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    // Armazena todos os resultados
    $workshops = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Em caso de erro, define uma mensagem 
    $erro_bd = "Erro ao carregar a lista de workshops. Por favor, tente novamente mais tarde.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARTSY - Dashboard</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light-subtle">

    <nav class="navbar navbar-expand-lg navbar-dark bg-artsy-red shadow">
        <div class="container">
            <a class="navbar-brand h1 fw-bold fs-3 text-white" href="dashboard.php">ARTSY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    
                    <?php if ($nivel_acesso === 'admin'): ?>
                        <li class="nav-item">
                            <a class="btn btn-outline-light ms-2 me-3 fw-bold border-0" href="admin/crud_workshops.php" style="background-color: rgba(255, 255, 255, 0.1);">
                                Gerenciar Cursos
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <li class="nav-item">
                        <span class="navbar-text text-white me-3 fw-bold">
                            Olá, **<?= explode(' ', $nome_usuario)[0] ?>**!
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark fw-bold rounded-0" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="display-5 text-artsy-red fw-bold">
                Workshops Disponíveis
            </h1>
        </div>
        
        <section id="lista-workshops" class="row g-4">
            
            <?php if (isset($erro_bd)): ?>
                <div class="col-12">
                    <div class="alert alert-danger text-center" role="alert"><?= $erro_bd ?></div>
                </div>
            
            <?php elseif (count($workshops) > 0): ?>
                
                <?php foreach ($workshops as $workshop): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-block h-100">
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-dark">
                                    <?= htmlspecialchars($workshop['titulo']) ?>
                                </h5>
                                <p class="card-text text-secondary">
                                    <?= htmlspecialchars(substr($workshop['descricao'], 0, 100)) ?>...
                                </p>
                                <p class="text-end fw-bold mb-2 text-artsy-red">
                                    R$ <?= number_format($workshop['preco'], 2, ',', '.') ?>
                                </p>
                                <div class="d-grid">
                                    <a href="ver_workshop.php?id=<?= $workshop['id_workshop'] ?>" class="btn-artsy text-dark text-decoration-none fw-bold">
                                        Ver Detalhes e Aulas →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        Nenhum workshop encontrado no momento.
                    </div>
                </div>
            <?php endif; ?>
            
        </section>
    </main>
    
    <footer class="text-center py-2 bg-white border-top border-dark mt-5">
        <small class="text-secondary">&copy; 2025 ARTSY. Feito com criatividade.</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>