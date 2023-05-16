<?php

require_once('user.php');

class Department {
    private int $id;
    private String $name;
    private array $agents;
    private array $admins;
    
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

    public function __construct(int $id, String &$name, array &$agents, array &$admins) {
        $this->id = $id;
        $this->name = $name;
        $this->agents = $agents;
        $this->admins = $admins;
    }
}

?>

