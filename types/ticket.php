<?php

require_once('ticket_status.php');
require_once('reply.php');

class Ticket {
    public int $id;
    public int $user_id;
    public String $subject;
    public String $content;
    public array $hashtags;
    public array $replies;
    public array $statusHistory;
    public DateTime $date;

    public function getId() : int {
        return $this->id;
    }
    public function getAuthorId() : int {
        return $this->$user_id;
    }
    public function getSubject() : String {
        return $this->subject;
    }

    public function getContent() : String {
        return $this->content;
    }

    public function getHashtags() : array {
        return $this->hashtags;
    }

    public function getReplies() : array {
        return $this->replies;
    }

    public function getCurrentStatus() : TicketStatus {
        return end($this->statusHistory);
    }

    public function getStatusHistory() : array {
        return $this->statusHistory;
    }

    public function getDate() : DateTime {
        return $this->date;
    }

    public function __construct(int $id,int $user_id, String &$subject, String &$content, array &$hashtags, array &$replies, array &$statusHistory, DateTime &$date) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->subject = $subject;
        $this->content = $content;
        $this->hashtags = $hashtags;
        $this->replies = $replies;
        $this->statusHistory = $statusHistory;
        $this->date = $date;
    }
}

?>