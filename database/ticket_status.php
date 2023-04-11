<?php 

require_once('../ticket.php');
require_once('../ticket_status.php');

require_once('utils.php');

function getTicketState(String $stateString) : ?TicketState {
    switch ($stateString) {
        case 'open':
            return TicketState::Open;
        case 'closed':
            return TicketState::Closed;
        case 'assigned':
            return TicketState::Assigned;
        case 'resolved':
            return TicketState::Resolved;
        default:
            return null;
    }
}

function getStatusHistory(PDO &$db, int $ticketId) : array {
    $stmt = $db->prepare('SELECT * FROM ticket_ticket_status JOIN ticket_status ON ticket_ticket_status.ticket_status_id = ticket_status.id WHERE ticket_id = ?;');
    $stmt->execute(array($ticketId));
    $statusHistoryRaw = $stmt->fetchAll();

    $statusHistory = array();

    foreach($statusHistoryRaw as $statusRaw) {
        array_push($statusHistory, new TicketStatus (
            $statusRaw['ticket_status_id'],
            getTicketState($statusRaw['status']),
            getDateTimeFromString($statusRaw['change_status_date'])
        ));
    }

    return $statusHistory;
}

?>