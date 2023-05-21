<?php

require_once('../database/connection.php');
require_once('../database/ticket.php');
require_once('../database/department.php');
require_once('../types/ticket_status.php');

$db = getDatabaseConnection();

$departmentFilter = $_GET['department'];
$sortDate = isset($_GET['sort']) ? $_GET['sort'] : 'newest'; 
$stateFilter = $_GET['state'];


if ($departmentFilter === 'all') {
    $tickets = getAllTickets($db);
} else {
    $tickets = getTicketsFromDepartment($db, intval($departmentFilter));
}

usort($tickets, function ($a, $b) use ($sortDate) {
    if ($sortDate === 'newest') {
        return $b->date->getTimestamp() - $a->date->getTimestamp();
    } elseif ($sortDate === 'oldest') {
        return $a->date->getTimestamp() - $b->date->getTimestamp();
    }
    return 0;
});

foreach ($tickets as $ticket) {
    $userID = $ticket->user_id; 
    $userData = getUserDefault($db, intval($userID));

    $state = getLatestState($db, $ticket->id);

    $stateString = $state->toString();

    $ticket->user = $userData;
    $ticket->state = $stateString;
}


if ($stateFilter !== 'all') {
    $filteredTickets = array_filter($tickets, function ($ticket) use ($stateFilter) {
        return $ticket->state === $stateFilter;
    });
    $tickets = array_values($filteredTickets);
}


header('Content-Type: application/json');
echo json_encode($tickets);

?>