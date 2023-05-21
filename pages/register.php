<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: home.php');
    exit(0);
}

include_once('../templates/common_tpl.php');
include_once('../templates/auth_tpl.php');

common_header();
register();
common_footer();
?>