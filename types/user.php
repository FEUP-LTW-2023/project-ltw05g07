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

    public function getType() : UserType {
        return $this->type;
    }

    public function __construct(int $id, String &$username, String &$firstName, String &$lastName, UserType $type) {
        $this->id = $id;
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->type = $type;
    }

}

?>