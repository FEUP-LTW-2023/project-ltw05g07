<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/user.php');

    $db = getDatabaseConnection();


    if (!validEmail($_POST['email'])) {
        header('Location: ../pages/register.php');
        echo "Invalid email!";
        return;
    }

    if (!validPassword($_POST['password'])) {
        header('Location: ../pages/register.php');
        echo "Invalid password!";
        return;
    }

    if (!validUsername($_POST['username'])) {
        header('Location: ../pages/register.php');
        echo "Invalid username!";
        return;
    }

    if (!validName($_POST['firstName'])) {
        header('Location: ../pages/register.php');
        echo "Invalid first name!";
        return;
    }

    if (!validName($_POST['lastName'])) {
        header('Location: ../pages/register.php');
        echo "Invalid last name!";
        return;
    }

    if (existsEmail($db, $_POST['email'])) {
        header('Location: ../pages/register.php');
        echo "Email already exists!";
        return;
    }

    if (existsUsername($db, $_POST['username'])) {
        header('Location: ../pages/register.php');
        echo "Username already exists!";
        return;
    }

    addUser(
        $db,
        $_POST['username'],
        $_POST['firstName'],
        $_POST['lastName'],
        $_POST['email'],
        $_POST['password']
    );
    
    $_SESSION['user'] = $_POST['username']; 
    //echo $_SESSION['user'];
    header('Location: ../pages/home.php');
    exit(0);
?>