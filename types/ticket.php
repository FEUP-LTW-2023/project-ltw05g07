<?php

require_once('ticket_status.php');
require_once('reply.php');

class Ticket {
    public int $id;
    public int $user_id;
    public String $subject;
    public String $content;
    //public array $hashtags;
    public String $department;

    public array $replies;
    public array $statusHistory;
    public DateTime $date;

    public function getId() : int {
        return $this->id;
    }
    public function getAuthorId() : int {
        return $this->user_id;
    }
    public function getSubject() : String {
        return $this->subject;
    }

    public function getContent() : String {
        return $this->content;
    }

    public function getDepartment() : String {
        return $this->department;
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

    public function __construct()
    {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();

        if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }

    public function __construct8(int $id,int $user_id, String &$subject, String &$content, String &$department, array &$replies, array &$statusHistory, DateTime &$date) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->subject = $subject;
        $this->content = $content;
        $this->department = $department;
        $this->replies = $replies;
        $this->statusHistory = $statusHistory;
        $this->date = $date;
    }

    public function __construct6(int $id,int $user_id, String &$subject, String &$content, String &$department, DateTime &$date) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->subject = $subject;
        $this->content = $content;
        $this->department = $department;
        $this->date = $date;
    }
}

?>