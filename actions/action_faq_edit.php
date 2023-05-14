<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/faq.php');
    $db = getDatabaseConnection();


    Update(
        $db,
        $_POST['id'],
        $_POST['question'],
        $_POST['answer']
    );

    $_SESSION['user'] = $_POST['username'];
    $referer = $_SERVER['HTTP_REFERER'];
    header("Location: $referer");
    exit(0);