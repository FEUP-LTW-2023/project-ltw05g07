<?php
require_once('../database/connection.php');
require_once('../database/user.php');
require_once('../database/ticket.php');
require_once('../database/department.php');
require_once('../templates/common_tpl.php');
require_once('../templates/home_tpl.php');

$db = getDatabaseConnection();

$departments = getUniqueDepartments($db);

//print_r($departments);

//$admins = getDepartmentAdmins($db, 1);
//print_r($admins);



//$tickets = getTicketsFromDepartment($db, intval("4"));

//print_r($tickets);

common_header();
mainview($departments);
common_footer();


?>