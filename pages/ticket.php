<?php
    require_once('../database/connection.php');
    require_once('../database/ticket.php');
    include_once('../templates/common_tpl.php');
    include_once('../templates/ticket_tpl.php');

    $db = getDatabaseConnection();


    $ticket = getTicket($db, $_GET['id']);

    common_header();
    content($ticket);
    common_footer();
?>