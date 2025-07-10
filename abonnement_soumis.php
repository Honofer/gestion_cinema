<?php
include 'includes/header.php';
include 'includes/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'] ?? null;
    $type_abonnement = $_POST['type_abonnement'] ?? '';
    $date_debut = $_POST['date_debut'] ?? null;
    $date_fin = $_POST['date_fin'] ?? null;

    if ($client_id && $type_abonnement && $date_debut && $date_fin) {
        $stmt = $pdo->prepare("INSERT INTO abonnements (client_id, type_abonnement, date_debut, date_fin) VALUES (?, ?, ?, ?)");
        $stmt->execute([$client_id, $type_abonnement, $date_debut, $date_fin]);

        echo "<h2>Abonnement ajouté avec succès !</h2>";
        echo '<a href="abonnements.php" class="btn btn-primary">Retour à la liste des abonnements</a>';
    } else {
        echo "<h2>Veuillez remplir tous les champs.</h2>";
        echo '<a href="ajouter_abonnement.php" class="btn btn-secondary">Retour</a>';
    }
}

include 'includes/footer.php';
