<?php

require_once('../types/ticket.php');
require_once('../database/ticket_status.php');
require_once('../types/reply.php');


require_once('user.php');
require_once('reply.php');
require_once('department.php');

require_once('utils.php');

function &getTicket(PDO &$db, int $id) : ?Ticket {
    $stmt = $db->prepare(
        'SELECT *
        FROM ticket
        WHERE id = ?;'
    );
    $stmt->execute(array($id));
    $ticket = $stmt->fetch();
    //print_r($ticket);
    //echo $ticket['id'];


    $replies = getReplies($db, $id);
    $statusHistory = getStatusHistory($db, $id);
    $dateTime = getDateTimeFromString($ticket['post_date']);
    //$hashtags = explode(',', $ticket['hashtags']);

    //echo sizeof($hashtags);
    //echo $ticket['user_id'];

   // print_r($hashtags);

    return new Ticket(
        $id,
        $ticket['user_id'],
        $ticket['subject'],
        $ticket['content'],
        //$hashtags,
        $ticket['department'],
        $replies,
        $statusHistory,
        $dateTime,
    );
}

function &getTicketDefault(PDO &$db, int $id) : ?Ticket {
    $stmt = $db->prepare(
        'SELECT *
        FROM ticket
        WHERE id = ?;'
    );
    $stmt->execute(array($id));
    $ticket = $stmt->fetch();
    //print_r($ticket);
    //echo $ticket['id'];
    $dateTime = getDateTimeFromString($ticket['post_date']);
    //$hashtags = explode(',', $ticket['hashtags']);

    //var_dump($dateTime);    

    //echo $dateTime->format('Y-m-d H:i:s');

    return new Ticket(
        $id,
        $ticket['user_id'],
        $ticket['subject'],
        $ticket['content'],
        //$hashtags,
        $ticket['department'],
        $dateTime,
        //$ticket['post_date'],
    );
}

function &getAllTickets(PDO &$db) : array {
    $stmt = $db->query('SELECT * FROM ticket');
    $tickets = array();

    while ($row = $stmt->fetch()) {
        $id = $row['id'];
        $ticket = getTicketDefault($db, $id);
        
        if ($ticket !== null) {
            $tickets[] = $ticket;
        }
    }
    //print_r($tickets);
    return $tickets;
}

function &getAllUserTicketsDefault(PDO &$db, int $id) : array {
    $stmt = $db->prepare(
        'SELECT *
        FROM ticket
        WHERE user_id = ?;'
    );
    $stmt->execute(array($id));

    $ticket_info = $stmt->fetchAll();
    $tickets = array();

    foreach($ticket_info as $ticket) {
        array_push($tickets, getTicketDefault($db, $ticket['id']));
    }

    return $tickets;
}

function getAllUserTickets(PDO &$db, int $id) {
    $stmt = $db->prepare(
        'SELECT *
        FROM ticket
        WHERE user_id = ?;'
    );
    $stmt->execute(array($id));

    $ticket_info = $stmt->fetchAll();
    $tickets = array();

    foreach($ticket_info as $ticket) {
        array_push($tickets, getTicket($db, $ticket['id']));
    }

    return $tickets;
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

function createTicket(PDO &$db, int $userId, String &$subject, String &$content, String &$departmentID) : void {
    $date = date('Y-m-d H:i:s'); 

    $stmt = $db->prepare(
        'SELECT *
        FROM department
        WHERE id = ?;'
    );
    $stmt->execute(array($departmentID));
    $department = $stmt->fetch();



    $stmt = $db->prepare(
        'INSERT INTO ticket(user_id, subject, content, department, post_date)
        VALUES(?, ?, ?, ?, ?);'
    );

    $stmt->execute(array(
        $userId,
        $subject,
        $content,
        $department['name'],
        //implode(',', $hashtags),
        $date
    ));

    $stmt = $db->prepare(
        'INSERT INTO ticket_status(status, change_status_date)
        VALUES(?, ?);'
    );

    $stmt->execute(array('open', $date));

    $stmt = $db->prepare(
        'SELECT t.id as t_id,
        ts.id as ts_id
        FROM ticket_status ts
        LEFT JOIN ticket t
        ORDER BY
        t.id DESC,
        ts.id DESC
        LIMIT 1;'
    );

    $stmt->execute();
    $ids = $stmt->fetch();

    $stmt = $db->prepare(
        'INSERT INTO ticket_ticket_status(ticket_id, ticket_status_id)
        VALUES(?, ?);'
    );

    print_r($ids);
    $stmt->execute(array($ids['t_id'], $ids['ts_id']));

}

function &getTicketbyUser(PDO &$db, int $user_id) : ?Ticket {
    $stmt = $db->prepare(
        'SELECT *
        FROM ticket
        WHERE user_id = ?
        ORDER by id DESC
        limit 1'
    );
    $stmt->execute(array($user_id));
    $ticket = $stmt->fetch();
    //print_r($ticket);
    //echo $ticket['id'];
    
    $id = $ticket['id'];
    $replies = getReplies($db, $id);
    $statusHistory = getStatusHistory($db, $id);
    $dateTime = getDateTimeFromString($ticket['post_date']);
    //$hashtags = explode(',', $ticket['hashtags']);
    

    //echo sizeof($hashtags);
    //echo $ticket['user_id'];

   // print_r($hashtags);

    return new Ticket(
        $id,
        $ticket['user_id'],
        $ticket['subject'],
        $ticket['content'],
        //$hashtags,
        $ticket['department'],
        $replies,
        $statusHistory,
        $dateTime,
    );
}

?>