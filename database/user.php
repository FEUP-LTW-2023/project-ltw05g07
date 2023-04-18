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

    function &existsEmail(PDO &$db, string $email) : bool {
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ?;');
        $stmt->execute(array($email));
        return ($stmt->fetch() != null);
    }

    function &existsUsername(PDO &$db, string $username) : bool {
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?;');
        $stmt->execute(array($username));
        return ($stmt->fetch() != null);
    }

    function &registerUser(PDO &$db, string $username, string $first_name, string $last_name, string $email, string $password) : bool {
        $stmt = $db->prepare('INSERT INTO users (username, first_name, last_name, email, password) VALUES (?, ?, ?, ?, ?);');
        return $stmt->execute(array($username, $first_name, $last_name, $email, password_hash($password, PASSWORD_DEFAULT)));;
    }

    function validEmail(string $email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function validPassword(string $pass) {
        return strlen($pass) >= 8;
    }

    function validUsername(string $username) {
        return preg_match ('/^[a-z][a-z0-9_]+$/', $username);
    }

    function validFirstName(string $first_name) {
        return preg_match ('/^[a-zA-Z]+$/', $first_name);
    }

    function validLastName(string $last_name) {
        return preg_match ('/^[a-zA-Z]+$/', $last_name);
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