<?php
$title = 'Gestion des Réservations';
require_once '../../init.php';
include '../includes/header.php';
if (!isAdmin()) {
    redirect('../../index.php');
}
include '../includes/admin_nav.php';
?>
<h2>Gestion des Réservations</h2>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Service</th>
            <th>Date de Réservation</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservations as $reservation): ?>
            <tr>
                <td><?php echo htmlspecialchars($reservation['id']); ?></td>
                <td><?php echo htmlspecialchars($reservation['user_nom']); ?></td>
                <td><?php echo htmlspecialchars($reservation['service_nom']); ?></td>
                <td><?php echo htmlspecialchars($reservation['date_reservation']); ?></td>
                <td>
                    <form action="../../controllers/ReservationController.php" method="post">
                        <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation['id']); ?>">
                        <select class="form-select form-select-sm" name="statut" onchange="this.form.submit()">
                            <option value="en_attente" <?php echo ($reservation['statut'] == 'en_attente') ? 'selected' : ''; ?>>En attente</option>
                            <option value="confirmée" <?php echo ($reservation['statut'] == 'confirmée') ? 'selected' : ''; ?>>Confirmée</option>
                            <option value="terminée" <?php echo ($reservation['statut'] == 'terminée') ? 'selected' : ''; ?>>Terminée</option>
                            <option value="annulée" <?php echo ($reservation['statut'] == 'annulée') ? 'selected' : ''; ?>>Annulée</option>
                        </select>
                        <button type="submit" class="d-none" name="update_reservation_status">Mettre à jour</button>
                    </form>
                </td>
                <td>
                    <a href="../../controllers/ReservationController.php?delete_reservation=<?php echo $reservation['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include '../includes/footer.php'; ?>