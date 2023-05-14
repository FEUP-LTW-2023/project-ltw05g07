<?php
    session_start();

    require_once('../database/connection.php');
    require_once('../database/faq.php');
    $db = getDatabaseConnection();
    
    addFAQ(
        $db,
        $_POST['question'],
        $_POST['answer']
    );
