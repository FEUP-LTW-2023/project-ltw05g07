<?php

require_once('../database/connection.php');
require_once('../database/ticket.php');
require_once('../database/department.php');
require_once('../types/ticket_status.php');
///require_once('../database/user.php');

$db = getDatabaseConnection();

//console.log($_GET['department']);
//echo $_GET['department'];   

$departmentFilter = $_GET['department'];
$sortDate = isset($_GET['sort']) ? $_GET['sort'] : 'newest'; 
$stateFilter = $_GET['state'];


if ($departmentFilter === 'all') {
    $tickets = getAllTickets($db);
} else {
    $tickets = getTicketsFromDepartment($db, intval($departmentFilter));
}



//print_r($tickets);

//print_r($tickets);
usort($tickets, function ($a, $b) use ($sortDate) {
    if ($sortDate === 'newest') {
        return $b->date->getTimestamp() - $a->date->getTimestamp();
    } elseif ($sortDate === 'oldest') {
        return $a->date->getTimestamp() - $b->date->getTimestamp();
    }
    return 0;
});
/*
usort($tickets, function ($a, $b) use ($sortDate) {
    if ($sortDate === 'newest') {
        return strtotime($b->date) - strtotime($a->date);
    } elseif ($sortDate === 'oldest') {
        return strtotime($a->date) - strtotime($b->date);
    }
    return 0;
});*/

//print_r($tickets);
//print_r($tickets);
/*$updatedTickets = [];
array_push($updatedTickets, $tickets[0]);

print_r($updatedTickets);*/

//$updatedTickets = [];
foreach ($tickets as $ticket) {
    //$ticketArray = get_object_vars($tickets[0]);
    $userID = $ticket->user_id; // Assuming the user ID is stored in the 'user_id' field of the ticket
    // Retrieve the user data using the getUser function
    $userData = getUserDefault($db, intval($userID));

    $state = getLatestState($db, $ticket->id);
    //echo($userData->type->name);
    //print_r($state->name);

    $stateString = $state->toString();

    //$userArray = get_object_vars($userData);

    $ticket->user = $userData;
    $ticket->state = $stateString;
    //echo $ticket->state;

    //$ticket->date = $ticket->date->format('Y-m-d H:i:s');


    //$ticket->user->type = $userData->type->name;


    // Associate the user data with the ticket
    //$updatedTicket = array_merge($ticket, ['user' => $userData]);

    // Add the updated ticket to the array
    //array_push($tickets, $ticket);
}


if ($stateFilter !== 'all') {
    $filteredTickets = array_filter($tickets, function ($ticket) use ($stateFilter) {
        return $ticket->state === $stateFilter;
    });
    $tickets = array_values($filteredTickets);
}


//print_r($tickets);

header('Content-Type: application/json');
echo json_encode($tickets);

/*if ($tickets === false) {
    echo "fuck";
    echo json_last_error_msg();
} else {
    echo $tickets;
    exit();
}*/

?>