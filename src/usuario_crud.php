<?php

    // Função para buscar os usuários no banco de dados
    function buscarUsuario(PDO $conexao) {
        // Busca os usuários no banco de dados
        $sql = "SELECT id, nome, email FROM usuarios ORDER BY nome";

        // Prepara e executa a consulta SQL para buscar os usuários
        $consulta = $conexao->prepare($sql);

        // Executa a consulta SQL para buscar os usuários no banco de dados 
        $consulta->execute();

        // Retorna os usuários encontrados no banco de dados como um array associativo
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    
    }

    // Função para inserir um novo usuário no banco de dados
    // Recebe a conexão com o banco de dados, o nome, o email e a senha do usuário como parâmetros
    function inserirUsuario(PDO $conexao, $nome, $email, $senha) {
        
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        // Insere um novo usuário no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        
        // Prepara a consulta SQL para inserir um novo usuário no banco de dados
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(':nome', $nome);
        $consulta->bindValue(':email', $email);
        $consulta->bindValue(':senha', $senha);

        // Executa a consulta SQL para inserir um novo usuário no banco de dados
        // Retorna o resultado da execução da consulta SQL para inserir um novo usuário no banco de dados
        return $consulta->execute();
    }

    // Função para editar um usuário existente no banco de dados
    function editarUsuario(PDO $conexao, $id, $nome, $email, $senha) {
       
        // Edita um usuário existente no banco de dados
        $sql = "UPDATE usuarios SET nome = :nome, email = :email";

        // Verifica se a senha foi preenchida para decidir se deve atualizar a senha do usuário ou não
        if (!empty($senha)) {
            $hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql .= ", senha = :senha";
        }

        // Adiciona a cláusula WHERE para identificar o usuário a ser editado no banco de dados
        $sql .= " WHERE id = :id";

        // Prepara a consulta SQL para editar um usuário existente no banco de dados
        $consulta = $conexao->prepare($sql);
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);
        $consulta->bindValue(':nome', $nome);
        $consulta->bindValue(':email', $email);

        // Verifica se a senha foi preenchida para decidir se deve atualizar a senha do usuário ou não
        if (!empty($senha)) {
            $consulta->bindValue(':senha', $hash);
        }

        // Executa a consulta SQL para editar um usuário existente no banco de dados
        // Retorna o resultado da execução da consulta SQL para editar um usuário existente no banco de dados
        return $consulta->execute();
    }

    // funcao para buscar um usuário específico no banco de dados pelo ID
    function buscarUsuarioPorId(PDO $conexao, $id) {
    // Busca um usuário específico no banco de dados pelo ID
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    // Prepara e executa a consulta SQL para buscar um usuário específico no banco de dados pelo ID
    $consulta = $conexao->prepare($sql);
    // Vincula o valor do ID à consulta SQL para buscar um usuário específico no banco de dados pelo ID
    $consulta->bindValue(':id', $id);
    $consulta->execute();

    // Retorna o usuário encontrado no banco de dados como um array associativo
    return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    // Função para excluir um usuário do banco de dados pelo ID
    function excluirUsuario(PDO $conexao, $id) {

        // Exclui um usuário do banco de dados pelo ID
        $sql = "DELETE FROM usuarios WHERE id = :id";

        // Prepara e executa a consulta SQL para excluir um usuário do banco de dados pelo ID
        $consulta = $conexao->prepare($sql);

        // Vincula o valor do ID à consulta SQL para excluir um usuário do banco de dados pelo ID
        $consulta->bindValue(':id', $id, PDO::PARAM_INT);

        // Executa a consulta SQL para excluir um usuário do banco de dados pelo ID
        // Retorna o resultado da execução da consulta SQL para excluir um usuário do banco de dados
        return $consulta->execute();
    }