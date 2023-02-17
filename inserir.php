<?php
require_once 'config.php';

$message = '';

if (isset($_POST['url']) && isset($_POST['title'])) {
    $url = $_POST['url'];
    $title = $_POST['title'];

    $sql = "INSERT INTO links (url, title) VALUES (:url, :title)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['url' => $url, 'title' => $title]);

    $message = "Link inserido com sucesso!";
}

$sql = "SELECT * FROM links";
$stmt = $pdo->query($sql);
$links = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Tabela Centralizada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .table {
            margin: 0 auto; /* centraliza a tabela horizontalmente */
            margin-top: 30px;
            width: 80%; /* define a largura da tabela */
        }

        .thead-dark {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-12">
      <h2 class="text-center mb-3">Minha Tabela</h2>
      <?php if (!empty($message)) : ?>
        <div class="alert alert-success" role="alert">
          <?php echo $message; ?>
        </div>
      <?php endif; ?>
      <a href="add.php" class="btn btn-primary mb-3">Adicionar link</a>
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>URL</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($links as $link) : ?>
                            <tr>
                                <td><?php echo $link['id']; ?></td>
                                <td><?php echo $link['title']; ?></td>
                                <td><?php echo $link['url']; ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Ações">
                                        <a href="edit.php?id=<?php echo $link['id']; ?>" class="btn btn-outline-success btn-sm">Editar</a>
                                        <a href="#" class="btn btn-outline-danger delete-btn" data-id="<?php echo $link['id']; ?>">Excluir</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        const deleteBtns = document.querySelectorAll('.delete-btn');
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', (event) => {
                const linkId = event.target.dataset.id;
                const confirmDelete = confirm("Tem certeza que deseja excluir este link?");
                if (confirmDelete) {
                    fetch(`delete.php?id=${linkId}`)
                        .then(response => response.text())
                        .then(data => {
                            alert(data);
                            window.location.reload();
                        })
                        .catch(error => console.error(error));
                }
            });
        });
    </script>

</body>

</html>
