<?php
include 'includes/header.php';
include 'includes/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $telephone = $_POST['telephone'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO clients (nom, prenom, email, telephone) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $email, $telephone]);

    echo "<h2>Client ajouté avec succès !</h2>";
    echo '<a href="clients.php" class="btn btn-primary">Retour à la liste des clients</a>';
}

include 'includes/footer.php';
?>
