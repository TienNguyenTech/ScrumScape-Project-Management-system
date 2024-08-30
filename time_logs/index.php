<?php
global $dbh;
require_once("../authentication.php");
require_once("../connection.php");

// Fetch time logs
$timeLogsQuery = "SELECT * FROM time_logs";
$timeLogsStmt = $dbh->query($timeLogsQuery);
$timeLogs = $timeLogsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Time Logs</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Time Logs</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Task ID</th>
            <th>User ID</th>
            <th>Hours Spent</th>
            <th>Log Date</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($timeLogs as $timeLog): ?>
            <tr>
                <td><?= $timeLog['id'] ?></td>
                <td><?= $timeLog['task_id'] ?></td>
                <td><?= $timeLog['user_id'] ?></td>
                <td><?= $timeLog['hours_spent'] ?></td>
                <td><?= $timeLog['log_date'] ?></td>
                <td><?= $timeLog['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p><a href="../logout.php">Logout</a></p>
</body>
</html>
