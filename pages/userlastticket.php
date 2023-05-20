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
    if(isset($_SESSION['username'])){
    $ticket = getTicketbyUser($db,getUser($db, $_SESSION['username'])->getId());
    /*getUser($db, $_SESSION['username'])->getId()*/
    $user = getUser($db, $ticket->user_id);
    $state = getLatestState($db, $ticket->id);
    //print_r($user);

    common_header();
    content($ticket, $user, $state);
    common_footer();

    }
    else header('Location: ../pages/login.php');
?>