<?php

session_start();

include_once('../templates/common_tpl.php');
include_once('../templates/auth_tpl.php');

common_header();
register();
common_footer();
?>