<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/user.php');

    $db = getDatabaseConnection();


    if($_SESSION['username'] == null){
        header('Location: ../pages/login.php');
        echo("Must be logged in!");
    }
    if($_POST['subject'] == null){
        header('Location: ../pages/create.php');
        echo "Subject required!";
    }
    if($_POST['content'] == null){
        header('Location: ../pages/create.php');
        echo "Content required!";
    } 
    if($_POST['hastag'] == null){
        header('Location: ../pages/create.php');
        echo "Hashtag required!";
    }
    else {
        echo "sucess";
        createTicket($db,$_SESSION['id'],$_POST['subject'],$_POST['content'],$_POST['hashtag']);
    }
?>