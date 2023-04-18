<?php

enum UserType {
    case Client;
    case Admin;
    case Agent;
}

class User {
    private int $id; 
    private String $username;
    private String $passwordHash;
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