<?php

require_once('../department.php');

function getDepartmentAgents(PDO &$db, int $departmentId) : array {
    $stmt = $db->prepare('SELECT * FROM agent_department WHERE department_id = ?;');
    $stmt->execute(array($departmentId));
    $agentsRaw = $stmt->fetchAll();

    $agents = array();

    foreach ($agentsRaw as $agentRaw) {
        array_push($agents, getUser($db, $agentRaw['id']));
    }

    return $agents;
}

function getDepartmentAdmins(PDO &$db, int $departmentId) : array {
    $stmt = $db->prepare('SELECT * FROM admin_department WHERE department_id = ?;');
    $stmt->execute(array($departmentId));
    $adminsRaw = $stmt->fetchAll();

    $admins = array();

    foreach ($adminsRaw as $adminRaw) {
        array_push($admins, getUser($db, $adminRaw['id']));
    }

    return $admins;
}


function getDepartment(PDO &$db, int $id) : Department {
    $stmt = $db->prepare('SELECT * FROM department WHERE id = ?;');
    $stmt->execute(array($id));
    $department = $stmt->fetch();

    return new Department(
        $id,
        $department['name'],
        getDepartmentAgents($db, $id),
        getDepartmentAdmins($db, $id)
    );
}

?>