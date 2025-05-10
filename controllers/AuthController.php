<?php
//require_once '../init.php';
$userModel = new User($db);

if (isset($_POST['register'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $confirmation_mot_de_passe = $_POST['confirmation_mot_de_passe'];

    if (!Validator::string($nom, 2, 50)) {
        displayAlert('danger', 'Le nom doit contenir entre 2 et 50 caractères.');
    } elseif (!Validator::email($email)) {
        displayAlert('danger', 'L\'adresse email n\'est pas valide.');
    } elseif (!Validator::string($mot_de_passe, 6)) {
        displayAlert('danger', 'Le mot de passe doit contenir au moins 6 caractères.');
    } elseif ($mot_de_passe !== $confirmation_mot_de_passe) {
        displayAlert('danger', 'Les mots de passe ne correspondent pas.');
    } elseif ($userModel->getUserByEmail($email)) {
        displayAlert('danger', 'Cet email est déjà enregistré.');
    } else {
        if ($userModel->createUser($nom, $email, $mot_de_passe)) {
            displayAlert('success', 'Inscription réussie. Vous pouvez maintenant vous connecter.');
            redirect('views/auth/login.php');
        } else {
            displayAlert('danger', 'Une erreur est survenue lors de l\'inscription.');
        }
    }
    redirect('views/auth/register.php');
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $user = $userModel->getUserByEmail($email);

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['is_admin'] = $user['is_admin']; // Assurez-vous que votre table 'users' a une colonne 'is_admin' (0 ou 1)
        displayAlert('success', 'Connexion réussie.');
        if (isAdmin()) {
            redirect('views/admin/dashboard.php');
        } else {
            redirect('views/user/profile.php');
        }
    } else {
        displayAlert('danger', 'Identifiants incorrects.');
        redirect('views/auth/login.php');
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    redirect('index.php');
}
?>