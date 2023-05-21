<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/user.php');
    require_once('../database/ticket.php');

    $db = getDatabaseConnection();

    if ($_SESSION['username'] == null){
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

    if ($_POST['department'] == null){
        header('Location: ../pages/create.php');
        echo "Department required!";
    }
    else {
        echo "sucess";
        //$hashtags = explode(',', $_POST['hashtag']);
        createTicket($db, getUser($db, $_SESSION['username'])->getId(), $_POST['subject'], $_POST['content'], $_POST['department']/*$hashtags*/);
    }

    header('Location: ../pages/userlastticket.php');
?>