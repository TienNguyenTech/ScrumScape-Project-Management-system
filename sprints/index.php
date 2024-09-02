<?php
global $dbh;
//require_once("../authentication.php");
require_once("../connection.php");

// Fetch sprints
$sprintsQuery = "SELECT * FROM sprints";
$sprintsStmt = $dbh->query($sprintsQuery);
$sprints = $sprintsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sprints</title>
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
<h1>Sprints</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Duration</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($sprints as $sprint): ?>
            <tr>
                <td><?= $sprint['id'] ?></td>
                <td><?= $sprint['name'] ?></td>
                <td><?= $sprint['start_date'] ?></td>
                <td><?= $sprint['end_date'] ?></td>
                <td><?= $sprint['status'] ?></td>
                <td><?= $sprint['duration'] ?></td>
                <td><?= $sprint['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p><a href="../logout.php">Logout</a></p>
</body>
</html>
