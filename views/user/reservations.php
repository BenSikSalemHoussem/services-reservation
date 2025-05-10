<?php
$title = 'Mes Réservations';
require_once '../../init.php';
include '../includes/header.php';
if (!isLoggedIn()) {
    redirect('../auth/login.php');
}
?>
<h2>Mes Réservations</h2>
<?php if (empty($userReservations)): ?>
    <p>Vous n'avez aucune réservation pour le moment.</p>
<?php else: ?>
    <ul class="list-group">
        <?php foreach ($userReservations as $reservation): ?>
            <li class="list-group-item">
                Service: <?php echo htmlspecialchars($reservation['service_nom']); ?> -
                Date: <?php echo htmlspecialchars($reservation['date_reservation']); ?> -
                Statut: <span class="badge bg-info"><?php echo htmlspecialchars($reservation['statut']); ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php include '../includes/footer.php'; ?>