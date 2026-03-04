<?php
require_once __DIR__ . '/../config.php';
require_once BASE_PATH . '/src/usuario_crud.php';

$usuarios = buscarUsuario($conexao); // Chama a função para buscar os usuários do banco de dados

$titulo = "Usuários |";
require_once BASE_PATH . '/includes/cabecalho.php';
?>

<section class="text-center mb-4 border rounded-3 p-4 border-primary-subtle">
    <h3><i class="bi bi-person-gear"></i> Gerenciar Usuários</h3>

    <!-- Exibe mensagens de status com base no parâmetro 'status' na URL -->
    <?php
    if (isset($_GET['status'])) :
        $mensagem = "";
        $classe = "alert-success";

        switch ($_GET['status']) {
            case 'excluido':
                $mensagem = "Usuário removido com sucesso!";
                $classe = "alert-danger"; // Vermelho para exclusão
                break;
            case 'atualizado':
                $mensagem = "Dados atualizados com sucesso!";
                break;
            case 'sucesso':
                $mensagem = "Novo usuário cadastrado!";
                break;
        }
    ?>
        <div class="alert <?= $classe ?> alert-dismissible fade show w-75 mx-auto mb-4" role="alert">
            <i class="bi bi-info-circle"></i> <?= $mensagem ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <a href="inserir.php" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Adicionar Novo Usuário
    </a>

    <div class="table-responsive">
        <table class="table table-hover align-middle caption-top">
            <caption>Quantidade de registros: <?= count($usuarios) ?></caption>
            <thead class="align-middle table-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop para exibir os usuários na tabela -->
                <?php foreach ($usuarios as $usuario) : ?>
                    <tr>
                        <!-- Exibe os dados do usuário nas colunas da tabela -->
                        <td><?= $usuario['id'] ?></td>
                        <td><?= $usuario['nome'] ?></td>
                        <td><?= $usuario['email'] ?></td>

                        <td class="text-end">
                            <!-- Botão para editar o usuário, passando o ID como parâmetro na URL -->
                            <a class="btn btn-warning btn-sm" href="editar.php?id=<?= $usuario['id'] ?>"><i class="bi bi-pencil-square"></i> Editar</a>
                        </td>
                        <td class="text-start">
                            <!-- Botão para excluir o usuário, passando o ID como parâmetro na URL -->
                            <a class="btn btn-danger btn-sm" href="excluir.php?id=<?= $usuario['id'] ?>"><i class="bi bi-trash"></i> Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once BASE_PATH . '/includes/rodape.php'; ?>