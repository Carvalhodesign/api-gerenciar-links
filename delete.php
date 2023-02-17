<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $linkId = $_GET['id'];
    $sql = "DELETE FROM links WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $linkId]);
    echo "Link excluído com sucesso!";
}
?>
