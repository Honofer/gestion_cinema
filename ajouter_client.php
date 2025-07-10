<?php include 'includes/header.php'; ?>
<h2>Ajouter un client</h2>
<form action="client_soumis.php" method="post">
    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" id="nom" name="nom" class="form-control" required />
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" id="prenom" name="prenom" class="form-control" required />
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" required />
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone</label>
        <input type="text" id="telephone" name="telephone" class="form-control" required />
    </div>
    <button type="submit" class="btn btn-success">Ajouter</button>
    <a href="clients.php" class="btn btn-secondary">Annuler</a>
</form>
<?php include 'includes/footer.php'; ?>
