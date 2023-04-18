<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/user.php');

    $db = getDatabaseConnection();

    $user = getUser($db, $_POST['username']);

    if ($user != null && $user->verifyCredentials(password_hash($_POST['password'], PASSWORD_DEFAULT))) {
        echo "success";
        $_SESSION['user'] = $_POST['username'];
        header('Location: ../pages/register.php');
    } else {
        header('Location: ../pages/login.php');
        echo "Invalid credentials!";
    }

?>