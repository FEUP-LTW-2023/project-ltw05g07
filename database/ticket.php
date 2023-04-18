<?php

require_once('../types/ticket.php');
require_once('../types/reply.php');

require_once('user.php');
require_once('reply.php');

require_once('utils.php');

function &getTicket(PDO &$db, int $id) : Ticket {
    $stmt = $db->prepare(
        'SELECT *
        FROM ticket
        WHERE id = ?;'
    );
    $stmt->execute(array($id));
    $ticket = $stmt->fetchAll();

    $replies = getReplies($db, $id);
    $statusHistory = getStatusHistory($db, $id);
    $dateTime = getDateTimeFromString($ticket['post_date']);
    $hashtags = explode(',', $ticket['hashtags']);

    return new Ticket(
        $id,
        $ticket['subject'],
        $ticket['content'],
        $hashtags,
        $replies,
        $statusHistory,
        $dateTime,
    );
}

function getLastTicketId(PDO &$db) : int {
    $stmt = $db->prepare(
        'SELECT id
        FROM ticket
        ORDER BY id DESC
        LIMIT 1;'
    );
    $stmt->execute();
    return intval($stmt->fetch());
}

function createTicket(PDO &$db, int $userId, String &$subject, String &$content, array &$hashtags) : void {
    $stmt = $db->prepare(
        'INSERT INTO ticket(user_id, subject, content, hashtags, post_date)
        VALUES(?, ?, ?, ?, ?);'
    );

    $stmt->execute(array(
        $userId,
        $subject,
        $content,
        implode(',', $hashtags),
        date('Y-m-d H:i:s')
    ));
}

?>