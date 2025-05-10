<?php
$title = 'Mon Profil';
require_once '../../init.php';
include '../includes/header.php';
if (!isLoggedIn()) {
    redirect('../auth/login.php');
}
?>
<h2>Mon Profil</h2>
<form action="../../controllers/UserController.php" method="post">
    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($currentUser['nom']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($currentUser['email']); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary" name="update_profile">Mettre à jour le profil</button>
</form>

<h3 class="mt-4">Mes Réservations</h3>
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