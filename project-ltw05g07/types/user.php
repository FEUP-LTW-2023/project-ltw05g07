<?php

enum UserType {
    case Client;
    case Admin;
    case Agent;
}

class User {
    public int $id; 
    public String $username;
    public String $passwordHash;
    public String $firstName;
    public String $lastName;
    public String $email;
    public UserType $type;

    public function getId() : int {
        return $this->id;
    }

    public function getUsername() : String {
        return $this->username;
    }

    public function verifyCredentials(String $password) : bool {
        return password_verify($password, $this->passwordHash);
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

    public function __construct(int $id, String &$username, String &$passwordHash, String &$firstName, String &$lastName, String &$email, UserType $type) {
        $this->id = $id;
        $this->username = $username;
        $this->passwordHash = $passwordHash;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->type = $type;
    }
}

?>