<?php
class Reply {
    private int $id;
    private User $author;
    private String $comment;
    private DateTime $date;

    public function getId() : int {
        return $this->id;
    }

    public function getAuthor() : User {
        return $this->author;
    }

    public function getComment() : String {
        return $this->comment;
    }

    public function getDate() : DateTime {
        return $this->date;
    }

    public function __construct(int $id, User $author, String &$comment, DateTime $date) {
        $this->id = $id;
        $this->author = $author;
        $this->comment = $comment;
        $this->date = $date;
    }
}
?>