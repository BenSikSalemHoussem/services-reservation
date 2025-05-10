<?php
//require_once '../../init.php';
$title = 'Se Connecter';
//include '../includes/header.php';
?>

<?php /*$title = 'Se Connecter'; include '../includes/header.php';*/ ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Se Connecter</div>
            <div class="card-body">
                <form action="../../controllers/AuthController.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mot_de_passe" class="form-label">Mot de Passe</label>
                        <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Se Connecter</button>
                    <p class="mt-3">Vous n'avez pas de compte ? <a href="register.php">S'inscrire</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>