<?php

session_start(); 

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit(0);
}

include_once('../templates/create_ticket_tpl.php');
include_once('../templates/common_tpl.php');
require_once('../database/connection.php');
require_once('../database/department.php');

$db = getDatabaseConnection();
$departments = getUniqueDepartments($db);

common_header();
create($departments);
common_footer();
?>