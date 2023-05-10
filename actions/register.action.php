<?php
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    
    if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
        header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php');

    $db = getDatabaseConnection();

    if ($_POST['password'] != $_POST['confirm-password']) {
        header('Location: ../pages/page.php');
    }

    $userCreated = createNewUser($db, $_POST['username'], $_POST['email'], $_POST['password']);
    if (!$userCreated[0]) {
        header('Location: ../pages/page.php');
    }
    else {
        $_SESSION['uid'] = $userCreated[1];
        $_SESSION['level'] = 0;
        $_SESSION['animation'] = 2;
    }

    header('Location: ../pages/page.php');
?>    