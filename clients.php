<?php
include 'includes/header.php';
include 'includes/connexion.php';

$clients = $pdo->query("SELECT * FROM clients")->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Liste des clients</h2>
<a href="ajouter_client.php" class="btn btn-primary mb-3">Ajouter un client</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $index => $client): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($client['nom']) ?></td>
            <td><?= htmlspecialchars($client['prenom']) ?></td>
            <td><?= htmlspecialchars($client['email']) ?></td>
            <td><?= htmlspecialchars($client['telephone']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include 'includes/footer.php'; ?>
