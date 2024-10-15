<?php
ob_start();
session_start();
require('../auth.php');

require_once('../database/dao.php');
$dao = new DAO();

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $task = $dao->getTask($task_id);
}

?>