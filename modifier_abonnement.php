<?php
include 'includes/header.php';
include 'includes/connexion.php';

if (!isset($_GET['id'])) {
    header("Location: abonnements.php");
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM abonnements WHERE id = ?");
$stmt->execute([$id]);
$abonnement = $stmt->fetch();

if (!$abonnement) {
    echo "<h2>Abonnement introuvable.</h2>";
    include 'includes/footer.php';
    exit;
}

$clients = $pdo->query("SELECT id, nom, prenom FROM clients ORDER BY nom")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'] ?? null;
    $type_abonnement = $_POST['type_abonnement'] ?? '';
    $date_debut = $_POST['date_debut'] ?? null;
    $date_fin = $_POST['date_fin'] ?? null;

    if ($client_id && $type_abonnement && $date_debut && $date_fin) {
        $stmt = $pdo->prepare("UPDATE abonnements SET client_id = ?, type_abonnement = ?, date_debut = ?, date_fin = ? WHERE id = ?");
        $stmt->execute([$client_id, $type_abonnement, $date_debut, $date_fin, $id]);

        header("Location: abonnements.php");
        exit;
    } else {
        echo "<h2>Veuillez remplir tous les champs.</h2>";
    }
}
?>

<h2>Modifier l'abonnement</h2>

<form method="post">
    <div class="mb-3">
        <label for="client_id" class="form-label">Client</label>
        <select name="client_id" id="client_id" class="form-select" required>
            <?php foreach ($clients as $client): ?>
                <option value="<?= $client['id'] ?>" <?= $client['id'] == $abonnement['client_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="type_abonnement" class="form-label">Type d'abonnement</label>
        <input type="text" id="type_abonnement" name="type_abonnement" class="form-control" value="<?= htmlspecialchars($abonnement['type_abonnement']) ?>" required />
    </div>

    <div class="mb-3">
        <label for="date_debut" class="form-label">Date de début</label>
        <input type="date" id="date_debut" name="date_debut" class="form-control" value="<?= $abonnement['date_debut'] ?>" required />
    </div>

    <div class="mb-3">
        <label for="date_fin" class="form-label">Date de fin</label>
        <input type="date" id="date_fin" name="date_fin" class="form-control" value="<?= $abonnement['date_fin'] ?>" required />
    </div>

    <button type="submit" class="btn btn-success">Mettre à jour</button>
    <a href="abonnements.php" class="btn btn-secondary">Annuler</a>
</form>

<?php include 'includes/footer.php'; ?>
