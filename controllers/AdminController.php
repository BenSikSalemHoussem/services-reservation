<?php
if (!isAdmin()) {
    redirect('index.php');
}

$userModel = new User($db);
$serviceModel = new Service($db);
$reservationModel = new Reservation($db);

$totalUsers = count($userModel->getAllUsers());
$totalServices = count($serviceModel->getAllServices());
$totalReservations = count($reservationModel->getAllReservations());
// Vous pouvez ajouter ici la logique pour calculer d'autres statistiques

$users = $userModel->getAllUsers();
$services = $serviceModel->getAllServices();
$reservations = $reservationModel->getAllReservations();

?>