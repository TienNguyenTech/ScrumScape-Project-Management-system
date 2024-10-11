<?php
ob_start();
session_start();
require('../auth.php');
require_once('../database/dao.php');

$dao = new DAO();

if (isset($_GET['user_id']) && isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $user_id = $_GET['user_id'];
    $user_id = $_GET['start_date'];
    $user_id = $_GET['end_date'];


    $result = $dao->getUserHours($user_id, $start_date, $end_date);

    
    // Prepare data for the actual burndown line (remaining points)
    $data = [];


    if (!empty($result)) {
        foreach ($result as $row) {
            $data[] = [
                "date" => $row->date,
                "hours" => $row->total_hours,
            ];
        }
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;

} 
?>
