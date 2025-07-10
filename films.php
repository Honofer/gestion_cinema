<?php
include 'includes/header.php';
include 'includes/connexion.php';

$films = $pdo->query("SELECT * FROM films")->fetchAll(PDO::FETCH_ASSOC);
?>
<h2>Liste des films</h2>
<a href="ajouter_film.php" class="btn btn-primary mb-3">Ajouter un film</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Genre</th>
            <th>Durée (min)</th>
            <th>Date de sortie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($films as $index => $film): ?>
        <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($film['titre']) ?></td>
            <td><?= htmlspecialchars($film['genre']) ?></td>
            <td><?= $film['duree'] ?></td>
            <td><?= $film['date_sortie'] ?></td>
            <td>
                <a href="modifier_film.php?id=<?= $film['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $film['id'] ?>">Supprimer</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="GET" action="supprimer_film.php">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
        </div>
        <div class="modal-body">
          Êtes-vous sûr de vouloir supprimer ce film ?
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" id="filmIdToDelete">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-danger">Confirmer</button>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
  const deleteModal = document.getElementById('deleteModal');
  deleteModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const filmId = button.getAttribute('data-id');
    document.getElementById('filmIdToDelete').value = filmId;
  });
});
</script>

<?php include 'includes/footer.php'; ?>
