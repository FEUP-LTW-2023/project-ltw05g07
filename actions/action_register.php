<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/user.php');

    $db = getDatabaseConnection();


    if(!validEmail($_POST['email'])) {
        header('Location: ../pages/register.php');
        echo "Invalid email!";
        return;
    }

    if(!validPassword($_POST['password'])) {
        header('Location: ../pages/register.php');
        echo "Invalid password!";
        return;
    }

    if(!validUsername($_POST['username'])) {
        header('Location: ../pages/register.php');
        echo "Invalid username!";
        return;
    }

    if(!validFirstName($_POST['firstName'])) {
        header('Location: ../pages/register.php');
        echo "Invalid first name!";
        return;
    }

    if(!validLastName($_POST['lastName'])) {
        header('Location: ../pages/register.php');
        echo "Invalid last name!";
        return;
    }

    if(existsEmail($db, $_POST['email'])) {
        header('Location: ../pages/register.php');
        echo "Email already exists!";
        return;
    }

    if(existsUsername($db, $_POST['username'])) {
        header('Location: ../pages/register.php');
        echo "Username already exists!";
        return;
    }

    if(registerUser($db, $_POST['username'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'])) {
        echo "success";
        $_SESSION['user'] = $_POST['username'];
        header('Location: ../pages/login.php');
    } else {
        header('Location: ../pages/register.php');
        echo "Error registering user!";
    }

?>