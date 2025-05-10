<?php
if (!isLoggedIn()) {
    redirect('views/auth/login.php');
}

$userModel = new User($db);
$reservationModel = new Reservation($db);
$currentUser = $userModel->getUserById($_SESSION['user_id']);

if (!$currentUser) {
    session_destroy();
    redirect('views/auth/login.php');
}

if (isset($_POST['update_profile'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    if (!Validator::string($nom, 2, 50)) {
        displayAlert('danger', 'Le nom doit contenir entre 2 et 50 caractères.');
    } elseif (!Validator::email($email)) {
        displayAlert('danger', 'L\'adresse email n\'est pas valide.');
    } elseif ($email !== $_SESSION['email'] && $userModel->getUserByEmail($email)) {
        displayAlert('danger', 'Cet email est déjà utilisé par un autre compte.');
    } else {
        if ($userModel->updateUser($_SESSION['user_id'], $nom, $email)) {
            $_SESSION['nom'] = $nom;
            $_SESSION['email'] = $email;
            displayAlert('success', 'Profil mis à jour avec succès.');
        } else {
            displayAlert('danger', 'Une erreur est survenue lors de la mise à jour du profil.');
        }
    }
    redirect('views/user/profile.php');
}

$userReservations = $reservationModel->getReservationsByUserId($_SESSION['user_id']);

?>