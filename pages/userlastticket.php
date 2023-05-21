<?php

session_start(); 

require_once('../database/connection.php');
require_once('../database/ticket.php');
require_once('../database/reply.php');
require_once('../database/ticket_status.php');
require_once('../database/user.php');
include_once('../templates/common_tpl.php');
include_once('../templates/ticket_tpl.php');

if (isset($_SESSION['username'])) {
    $db = getDatabaseConnection();
    $ticket = getTicketbyUser($db, getUser($db, $_SESSION['username'])->getId());

    common_header();
    content($ticket);
    common_footer();
}

else header('Location: ../pages/login.php');
?>