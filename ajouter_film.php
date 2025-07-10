<?php
include 'includes/header.php';
include 'includes/connexion.php';

$erreurs = [];
$titre = $genre = $duree = $date_sortie = $description = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $genre = trim($_POST['genre'] ?? '');
    $duree = intval($_POST['duree'] ?? 0);
    $date_sortie = $_POST['date_sortie'] ?? '';
    $description = trim($_POST['description'] ?? '');

    if (strlen($titre) < 2) {
        $erreurs[] = "Le titre est obligatoire et doit contenir au moins 2 caractères.";
    }
    if (strlen($genre) < 2) {
        $erreurs[] = "Le genre est obligatoire et doit contenir au moins 2 caractères.";
    }
    if ($duree <= 0) {
        $erreurs[] = "La durée doit être un nombre entier positif.";
    }
    if (!$date_sortie || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_sortie)) {
        $erreurs[] = "La date de sortie est obligatoire et doit être au format AAAA-MM-JJ.";
    }
    if (strlen($description) < 5) {
        $erreurs[] = "La description doit contenir au moins 5 caractères.";
    }

    if (empty($erreurs)) {
        $sql = "INSERT INTO films (titre, genre, duree, date_sortie, description) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$titre, $genre, $duree, $date_sortie, $description]);

        echo '<div class="alert alert-success">Film ajouté avec succès !</div>';
        echo '<a href="films.php" class="btn btn-primary">Retour à la liste des films</a>';

        $titre = $genre = $duree = $date_sortie = $description = '';
    }
}
?>

<h2>Ajouter un nouveau film</h2>

<?php if (!empty($erreurs)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($erreurs as $erreur): ?>
                <li><?= htmlspecialchars($erreur) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="ajouter_film.php" method="post" class="mt-3">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" name="titre" id="titre" class="form-control" value="<?= htmlspecialchars($titre) ?>" required>
    </div>

    <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" name="genre" id="genre" class="form-control" value="<?= htmlspecialchars($genre) ?>" required>
    </div>

    <div class="mb-3">
        <label for="duree" class="form-label">Durée (en minutes)</label>
        <input type="number" name="duree" id="duree" class="form-control" min="1" value="<?= htmlspecialchars($duree) ?>" required>
    </div>

    <div class="mb-3">
        <label for="date_sortie" class="form-label">Date de sortie</label>
        <input type="date" name="date_sortie" id="date_sortie" class="form-control" value="<?= htmlspecialchars($date_sortie) ?>" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" rows="4" required><?= htmlspecialchars($description) ?></textarea>
    </div>

    <button type="submit" class="btn btn-success">Ajouter</button>
    <a href="films.php" class="btn btn-secondary">Annuler</a>
</form>

<?php include 'includes/footer.php'; ?>
