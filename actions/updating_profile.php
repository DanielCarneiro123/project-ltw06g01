<?php 
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();

    array_map(fn($value) => preg_replace("/[^a-zA-Z0-9.,!?\s]/", "", $value), $_GET, $_POST);
    
    if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
        $session->addMessage('error', 'Not logged in');
        header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/client.php');
    require_once(__DIR__ . '/../database/connection.php');

    $db = getDatabaseConnection();
    $user_id = $_SESSION['uid'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    $updated = updateProfile($db, $user_id, $username, $email);

    $session->addMessage('success', 'Profile updated');
    header('Location: ../pages/profile.php');
?>    