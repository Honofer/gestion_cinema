<?php
include 'includes/header.php';
include 'includes/connexion.php';

$sql = "SELECT a.id, c.nom, c.prenom, a.type_abonnement, a.date_debut, a.date_fin
        FROM abonnements a
        JOIN clients c ON a.client_id = c.id";
$stmt = $pdo->query($sql);
$abonnements = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Liste des abonnements</h2>
<a href="ajouter_abonnement.php" class="btn btn-primary mb-3">Ajouter un abonnement</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Client</th>
            <th>Type d'abonnement</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($abonnements as $index => $abonnement): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($abonnement['nom'] . ' ' . $abonnement['prenom']) ?></td>
            <td><?= htmlspecialchars($abonnement['type_abonnement']) ?></td>
            <td><?= $abonnement['date_debut'] ?></td>
            <td><?= $abonnement['date_fin'] ?></td>
            <td>
                <a href="modifier_abonnement.php?id=<?= $abonnement['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAbonnementModal" data-id="<?= $abonnement['id'] ?>">
                    Supprimer
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="modal fade" id="deleteAbonnementModal" tabindex="-1" aria-labelledby="deleteAbonnementLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="GET" action="supprimer_abonnement.php">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteAbonnementLabel">Confirmation de suppression</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          Êtes-vous sûr de vouloir supprimer cet abonnement ?
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="abonnementIdToDelete">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-danger">Confirmer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const deleteModal = document.getElementById('deleteAbonnementModal');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const abonnementId = button.getAttribute('data-id');
    document.getElementById('abonnementIdToDelete').value = abonnementId;
  });
});
</script>

<?php include 'includes/footer.php'; ?>
