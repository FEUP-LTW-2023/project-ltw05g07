<?php

require_once('../types/user.php');

function isAdmin(PDO &$db, int $id) : bool {
    $stmt = $db->prepare('SELECT * FROM users JOIN admin ON users.id = admin.id WHERE users.id = ?;');
    $stmt->execute(array($id));
    return ($stmt->fetch() != null);
}

function isAgent(PDO &$db, int $id) : bool {
    $stmt = $db->prepare('SELECT * FROM users JOIN agent ON users.id = agent.id WHERE users.id = ?;');
    $stmt->execute(array($id));
    return ($stmt->fetch() != null);
}

function getUserType(PDO &$db, int $id) : UserType {
    return isAdmin($db, $id) ? UserType::Admin :
           (isAgent($db, $id) ? UserType::Agent :
           UserType::Client);
}

function &getUser(PDO &$db, int $id) : User {
    $stmt = $db->prepare('SELECT * FROM users WHERE id = ?;');
    $stmt->execute(array($id));
    $user = $stmt->fetchAll();
    
    return new User(
        $id,
        $user['username'],
        $user['first_name'],
        $user['last_name'],
        $user['email'],
        getUserType($db, $id));
}

?>