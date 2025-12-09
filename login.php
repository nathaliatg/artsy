<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARTSY - Login</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;900&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-light-subtle">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    ' -->
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
        
        <h1 class="display-1 text-center mb-4 text-artsy-red">ARTSY</h1>
        
        <div class="card p-4 card-block">
            <h2 class="h3 mb-4 text-center">Fazer Login</h2>
            
            <form action="login.php" method="POST">
                
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                
                <div class="mb-4">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-artsy btn-lg">Entrar</button>
                </div>
            </form>
            
            <hr class="mt-4 mb-3">
            
            <p class="text-center mb-0">
                Não tem conta? <a href="cadastro.php" class="text-artsy-red text-decoration-none fw-bold">Crie uma agora</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>