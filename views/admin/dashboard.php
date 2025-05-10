<?php
$title = 'Tableau de Bord Admin';
require_once '../../init.php';
include '../includes/header.php';
if (!isAdmin()) {
    redirect('../../index.php');
}
include '../includes/admin_nav.php';
?>
<h2>Tableau de Bord</h2>
<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary text-white mb-3">
            <div class="card-body">
                <h5 class="card-title">Clients</h5>
                <p class="card-text"><?php echo $totalUsers; ?></p>
                <a href="users.php" class="btn btn-sm btn-light">Voir les clients</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white mb-3">
            <div class="card-body">
                <h5 class="card-title">Services</h5>
                <p class="card-text"><?php echo $totalServices; ?></p>
                <a href="services.php" class="btn btn-sm btn-light">Voir les services</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white mb-3">
            <div class="card-body">
                <h5 class="card-title">Réservations</h5>
                <p class="card-text"><?php echo $totalReservations; ?></p>
                <a href="reservations.php" class="btn btn-sm btn-light">Voir les réservations</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white mb-3">
            <div class="card-body">
                <h5 class="card-title">Statistiques</h5>
                <p class="card-text">...</p>
                <a href="statistics.php" class="btn btn-sm btn-light">Voir les statistiques</a>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>