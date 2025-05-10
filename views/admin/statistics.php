<?php
$title = 'Statistiques';
require_once '../../init.php';
include '../includes/header.php';
if (!isAdmin()) {
    redirect('../../index.php');
}
include '../includes/admin_nav.php';
?>
<h2>Statistiques</h2>
<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">Nombre total de clients</div>
            <div class="card-body">
                <p class="card-text"><?php echo $totalUsers; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">Nombre total de services</div>
            <div class="card-body">
                <p class="card-text"><?php echo $totalServices; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header">Nombre total de réservations</div>
            <div class="card-body">
                <p class="card-text"><?php echo $totalReservations; ?></p>
            </div>
        </div>
    </div>
    </div>
<?php include '../includes/footer.php'; ?>