<?php
$title = 'Détails du Service';
require_once '../../init.php';
include '../includes/header.php';

if (!isset($service)) {
    echo '<div class="alert alert-danger">Service non trouvé.</div>';
} else {
    ?>
    <h2><?php echo htmlspecialchars($service['nom']); ?></h2>
    <div class="row">
        <div class="col-md-6">
            <?php if ($service['image_path']): ?>
                <img src="../../<?php echo htmlspecialchars($service['image_path']); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($service['nom']); ?>">
            <?php else: ?>
                <img src="https://via.placeholder.com/400x300?text=Pas+d'image" class="img-fluid rounded" alt="Pas d'image">
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <p><?php echo htmlspecialchars($service['description']); ?></p>
            <p><strong>Prix:</strong> <?php echo htmlspecialchars($service['prix']); ?> €</p>
            <?php if (isLoggedIn()): ?>
                <h3>Réserver ce service</h3>
                <form action="../../controllers/ReservationController.php" method="post">
                    <input type="hidden" name="service_id" value="<?php echo htmlspecialchars($service['id']); ?>">
                    <div class="mb-3">
                        <label for="date_reservation" class="form-label">Date de réservation</label>
                        <input type="date" class="form-control" id="date_reservation" name="date_reservation" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="reserve_service">Réserver</button>
                </form>
            <?php else: ?>
                <p><a href="../auth/login.php">Connectez-vous</a> pour réserver ce service.</p>
            <?php endif; ?>
            <p><a href="index.php" class="btn btn-secondary mt-3">Retour aux services</a></p>
        </div>
    </div>
    <?php
}
?>
<?php include '../includes/footer.php'; ?>