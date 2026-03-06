<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/src/fornecedor_crud.php';

$fornecedores = buscarFornecedor($conexao); // Chama a função para buscar os fornecedores do banco de dados

$titulo = "Fornecedores |";
require_once BASE_PATH . '/includes/cabecalho.php';
?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3><i class="bi bi-people-fill"></i> Lista de Fornecedores</h3>

    <?php
    if (isset($_GET['status'])) :
        $mensagem = '';
        $classe = 'alert-success';

        switch ($_GET['status']) {
            case 'excluido':
                $mensagem = 'Fornecedor removido com sucesso!';
                $classe = 'alert-danger'; // Vermelho para exclusão
                break;
            case 'atualizado':
                $mensagem = 'Dados atualizados com sucesso!';
                break;
            case 'sucesso':
                $mensagem = 'Novo fornecedor cadastrado!';
                break;
        }
    
    ?>
        <div class="alert <?= $classe ?> alert-dismissible fade show w-75 mx-auto mb-4" role="alert">
            <i class="bi bi-info-circle"></i> <?= $mensagem ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <p class="text-center my-4">
        <a href="inserir.php" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Adicionar Novo Fornecedor</a>
    </p>

    <div class="table-responsive">
        <table class="table table-hover align-middle caption-top">
            <caption>Quantidade de registros: <?= count($fornecedores) ?></caption>
            <thead class="align-middle table-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fornecedores as $fornecedor) : ?>
                    <tr>
                        <td><?= $fornecedor['id'] ?></td>
                        <td><?= $fornecedor['nome'] ?></td>
                        <td class="text-end">
                            <a class="btn btn-warning btn-sm" href="editar.php?id=<?= $fornecedor['id'] ?>"><i class="bi bi-pencil-square"></i> Editar</a>
                        </td>
                        <td class="text-start">
                            <a class="btn btn-danger btn-sm" href="excluir.php?id=<?= $fornecedor['id'] ?>"><i class="bi bi-trash"></i> Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>