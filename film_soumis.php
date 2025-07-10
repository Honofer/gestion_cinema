<?php
include 'includes/connexion.php';
include 'templates/header.php';

$titre = trim($_POST['titre'] ?? '');
$realisateur = trim($_POST['realisateur'] ?? '');
$genre = trim($_POST['genre'] ?? '');
$duree = intval($_POST['duree'] ?? 0);

$erreurs = [];

if (strlen($titre) < 2) {
    $erreurs[] = "Le titre est trop court.";
}

if ($duree <= 0) {
    $erreurs[] = "La durée doit être un nombre strictement positif.";
}

if (count($erreurs) > 0) {
    echo "<div class='alert alert-danger'><ul>";
    foreach ($erreurs as $e) {
        echo "<li>$e</li>";
    }
    echo "</ul><a href='ajouter_film.php' class='btn btn-secondary mt-2'>Retour</a></div>";
    include 'templates/footer.php';
    exit;
}

$sql = "INSERT INTO films (titre, realisateur, genre, duree) VALUES (?, ?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$titre, $realisateur, $genre, $duree]);

echo "<div class='alert alert-success'>Film ajouté avec succès !</div>";
echo "<a href='films.php' class='btn btn-primary'>Voir les films</a>";

include 'templates/footer.php';
?>
