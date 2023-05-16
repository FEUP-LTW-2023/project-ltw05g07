<?php

require_once('utils.php');

function &getReplies(PDO &$db, int $ticketId) : array {
    $stmt = $db->prepare(
        'SELECT * 
        FROM reply 
        WHERE ticket_id = ?;'
    );
    $stmt->execute(array($ticketId));
    $repliesRaw = $stmt->fetchAll();

    $replies = array();

    foreach($repliesRaw as $replyRaw) {
        $user = getUser($db, $replyRaw['user_id']);
        $date = getDateTimeFromString($replyRaw['reply_date']);

        array_push($replies, new Reply(
            $replyRaw['id'],
            $user,
            $replyRaw['comment'],
            $date,
        ));
    }

    return $replies;
}

function addReply(PDO &$db, int $ticketId, int $userId, String &$comment) : void {
    $stmt = $db->prepare(
        'INSERT INTO reply(ticket_id, user_id, comment, reply_date)
        VALUES(?, ?, ?, ?);'
    );
    $stmt->execute(array(
        $ticketId,
        $userId,
        $comment,
        date('Y-m-d H:i:s')
    ));
}

?>