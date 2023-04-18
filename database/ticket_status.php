<?php 

require_once('../ticket.php');
require_once('../ticket_status.php');

require_once('utils.php');

function &getStatusHistory(PDO &$db, int $ticketId) : array {
    $stmt = $db->prepare(
        'SELECT *
        FROM ticket_ticket_status
        JOIN ticket_status
        ON ticket_ticket_status.ticket_status_id = ticket_status.id
        WHERE ticket_id = ?;'
    );
    $stmt->execute(array($ticketId));
    $statusHistoryRaw = $stmt->fetchAll();

    $statusHistory = array();

    foreach($statusHistoryRaw as $statusRaw) {
        array_push($statusHistory, new TicketStatus (
            $statusRaw['ticket_status_id'],
            TicketState::fromString($statusRaw['status']),
            getDateTimeFromString($statusRaw['change_status_date'])
        ));
    }

    uasort($statusHistory, function($a, $b) {
        $d1 = $a->getDate();
        $d2 = $b->getDate();

        if ($d1 == $d2) return 0;
        return $d1 < $d2 ? 1 : -1;
    });

    return $statusHistory;
}

function getLatestState(PDO &$db, int $ticketId) : TicketState {
    $stmt = $db->prepare(
        'SELECT status
        FROM ticket_status
        LEFT JOIN ticket_ticket_status
        ON ticket_status.id = ticket_ticket_status.ticket_status_id
        WHERE ticket_id = ?
        ORDER BY ticket_status_id 
        LIMIT 1;'
    );
    $stmt->execute(array($ticketId));
    $state = $stmt->fetch();
    return TicketState::fromString($state);
}

function updateStatus(PDO &$db, int $ticketId, ?TicketState $state = null) : void {
    $stmt = $db->prepare(
        'INSERT INTO ticket_status(status, change_status_date) 
        ALUES(?, ?);');
    

    $stmt->execute(array(
        $state?->toString() ?? getLatestState($db, $ticketId)->toString(),
        date('Y-m-d H:i:s')
    ));

    $stmt = $db->prepare(
        'SELECT id
        FROM ticket_status
        ORDER BY id DESC
        LIMIT 1;'
    );

    $stmt->execute();
    $ticketStateId = $stmt->fetch()['id'];

    $stmt = $db->prepare(
        'INSERT INTO ticket_ticket_status(ticket_id, ticket_status_id)
        VALUES(?, ?, ?);'
    );

    $stmt->execute(array(
        $ticketId,
        $ticketStateId
    ));

}

?>