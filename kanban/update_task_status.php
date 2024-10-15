<?php

require_once('../database/dao.php');

var_dump($_GET);
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $taskId = $_GET['taskId'];
    $newStatus = $_GET['newStatus'];

    $dao = new DAO();
    $dao->updateTaskStatus($taskId, $newStatus);

    if($newStatus == "Completed") {
        $dao->updateTaskCompletionDate($taskId);
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
