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

    function &getUserByUsernamePass(PDO &$db, string $username, string $password) : ?User {
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?;');
        $stmt->execute(array($username));
        $user = $stmt->fetch();
        
        if($user && password_verify($password, $user['password'])){
            echo "success";
            return new User(
                intval($user['id']),
                $username,
                $user['first_name'],
                $user['last_name'],
                $user['email'],
                getUserType($db, $user['id']));
        }
        echo "shit";
        return null;
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

?>