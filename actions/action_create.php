<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/user.php');
    require_once('../database/ticket.php');

    $db = getDatabaseConnection();

    if ($_SESSION['user'] == null){
        header('Location: ../pages/login.php');
        echo("Must be logged in!");
    }
    if ($_POST['subject'] == null){
        header('Location: ../pages/create.php');
        echo "Subject required!";
    }
    if ($_POST['content'] == null){
        header('Location: ../pages/create.php');
        echo "Content required!";
    } 
    if ($_POST['hashtag'] == null){
        header('Location: ../pages/create.php');
        echo "Hashtag required!";
    }
    else {
        echo "sucess";
        $hashtags = explode(',', $_POST['hashtag']);
        createTicket($db, getUser($db, $_SESSION['user'])->getId(), $_POST['subject'], $_POST['content'], $hashtags);
    }
?>