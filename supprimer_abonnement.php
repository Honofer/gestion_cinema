<?php
include 'includes/connexion.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM abonnements WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: abonnements.php");
exit;
?>
