<?php

try {
    // String de Conexão 
    $dsn = "pgsql:host=$host;dbname=$dbname";
    
    // Cria a instância de PDO
    $pdo = new PDO($dsn, $user, $password);
    
    // Define o modo de erro para exceções, o que facilita a depuração
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Interrompe a execução e exibe um erro 
    die("Desculpe, a conexão com o banco de dados falhou.");
}

?>