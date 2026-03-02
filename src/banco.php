<?php
$servidor = "localhost";
$usuario = "root";
$senha = "root";
$banco = "estoque";

// Conexão com o banco de dados usando PDO
try {
    $conexao = new PDO("mysql:host=$servidor; dbname=$banco; charset=utf8", $usuario,$senha);

    // Configura o modo de erro do PDO para exceção
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Configura o modo de busca padrão para associativo
    $conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //echo "conexao bem sucedida";

} catch (\Throwable $erro) {

    // Exibe uma mensagem genérica para o usuário
    die("Erro ao conectar ao banco de dados: " . $erro->getMessage());

}


