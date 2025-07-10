<?php
include 'includes/header.php';
include 'includes/connexion.php';

if (!isset($_GET['id'])) {
    header("Location: films.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM films WHERE id = ?");
$stmt->execute([$id]);
$film = $stmt->fetch();

if (!$film) {
    echo "<h2>Film introuvable.</h2>";
    include 'includes/footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $genre = $_POST['genre'] ?? '';
    $duree = $_POST['duree'] ?? null;
    $date_sortie = $_POST['date_sortie'] ?? null;
    $description = $_POST['description'] ?? '';

    $stmt = $pdo->prepare("UPDATE films SET titre = ?, genre = ?, duree = ?, date_sortie = ?, description = ? WHERE id = ?");
    $stmt->execute([$titre, $genre, $duree, $date_sortie, $description, $id]);

    header("Location: films.php");
    exit;
}
?>

<h2>Modifier le film</h2>
<form method="post">
    <div class="mb-3">
        <label for="titre" class="form-label">Titre</label>
        <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($film['titre']) ?>" class="form-control" required />
    </div>
    <div class="mb-3">
        <label for="genre" class="form-label">Genre</label>
        <input type="text" id="genre" name="genre" value="<?= htmlspecialchars($film['genre']) ?>" class="form-control" />
    </div>
    <div class="mb-3">
        <label for="duree" class="form-label">Durée (en minutes)</label>
        <input type="number" id="duree" name="duree" value="<?= $film['duree'] ?>" class="form-control" />
    </div>
    <div class="mb-3">
        <label for="date_sortie" class="form-label">Date de sortie</label>
        <input type="date" id="date_sortie" name="date_sortie" value="<?= $film['date_sortie'] ?>" class="form-control" />
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea id="description" name="description" class="form-control"><?= htmlspecialchars($film['description']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-success">Mettre à jour</button>
    <a href="films.php" class="btn btn-secondary">Annuler</a>
</form>

<?php include 'includes/footer.php'; ?>
