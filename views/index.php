<?php
$title = 'Accueil';
require_once '../init.php';
include 'includes/header.php';
?>
<div class="jumbotron">
    <h1 class="display-4">Bienvenue sur notre site de réservation de services !</h1>
    <p class="lead">Trouvez et réservez facilement les services dont vous avez besoin.</p>
    <hr class="my-4">
    <p>Que vous ayez besoin d'un plombier, d'un électricien ou d'un service de bâtiment, vous êtes au bon endroit.</p>
    <a class="btn btn-primary btn-lg" href="views/services/index.php" role="button">Voir nos services</a>
</div>
<?php include 'includes/footer.php'; ?>