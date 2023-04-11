<?php

require_once('../department.php');

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

function getLastDepartmentId(PDO &$db) : int {
    $stmt = $db->prepare(
        'SELECT id
        FROM department
        ORDER BY id DESC
        LIMIT 1'
    );
    $stmt->execute();
    return intval($stmt->fetch());
}

function addDepartment(PDO &$db, String &$name) :void {
    $stmt = $db->prepare(
        'INSERT INTO department(id, name)
        VALUES(?, ?)'
    );
    $stmt->execute(array(
        getLastDepartmentId($db) + 1,
        $name
    ));
}

?>