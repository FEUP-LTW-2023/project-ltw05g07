<?php

require_once('../database/user.php');
require_once('../database/connection.php');
require_once('../types/user.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $userType = $_POST['userType'];
    $userId = $_POST['userId'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];

    //echo $userId;
  

    $user = getUser($db, intval($userId));

    updateUser($db,intval($userId), $username, $firstName, $lastName, $email, $userType);


    // Update the user information in the database or data source
    // ...

    // Redirect to a success page or perform other actions
    header('Location: ../pages/profile.php');
    exit;
}
?>