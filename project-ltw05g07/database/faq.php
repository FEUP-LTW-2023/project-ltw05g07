<?php 

require_once('../types/faq.php');

function addFAQ(PDO &$db, String &$question, String &$answer): void {
if (isset($_POST["submit"]))
{
    $question = $_POST["question"];
    $answer = $_POST["answer"];
    $query = 'INSERT INTO faq (question, answer) VALUES (:question, :answer)';

    $stmt = $db->prepare($query);

    $stmt->bindParam(':question',$question);
    $stmt->bindParam(':answer',$answer);

    if($stmt->execute()){
        header('Location:../pages/faq_add.php');
    }

}
}

function getFAQ(PDO &$db) : array{
    $sql = "SELECT * FROM faq ORDER BY id DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $faq = $stmt->fetchAll();

    return $faq;
}

function getRow(PDO &$db, int &$id) :array{
    $sql = "SELECT * FROM faq WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        $_REQUEST["id"]
    ]);
    $faq = $stmt->fetch();
 
    if (!$faq)
    {
        die("FAQ not found");
    }
    return $faq;
}

function Update(PDO &$db,int &$id, String &$question, String &$answer){
    if (isset($_POST["submit"])){

    $sql = "UPDATE faq SET question = ?, answer = ? WHERE id = ?";
    $db = $db->prepare($sql);
    $db->execute([
        $_POST["question"],
        $_POST["answer"],
        $_POST["id"]
    ]);
}
}

function DeleteEntry(PDO &$db,int &$id){
    $sql = "SELECT * FROM faq WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        $_REQUEST["id"]
    ]);
    $faq = $stmt->fetch();
 
    if (!$faq)
    {
        die("FAQ not found");
    }
 
    $sql = "DELETE FROM faq WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        $_POST["id"]
    ]);
 
    header('Location:../pages/faq_add.php');
}
?>
