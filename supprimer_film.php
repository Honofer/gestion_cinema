<?php
include 'includes/connexion.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM films WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: films.php");
exit;
?>
