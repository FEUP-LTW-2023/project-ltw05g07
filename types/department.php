<?php

require_once('user.php');

class Department {
    private int $id;
    private String $name;
    private array $agents = array();
    private array $admins = array();
    
    public function getId() : int {
        return $this->id;
    }

    public function getName() : String {
        return $this->name;
    }

    public function getAgents() : array {
        return $this->agents;
    }

    public function getAdmins() : array {
        return $this->admins;
    }

    public function addAgent(User &$user) : void {
        $user->getType() == UserType::Agent ?
            array_push($this->agents, $user) :
            print('User is not an agent.\n');
    }

    public function addAdmin(User &$user) : void {
        $user->getType() == UserType::Admin ?
            array_push($this->admins, $user) :
            print('User is not an agent.\n');
    }

    public function __construct(int $id, String $name, array $agents, array $admins) {
        $this->id = $id;
        $this->name = $name;
        $this->agents = $agents;
        $this->admins = $admins;
    }
}

?>

