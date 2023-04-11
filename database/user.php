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

function &getUser(PDO &$db, int $id) : User {
    $stmt = $db->prepare(
        'SELECT *
        FROM users
        WHERE id = ?;'
    );
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

function getLastUserId(PDO &$db) : int {
    $stmt = $db->prepare(
        'SELECT id
        FROM users
        ORDER BY id DESC
        LIMIT 1;'
    );
    $stmt->execute();
    $id = $stmt->fetch();
    return intval($id);
}

function addUser(PDO &$db, String &$username, String &$firstName, String &$lastName, String &$email, UserType $type = UserType::Client, String &$password) : void {
    
    $id = getLastUserId($db) + 1;
    
    $stmt = $db->prepare(
        'INSERT INTO users(id, username, first_name, last_name, email, password)
        VALUES (?, ?, ?, ?, ?, ?);'
    );
    $stmt->execute(array(
        $id,
        $username,
        $firstName,
        $lastName,
        $email,
        $password
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

    $stmt->execute(array($id));
}