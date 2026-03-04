<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/src/usuario_crud.php';

$id = $_GET['id'] ?? null;
if (!$id){
    header('Location: lista.php');
    exit;
}
$dadosUsuario = buscarUsuarioPorId($conexao, $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if(editarUsuario($conexao, $id, $nome, $email, $senha)) {
        header('Location: listar.php?status=atualizado');
        exit();
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar o usuário.</div>";
    }
}


$titulo = "Editar Usuário |";
require_once BASE_PATH . '/includes/cabecalho.php';
?>

<section class="mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3 class="text-center"><i class="bi bi-pencil-fill"></i> Editar Usuário</h3>



    <form method="post" class="w-75 mx-auto">
    <input type="hidden" name="id" value="<?= $dadosUsuario['id'] ?>">

    <div class="form-group">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" name="nome" class="form-control" id="nome" value="<?= $dadosUsuario['nome'] ?>">
    </div>

    <div class="form-group">
        <label for="email" class="form-label">E-mail:</label>
        <input type="email" name="email" class="form-control" id="email" value="<?= $dadosUsuario['email'] ?>">
    </div>

    <div class="form-group">
        <label for="senha" class="form-label">Senha:</label>
        <input type="password" name="senha" class="form-control" id="senha" placeholder="Preencha apenas se for alterar">
        <small class="text-muted">Deixe em branco para manter a senha atual.</small>
    </div>

    <button class="btn btn-warning my-4" type="submit">
        <i class="bi bi-arrow-clockwise"></i> Salvar Alterações
    </button>
    <a href="listar.php" class="btn btn-light my-4">Cancelar</a>
</form>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>