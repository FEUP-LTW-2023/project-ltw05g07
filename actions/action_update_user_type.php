<?php

require_once('../database/user.php');
require_once('../database/connection.php');
require_once('../types/user.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $newType = $_POST['userType'];
  $userId = $_POST['userId'];

  $newType = UserType::fromString($newType);

  $user = getUser($db, intval($userId)); 
  $result = updateUserType($db,intval($userId), $newType);




  $referer = $_SERVER['HTTP_REFERER'];
  header("Location: $referer");
  exit;
}
?>
