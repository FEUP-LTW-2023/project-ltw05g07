<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/reply.php');

    $db = getDatabaseConnection();


    addReply(
        $db,
        $_POST['ticket_id'],
        $_POST['user_id'],
        $_POST['comment']
    );
    
    $_SESSION['user'] = $_POST['username'];
    $referer = $_SERVER['HTTP_REFERER'];
    header("Location: $referer");
    exit(0);
?>