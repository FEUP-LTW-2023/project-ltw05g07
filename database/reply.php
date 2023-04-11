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

function getLastReplyId(PDO &$db) : int {
    $stmt = $db->prepare(
        'SELECT *
        FROM reply
        ORDER BY id DESC
        LIMIT 1;'
    );
    $stmt->execute();
    $reply = $stmt->fetch();
    return intval($reply['id']);
}

function addReply(PDO &$db, int $ticketId, int $userId, String &$comment) : void {
    $stmt = $db->prepare(
        'INSERT INTO reply(id, ticket_id, user_id, comment, reply_date)
        VALUES(?, ?, ?, ?, ?);'
    );
    $stmt->execute(array(
        getLastReplyId($db) + 1,
        $ticketId,
        $userId,
        $comment,
        date('Y-m-d H:i:s')
    ));
}

?>