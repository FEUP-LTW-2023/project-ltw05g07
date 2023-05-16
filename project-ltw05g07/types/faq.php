<?php
class FAQ{
    public int $id;
    public String $question;
    public String $answer;
    public function getId() : int {
        return $this->id;
    }

    public function getQuestion() : String {
        return $this->question;
    }

    public function getAnswer() : String {
        return $this->answer;
    }

    public function __construct(int $id, String &$question, String &$answer) {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
        
    }
}

?>