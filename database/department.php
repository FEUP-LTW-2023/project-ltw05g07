<?php

require_once('../types/department.php');

function &getDepartmentAgents(PDO &$db, int $departmentId) : array {
    $stmt = $db->prepare(
        'SELECT id
        FROM agent_department
        WHERE department_id = ?;'
    );
    $stmt->execute(array($departmentId));
    $agentIds = $stmt->fetchAll();

    $agents = array();

    foreach ($agentIds as $id) {
        array_push($agents, getUser($db, $id));
    }

    return $agents;
}

function &getDepartmentAdmins(PDO &$db, int $departmentId) : array {
    $stmt = $db->prepare(
        'SELECT id
        FROM admin_department
        WHERE department_id = ?;'
    );
    $stmt->execute(array($departmentId));
    $adminIds = $stmt->fetchAll();

    //print_r($adminIds->id);

    $admins = array();

    foreach ($adminIds as $id) {
        array_push($admins, getUser($db, $id));
    }

    return $admins;
}

function &getDepartment(PDO &$db, int $id) : Department {
    $stmt = $db->prepare(
        'SELECT *
        FROM department
        WHERE id = ?;'
    );
    $stmt->execute(array($id));
    $department = $stmt->fetch();

    $agents = getDepartmentAgents($db, $id);
    $admins = getDepartmentAdmins($db, $id);

    return new Department(
        $id,
        $department['name'],
        $agents,
        $admins
    );
}

function addDepartment(PDO &$db, String &$name) :void {
    $stmt = $db->prepare(
        'INSERT INTO department(name)
        VALUES(?);'
    );
    $stmt->execute(array($name));
}

function getUniqueDepartments(PDO &$db) : array {
    $stmt = $db->prepare(
        'SELECT *
        FROM department;'
    );
    $stmt->execute();
    $departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //print_r($departments);


    return $departments;
}

function getTicketsFromDepartment(PDO &$db, int $departmentId) : array {
    $stmt = $db->prepare(
        'SELECT ticket_id
        FROM ticket_department
        WHERE department_id = ?;'
    );
    $stmt->execute(array($departmentId));
    $ticketIds = $stmt->fetch(PDO::FETCH_ASSOC);

    //print_r($ticketIds);

    //echo sizeof($ticketIds);


    $tickets = array();

    foreach ($ticketIds as $id) {
        array_push($tickets, getTicketDefault($db, $id));
    }

    //print_r($tickets);

    return $tickets;
}



?>