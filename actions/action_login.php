<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/user.php');

    $db = getDatabaseConnection();

    $user = getUserByUsernamePass($db, $_POST['username'], $_POST['password']);

    if($user != null) {
        echo "success";
        $_SESSION['user'] = $user;
        header('Location: ../pages/register.php');
    } else {
        header('Location: ../pages/login.php');
        echo "Invalid credentials!";
    }

?>