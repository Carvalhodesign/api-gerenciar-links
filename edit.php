<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Link</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2>Editar Link</h2>
            <?php
            // conexão com o banco de dados
            require_once 'config.php';

            // verifica se o formulário de edição foi enviado
            if (isset($_POST['edit_url']) && isset($_POST['edit_title']) && isset($_POST['edit_id'])) {
                $edit_id = $_POST['edit_id'];
                $edit_url = $_POST['edit_url'];
                $edit_title = $_POST['edit_title'];

                // atualiza os dados do link no banco de dados
                $sql = "UPDATE links SET url = :url, title = :title WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['url' => $edit_url, 'title' => $edit_title, 'id' => $edit_id]);

                // exibe mensagem de sucesso
                echo '<div class="alert alert-success">Link atualizado com sucesso!</div>';
                // redireciona para a página de links após a atualização
    header("Location: inserir.php");
    exit();
            }

            // recupera o link a ser editado
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $sql = "SELECT * FROM links WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['id' => $id]);

                $link = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <form method="post" action="edit.php">
                <input type="hidden" name="edit_id" value="<?php echo $link['id']; ?>">
                <div class="form-group">
                    <label for="edit_url">URL</label>
                    <input type="text" class="form-control" id="edit_url" name="edit_url"
                           value="<?php echo $link['url']; ?>">
                </div>
                <div class="form-group">
                    <label for="edit_title">Título</label>
                    <input type="text" class="form-control" id="edit_title" name="edit_title"
                           value="<?php echo $link['title']; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
