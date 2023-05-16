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

    header('Location: ../pages/faq_add.php');