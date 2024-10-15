<?php
ob_start();
session_start();
require('../auth.php');

require_once('../database/dao.php');
$dao = new DAO();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hours = $_POST['logHours'];
    $userId = $_POST['userId'];
    $taskId = $_POST['taskId'];


    $dao->logHours($taskId,$userId,$hours);
}

?>