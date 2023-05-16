<?php
session_start();

    require_once('../database/connection.php');
    require_once('../database/faq.php');
    $db = getDatabaseConnection();

    DeleteEntry(
        $db,
        $_POST['id']
    );