<?php
ob_start();
session_start();
require('../auth.php');
require_once('../database/dao.php');

$dao = new DAO();

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];
    }
    else {
        $start_date = (new DateTime())->format('Y-m-d');
        $end_date = (new DateTime('-2 weeks'))->format('Y-m-d');
    }



    $result = $dao->getUserHours($user_id, $start_date, $end_date);

    
    // Prepare data for the actual burndown line (remaining points)
    $data = [];


    if (!empty($result)) {
        foreach ($result as $row) {

            $data[] = [
                "date" => $row->date,
                "hours" => (int)$row->total_hours,
            ];
        }
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit;

} 
?>
