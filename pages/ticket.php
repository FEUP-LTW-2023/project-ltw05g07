<?php

session_start(); 

    require_once('../database/connection.php');
    require_once('../database/ticket.php');
    require_once('../database/reply.php');
    require_once('../database/ticket_status.php');
    require_once('../database/user.php');
    include_once('../templates/common_tpl.php');
    include_once('../templates/ticket_tpl.php');

    $db = getDatabaseConnection();


    $ticket = getTicket($db, $_GET['id']);
    $user = getUser($db, $ticket->user_id);
    $state = getLatestState($db, $ticket->id);
    //print_r($user);

    common_header();
    content($ticket, $user, $state);
    common_footer();
?>