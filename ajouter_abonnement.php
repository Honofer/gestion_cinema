<?php
include 'includes/header.php';
include 'includes/connexion.php';

$clients = $pdo->query("SELECT id, nom, prenom FROM clients ORDER BY nom")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Ajouter un abonnement</h2>

<form action="abonnement_soumis.php" method="post">
    <div class="mb-3">
        <label for="client_id" class="form-label">Client</label>
        <select name="client_id" id="client_id" class="form-select" required>
            <option value="">-- Sélectionnez un client --</option>
            <?php foreach ($clients as $client): ?>
                <option value="<?= $client['id'] ?>">
                    <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="type_abonnement" class="form-label">Type d'abonnement</label>
        <input type="text" id="type_abonnement" name="type_abonnement" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="date_debut" class="form-label">Date de début</label>
        <input type="date" id="date_debut" name="date_debut" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="date_fin" class="form-label">Date de fin</label>
        <input type="date" id="date_fin" name="date_fin" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Ajouter</button>
    <a href="abonnements.php" class="btn btn-secondary">Annuler</a>
</form>

<?php include 'includes/footer.php'; ?>
