<?php
    function getDepartments($db) {
        $stmt = $db->prepare('SELECT * FROM DEPARTMENT');
        $stmt->execute();

        $departments =  $stmt->fetchAll();

        $result = array();
        foreach ($departments as $department) {
            $result[] = $department['name'];
        }

        return $result;
    }

    function getDepartmentsAgent($db, $aid) {
        $stmt = $db->prepare('SELECT * FROM AGENTDEPARTMENT WHERE aid = ?');
        $stmt->execute(array($aid));

        return $stmt->fetchAll();
    }

    function toggleDepartment($db, $aid, $department) {
        $stmt = $db->prepare('SELECT * FROM AGENTDEPARTMENT WHERE aid = ? AND department = ?');
        $stmt->execute(array($aid, $department));

        if (empty($stmt->fetch())) {
            $stmt = $db->prepare('INSERT INTO AGENTDEPARTMENT VALUES (?,?)');
            $stmt->execute(array($aid, $department));
        }
        else {
            $stmt = $db->prepare('DELETE FROM AGENTDEPARTMENT WHERE aid = ? AND department = ?');
            $stmt->execute(array($aid, $department));
        }

        return getDepartmentsAgent($db, $aid);
    }

    function getAgentsByDepartment($db, $department) {
        $stmt = $db->prepare('SELECT * FROM CLIENT c JOIN AGENTDEPARTMENT d ON (d.aID = c.uid) WHERE department = ?');
        $stmt->execute(array($department));

        return $stmt->fetchAll();
    }
?>    