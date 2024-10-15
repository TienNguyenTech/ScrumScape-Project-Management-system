<?php
ob_start();
session_start();
require('../auth.php');
require_once('../database/dao.php');

$dao = new DAO();

if (isset($_GET['sprint_id'])) {
    $sprint_id = $_GET['sprint_id'];

    // Get sprints and their associated tasks
    $sprint = $dao->getSprint($sprint_id); // Implement this method in your DAO

    $data = [];


    $sprint_id = $sprint->sprint_id;
    $start_date = $sprint->start_date;
    $end_date = $sprint->end_date;

    // Get total story points for the sprint
    $total_story_points = $dao->getTotalStoryPoints($sprint_id)->total_story_points;

    // Get completed story points grouped by date
    $result = $dao->getCompleteSprintPoints($sprint_id, $start_date, $end_date);

    
    // Prepare data for the actual burndown line (remaining points)
    $actualData = [];
    $cumulativeCompletedPoints = 0;

    $actualData[] = [
    "completion_date" => $start_date,
    "remaining_points" => (int)$total_story_points,
    "line_type" => "Actual"
    ];

    if (!empty($result)) {
        foreach ($result as $row) {
            // Calculate remaining points by subtracting cumulative completed points from total story points
            $cumulativeCompletedPoints += $row->tot_story_points;
            $remainingPoints = $total_story_points - $cumulativeCompletedPoints;

            $actualData[] = [
                "completion_date" => $row->completion_date,
                "remaining_points" => (int)$remainingPoints,
                "line_type" => "Actual"
            ];
        }
    }

    // Prepare data for the expected burndown line
    $expectedData = [
        [
            "completion_date" => $start_date,
            "remaining_points" => (int)$total_story_points,
            "line_type" => "Expected"
        ],
        [
            "completion_date" => $end_date,
            "remaining_points" => 0,
            "line_type" => "Expected"
        ]
    ];


    // Merge actual and expected data if there is actual data
    $data = array_merge($actualData, $expectedData);
    


    header('Content-Type: application/json');
    echo json_encode($data);
    exit;


} 
?>
