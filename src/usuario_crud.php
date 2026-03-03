<?php

    // Função para buscar os usuários no banco de dados
    function buscarUsuario(PDO $conexao) {
        // Busca os usuários no banco de dados
        $sql = "SELECT id, nome, email FROM usuarios ORDER BY nome";

        // Prepara e executa a consulta SQL para buscar os usuários
        $consulta = $conexao->prepare($sql);

        // Executa a consulta SQL para buscar os usuários no banco de dados e retorna o resultado 
        $consulta->execute();
    }