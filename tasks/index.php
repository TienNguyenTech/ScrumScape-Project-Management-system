<?php
global $dbh;
//require_once("../authentication.php");
require_once("../connection.php");

// Fetch tasks
$tasksQuery = "SELECT * FROM tasks";
$tasksStmt = $dbh->query($tasksQuery);
$tasks = $tasksStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tasks</title>
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
<h1>Tasks</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Weight</th>
            <th>Tag</th>
            <th>Priority</th>
            <th>Assignee ID</th>
            <th>Description</th>
            <th>Status</th>
            <th>Stage</th>
            <th>Sprint ID</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tasks as $task): ?>
            <tr>
                <td><?= $task['id'] ?></td>
                <td><?= $task['name'] ?></td>
                <td><?= $task['type'] ?></td>
                <td><?= $task['weight'] ?></td>
                <td><?= $task['tag'] ?></td>
                <td><?= $task['priority'] ?></td>
                <td><?= $task['assignee_id'] ?></td>
                <td><?= $task['description'] ?></td>
                <td><?= $task['status'] ?></td>
                <td><?= $task['stage'] ?></td>
                <td><?= $task['sprint_id'] ?></td>
                <td><?= $task['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p><a href="../logout.php">Logout</a></p>
</body>
</html>
