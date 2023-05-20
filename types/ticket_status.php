<?php

enum TicketState {
    case Open;
    case Assigned;
    case Closed;
    case Solved;

    public function toString() : String {
        return match($this) {
            TicketState::Open => 'open',
            TicketState::Assigned => 'assigned',
            TicketState::Closed => 'closed',
            TicketState::Solved => 'solved'
        };
    }

    public static function fromString(String &$stateString) : TicketState {
        return match($stateString) {
            'open' => TicketState::Open,
            'assigned' => TicketState::Assigned,
            'closed' => TicketState::Closed,
            'solved' => TicketState::Solved
        };
    }
}

class TicketStatus {
    public int $id;
    public TicketState $state;
    public DateTime $date;

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