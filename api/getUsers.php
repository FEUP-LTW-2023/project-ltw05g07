<?php

session_start();

require_once('../database/connection.php');
require_once('../database/ticket.php');
require_once('../database/department.php');
require_once('../types/ticket_status.php');

$db = getDatabaseConnection();

$user = $_SESSION['user_id'];

$users = getAllUsers($db);

foreach ($users as $user) {
    $user->typestr = getUserType($db, $user->id)->toString();
}

header('Content-Type: application/json');
echo json_encode($users);

?>