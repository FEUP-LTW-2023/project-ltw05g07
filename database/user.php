<?php

require_once('../types/user.php');

function isAdmin(PDO &$db, int $id) : bool {
    $stmt = $db->prepare(
        'SELECT *
        FROM users
        JOIN admin
        ON users.id = admin.id
        WHERE users.id = ?;'
    );
    $stmt->execute(array($id));
    return ($stmt->fetch() != null);
}

function isAgent(PDO &$db, int $id) : bool {
    $stmt = $db->prepare(
        'SELECT *
        FROM users
        JOIN agent
        ON users.id = agent.id
        WHERE users.id = ?;'
    );
    $stmt->execute(array($id));
    return ($stmt->fetch() != null);
}

function getUserType(PDO &$db, int $id) : UserType {
    return isAdmin($db, $id) ? UserType::Admin :
        (isAgent($db, $id) ? UserType::Agent :
        UserType::Client);
}

function getUserDefault(PDO &$db, int|String $idOrUsername) : User {
    if (is_int($idOrUsername)) {
        $stmt = $db->prepare('SELECT * FROM users WHERE id = ?;');
    } else if (is_string($idOrUsername)) {
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?;');
    }

    $stmt->execute(array($idOrUsername));
    $user = $stmt->fetch();

    
    return new User(
        $user['id'],
        $user['username'],
        $user['password'],
        $user['first_name'],
        $user['last_name'],
        $user['email']);
}

function getUser(PDO &$db, int|String $idOrUsername) : User {
    if (is_int($idOrUsername)) {
        $stmt = $db->prepare('SELECT * FROM users WHERE id = ?;');
    } else if (is_string($idOrUsername)) {
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?;');
    }

    $stmt->execute(array($idOrUsername));
    $user = $stmt->fetch();
    
    return new User(
        $user['id'],
        $user['username'],
        $user['password'],
        $user['first_name'],
        $user['last_name'],
        $user['email'],
        getUserType($db, $user['id']));
}

function getAllUsers(PDO &$db) : array {
    $stmt = $db->query('SELECT * FROM users');
    $users = array();

    while ($row = $stmt->fetch()) {
        $id = $row['id'];
        $user = getUserDefault($db, $id);

        
        if ($user !== null) {
            $users[] = $user;
        }
    }
    //print_r($tickets);
    return $users;
}



function existsEmail(PDO &$db, string $email) : bool {
    $stmt = $db->prepare('SELECT * FROM users WHERE email = ?;');
    $stmt->execute(array($email));
    return ($stmt->fetch() != null);
}

function existsUsername(PDO &$db, string $username) : bool {
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?;');
    $stmt->execute(array($username));
    return ($stmt->fetch() != null);
}

function validEmail(string $email) : bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) != false;
}

function validPassword(string $pass) {
    return strlen($pass) >= 8;
}

function validUsername(string $username) {
    return preg_match ('/^[a-z][a-z0-9_]+$/', $username);
}

function validName(string $name) {
    return preg_match ('/^[a-zA-Z]+$/', $name);
}

function addUser(PDO &$db, String &$username, String &$firstName, String &$lastName, String &$email, String &$password, UserType $type = UserType::Client) : void {
    
    $stmt = $db->prepare(
        'INSERT INTO users(username, first_name, last_name, email, password)
        VALUES (?, ?, ?, ?, ?);'
    );

    $stmt->execute(array(
        $username,
        $firstName,
        $lastName,
        $email,
        password_hash($password, PASSWORD_DEFAULT)
    ));

    switch ($type) {
        case UserType::Client:
            $stmt = $db->prepare('INSERT INTO client(id) VALUES(?);');
            break;
        case UserType::Admin:
            $stmt = $db->prepare('INSERT INTO admin(id) VALUES(?);');
            break;
        case UserType::Agent:
            $stmt = $db->prepare('INSERT INTO agent(id) VALUES(?);');
            break;
    }

    $stmt->execute(array(getUser($db, $username)->getId()));
}
function updateUserType(PDO &$db, int $userId, UserType $newType): void {
    // Delete existing user type entry for the given user
    $deleteStmt = $db->prepare('DELETE FROM client WHERE id = ?;');
    $deleteStmt->execute([$userId]);

    $deleteStmt = $db->prepare('DELETE FROM admin WHERE id = ?;');
    $deleteStmt->execute([$userId]);

    $deleteStmt = $db->prepare('DELETE FROM agent WHERE id = ?;');
    $deleteStmt->execute([$userId]);

    // Insert new user type entry based on the new type
    switch ($newType) {
        case UserType::Client:
            $insertStmt = $db->prepare('INSERT INTO client(id) VALUES(?);');
            break;
        case UserType::Admin:
            $insertStmt = $db->prepare('INSERT INTO admin(id) VALUES(?);');
            break;
        case UserType::Agent:
            $insertStmt = $db->prepare('INSERT INTO agent(id) VALUES(?);');
            break;
    }

    $insertStmt->execute([$userId]);
}