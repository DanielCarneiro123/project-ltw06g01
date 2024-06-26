<?php 
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();

    $oldPassword = $_POST['old-password'];
    $newPassword = $_POST['new-password'];
    array_map(fn($value) => preg_replace("/[^a-zA-Z0-9.,!?\s]/", "", $value), $_GET, $_POST);
    
    if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf']) || $_POST['uid'] != $_SESSION['uid']) {
        $session->addMessage('error', 'Not logged in');
        header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/client.php');
    require_once(__DIR__ . '/../utils/validations.php');
    require_once(__DIR__ . '/../database/connection.php');

    $db = getDatabaseConnection();
    $user_id = $_SESSION['uid'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    if (!isValidName($username)) {
        $session->addMessage('error', 'Invalid name');
        header('Location: ../pages/profile.php');
    }
    if (!isValidEmail($_POST['email'])) {
        header('Location: ../pages/profile.php');
    }

    $user = getUser($db, $_POST['uid']);

    if (empty($user)) {
        $session->addMessage('error', 'Invalid login');
    }
    else {
        if (password_verify($oldPassword, $user['passHash'])) {
            if (!isValidPassword($newPassword, $session)) {
                header('Location: ../pages/profile.php');
            }
            else {
                echo "I AM ABOUT TO CHANGE IT";
                updatePassword($db, $_POST['uid'], $newPassword);
            }
        }
    }

    $updated = updateProfile($db, $user_id, $username, $email);

    $session->addMessage('success', 'Profile updated');
    //header('Location: ../pages/profile.php');
