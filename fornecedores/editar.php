<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/src/fornecedor_crud.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: listar.php');
    exit;
}

$dadosFornecedor = buscarFornecedorPorId($conexao, $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    if (editarFornecedor($conexao, $id, $nome)) {
       header('Location: listar.php?status=atualizado');
        exit();
        
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar o fornecedor.</div>";
    }
}

$titulo = "Editar Fornecedor |";
require_once BASE_PATH . '/includes/cabecalho.php';
?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Fornecedor</h3>


    <form method="post" class="w-75 mx-auto">
        <input type="hidden" name="id" value="<?= $dadosFornecedor['id'] ?>">
        <div class="form-group">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" class="form-control" id="nome" value="<?= $dadosFornecedor['nome'] ?>">
        </div>
        <button class="btn btn-warning my-4" type="submit"><i class="bi bi-arrow-clockwise"></i> Salvar Alterações</button>
        <a href="listar.php" class="btn btn-light my-4">Cancelar</a>
    </form>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>