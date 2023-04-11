<?php

require_once('../ticket.php');
require_once('../reply.php');

require_once('user.php');
require_once('reply.php');

require_once('utils.php');

function getTicket(PDO &$db, int $id) : Ticket {
    $stmt = $db->prepare('SELECT * FROM ticket WHERE id = ?;');
    $stmt->execute(array($id));
    $ticket = $stmt->fetchAll();

    $replies = getReplies($db, $id);

    return new Ticket(
        $id,
        $ticket['subject'],
        $ticket['content'],
        $ticket['hashtags'],
        $replies,
        getStatusHistory($db, $id),
        getDateTimeFromString($ticket['post_date']),
    );

}

?>