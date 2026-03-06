<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/src/usuario_crud.php';

// 1. Captura o ID da URL
$id = $_GET['id'] ?? null;

// Se não houver ID, volta para a lista imediatamente
if (!$id) {
    header("Location: listar.php");
    exit;
}

$usuario = buscarUsuarioPorId($conexao, $id);

// SÓ EXCLUI SE existir o parâmetro 'confirmar' na URL
if (isset($_GET['confirmar'])) {
    // 2. Chama a função de exclusão passando o ID
    if (excluirUsuario($conexao, $id)) {
        header("Location: listar.php?status=excluido");
        exit;
    } else {
        die("Erro ao tentar excluir o usuário.");
    }
}

$titulo = "Excluir Usuário |";
require_once BASE_PATH . '/includes/cabecalho.php';
?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-trash3-fill"></i> Excluir Usuário</h3>

    <div class="alert alert-danger w-50 text-center mx-auto">
        <p>Deseja realmente excluir o usuário <strong class="text-dark"><?= $usuario['nome'] ?></strong>?</p>
        <a href="listar.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> Não</a>
        <a href="?id=<?= $id ?>&confirmar=true" class="btn btn-danger"><i class="bi bi-check-circle"></i> Sim</a>
    </div>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>