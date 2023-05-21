<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/user.php');


    $db = getDatabaseConnection();

    $user = getUser($db, $_POST['username']);

    if ($user != null && password_verify($_POST['password'], $user->passwordHash)) {
        echo "success";
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_type'] = $user->type->name;
        header('Location: ../pages/home.php');
    } else {
        header('Location: ../pages/login.php');
        echo "Invalid credentials!";
    }

?>