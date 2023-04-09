<?php

require_once('ticket_status.php');
require_once('reply.php');

class Ticket {
    private int $id;
    private String $subject;
    private String $content;
    private array $hashtags;
    private array $replies;
    private array $statusHistory;
    private DateTime $date;

    public function getId() : int {
        return $this->id;
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

    public function addReply(Reply &$reply) {
        array_push($this->replies, $reply);
    }

    public function updateStatus(TicketStatus &$status) {
        array_push($this->statusHistory, $status);
    }

    public function __construct(int $id, String &$subject, String &$content, array &$hashtags, DateTime &$date) {
        $this->id = $id;
        $this->subject = $subject;
        $this->content = $content;
        $this->$hashtags = $hashtags;
        $this->date = $date;
    }
}

?>