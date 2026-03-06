<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/src/fornecedor_crud.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];

    if (inserirFornecedor($conexao, $nome)) {
        header('Location: listar.php?status=sucesso');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Erro ao adicionar o fornecedor.</div>";
    }
}

$titulo = "Adicionar Fornecedor |";
require_once BASE_PATH . '/includes/cabecalho.php';
?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-plus-circle-fill"></i> Adicionar Fornecedor</h3>


    <form method="post" class="w-75 mx-auto">
        <div class="form-group">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" class="form-control" id="nome">
        </div>
        <button class="btn btn-success my-4" type="submit"><i class="bi bi-check-circle"></i> Salvar</button>
    </form>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>