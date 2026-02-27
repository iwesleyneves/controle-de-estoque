<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "estoque";

// Conexão com o banco de dados usando PDO
try {
    $conexao = new PDO("
    mysql:host=$servidor; 
    dbname=$banco;
    charset=utf8",
    $usuario,
    $senha);

    // Configura o modo de erro do PDO para exceção
} catch (\Throwable $erro) {
    // Exibe a mensagem de erro e encerra o script
    echo "Erro ao conectar ao banco de dados: " . $erro->getMessage();
    exit;
}
