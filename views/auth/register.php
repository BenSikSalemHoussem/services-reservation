<?php $title = 'S\'inscrire'; include '../includes/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">S'inscrire</div>
            <div class="card-body">
                <form action="../../controllers/AuthController.php" method="post">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mot_de_passe" class="form-label">Mot de Passe</label>
                        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmation_mot_de_passe" class="form-label">Confirmer le Mot de Passe</label>
                        <input type="password" class="form-control" id="confirmation_mot_de_passe" name="confirmation_mot_de_passe" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="register">S'inscrire</button>
                    <p class="mt-3">Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>