<?php

session_start();

require_once('../database/connection.php');
require_once('../database/ticket.php');
require_once('../database/department.php');
require_once('../types/ticket_status.php');

$db = getDatabaseConnection();

$user = getUser($db, $_SESSION['username']);

$tickets = getAllUserTicketsDefault($db, $user->getId());

foreach ($tickets as $ticket) {
    $userID = $ticket->user_id; 
    $userData = getUserDefault($db, intval($userID));
    $state = getLatestState($db, $ticket->id);
    $stateString = $state->toString();
    $ticket->user = $userData;
    $ticket->state = $stateString;
}


header('Content-Type: application/json');
echo json_encode($tickets);

?>