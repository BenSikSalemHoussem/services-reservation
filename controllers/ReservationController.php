<?php
$reservationModel = new Reservation($db);
$serviceModel = new Service($db);

if (isLoggedIn() && isset($_POST['reserve_service'])) {
    $user_id = $_SESSION['user_id'];
    $service_id = $_POST['service_id'];
    $date_reservation = $_POST['date_reservation'];

    if (!Validator::numeric($service_id) || $service_id <= 0) {
        displayAlert('danger', 'Service invalide.');
    } elseif (empty($date_reservation)) {
        displayAlert('danger', 'Veuillez sélectionner une date de réservation.');
    } else {
        if ($reservationModel->createReservation($user_id, $service_id, $date_reservation)) {
            displayAlert('success', 'Réservation effectuée avec succès.');
            redirect('views/user/reservations.php');
        } else {
            displayAlert('danger', 'Une erreur est survenue lors de la réservation.');
        }
    }
    redirect('views/services/details.php?service_id=' . $service_id);
}

if (isAdmin()) {
    $reservations = $reservationModel->getAllReservations();

    if (isset($_POST['update_reservation_status'])) {
        $reservation_id = $_POST['reservation_id'];
        $statut = $_POST['statut'];

        if ($reservationModel->updateReservationStatus($reservation_id, $statut)) {
            displayAlert('success', 'Statut de la réservation mis à jour.');
        } else {
            displayAlert('danger', 'Erreur lors de la mise à jour du statut de la réservation.');
        }
        redirect('views/admin/reservations.php');
    }

    if (isset($_GET['delete_reservation'])) {
        $reservation_id = $_GET['delete_reservation'];
        if ($reservationModel->deleteReservation($reservation_id)) {
            displayAlert('success', 'Réservation supprimée.');
        } else {
            displayAlert('danger', 'Erreur lors de la suppression de la réservation.');
        }
        redirect('views/admin/reservations.php');
    }
} elseif (isLoggedIn()) {
    $userReservations = $reservationModel->getReservationsByUserId($_SESSION['user_id']);
}
?>