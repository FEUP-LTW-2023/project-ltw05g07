<?php 

require_once('../templates/common_tpl.php');
require_once('../templates/ticket_tpl.php');
require_once('../database/connection.php');
require_once('../database/ticket.php');
require_once('../database/user.php');
require_once('../types/user.php');

session_start();

if ($_SESSION['username'] == null) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit(0);
}

$db = getDatabaseConnection();
$user = getUser($db, $_SESSION['username']);
$tickets = getAllUserTickets($db, $user->getId());

common_header(); ?>

<div class="user-info">
    <h1><?=$user->getFirstName() . ' ' . $user->getLastName()?></h1>
    <h2><?='@' . $user->getUsername()?></h2>
    <h3><?='Permissions: ' . $user->getType()->toString()?></h3>
    <?php foreach ($tickets as $ticket) content($ticket, false)?>
</div>


<?php common_footer(); ?> 