<?php

enum UserType {
    case Client;
    case Admin;
    case Agent;
}

class User {
    private int $id; 
    private String $username;
    private String $firstName;
    private String $lastName;
    private String $email;
    private UserType $type;

    public function getId() : int {
        return $this->id;
    }

    public function getUsername() : String {
        return $this->username;
    }

    public function getFirstName() : String {
        return $this->firstName;
    }

    public function getLastName() : String {
        return $this->lastName;
    }

    public function getEmail() : String {
        return $this->email;
    }

    public function getType() : UserType {
        return $this->type;
    }

    public function __construct(int $id, String &$username, String &$firstName, String &$lastName, String &$email, UserType $type) {
        $this->id = $id;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->type = $type;
    }

    /*static function &getUserByUsernamePass(PDO &$db, string $username, string $password) : User {
        //echo $username;
        $stmt = $db->prepare('SELECT * FROM users WHERE username = pcaddan0;');
        $stmt->execute();
        $user = $stmt->fetchAll();
        var_dump($user);
        
        return new User(
            $user['id'],
            $username,
            $user['first_name'],
            $user['last_name'],
            $user['email'],
            getUserType($db, $user['id']));
    }*/

}

?>