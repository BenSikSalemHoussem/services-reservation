<?php
session_start();

function redirect($url) {
    header("Location: " . $url);
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isLoggedIn() && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}

function currentUser() {
    return $_SESSION ?? null;
}

function displayAlert($type, $message) {
    if (isset($_SESSION['alert'])) {
        unset($_SESSION['alert']); // Clear previous alert
    }
    $_SESSION['alert'] = ['type' => $type, 'message' => $message];
}

function showAlert() {
    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        echo '<div class="alert alert-' . htmlspecialchars($alert['type']) . '">' . htmlspecialchars($alert['message']) . '</div>';
        unset($_SESSION['alert']);
    }
}
?>