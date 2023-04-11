<?php

enum TicketState {
    case Open;
    case Assigned;
    case Closed;
    case Resolved;
}

class TicketStatus {
    private int $id;
    private TicketState $state;
    private DateTime $date;

    public function getId() : int {
        return $this->id;
    }

    public function getState() : TicketState {
        return $this->state;
    }

    public function getDate() : DateTime {
        return $this->date;
    }

    public function __construct(int $id, TicketState $state, DateTime $date) {
        $this->id = $id;
        $this->state = $state;
        $this->date = $date;
    }
}

?>