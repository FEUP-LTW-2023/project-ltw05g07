<?php

session_start();

require_once('../database/user.php');
require_once('../database/connection.php');

$db = getDatabaseConnection();

if (isset($_GET['firstName'])) {
    echo json_encode(array(
        'result' => validName($_GET['firstName'])
    ));
} else if (isset($_GET['lastName'])) {
    echo json_encode(array(
        'result' => validName($_GET['lastName'])
    ));
} else if (isset($_GET['username'])) {
    echo json_encode(array(
        'result' => validUsername($_GET['username']) &&
        !existsUsername($db, $_GET['username'])
    ));
} else if (isset($_GET['email'])) {
    echo json_encode(array(
        'result' => validEmail($_GET['email']) &&
                    !existsEmail($db, $_GET['email'])
    ));
} else if (isset($_GET['password'])) {
    echo json_encode(array(
        'result' => validPassword($_GET['password'])
    ));
}

?>