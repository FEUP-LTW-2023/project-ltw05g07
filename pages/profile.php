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
<script src="../script/profile_menu.js"></script>
<div class="user-info">
    <h1><?=$user->getFirstName() . ' ' . $user->getLastName()?></h1>
    <h2><?='@' . $user->getUsername()?></h2>

</div>
<div id="sse1">
  <div id="sses1">
    <ul>
        <li><a href="?menu=1&skin=2&p=Javascript-Menus" onclick="loadContent(event, 'my-tickets')">My Tickets</a></li>
        <li><a href="?menu=1&skin=2&p=Horizontal-Menus" onclick="loadContent(event, 'users')">Users</a></li>
        <li><a href="?menu=1&skin=2&p=Web-Menus" onclick="loadContent(event, 'web-menus')">Web Menus</a></li>
    </ul>
  </div>
</div>
<div id = "ticket_list"></div>
<div id = "user_list"></div>


<?php common_footer(); ?> 