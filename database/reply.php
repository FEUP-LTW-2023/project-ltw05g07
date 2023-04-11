<?php

require_once('utils.php');

function getReplies(PDO &$db, int $ticketId) : array {
    $stmt = $db->prepare('SELECT * FROM reply WHERE ticket_id = ?;');
    $stmt->execute(array($ticketId));
    $repliesRaw = $stmt->fetchAll();

    $replies = array();

    foreach($repliesRaw as $replyRaw) {
        array_push($replies, new Reply(
            $replyRaw['id'],
            getUser($db, $replyRaw['user_id']),
            $replyRaw['comment'],
            getDateTimeFromString($replyRaw['reply_date']),
        ));
    }

    return $replies;
}

?>