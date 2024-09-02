<?php
global $dbh;
//require_once("../authentication.php");
require_once("../connection.php");

// Fetch students
$studentsQuery = "SELECT * FROM students";
$studentsStmt = $dbh->query($studentsQuery);
$students = $studentsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Students</title>
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
<h1>Students</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student['id'] ?></td>
                <td><?= $student['name'] ?></td>
                <td><?= $student['email'] ?></td>
                <td><?= $student['role'] ?></td>
                <td><?= $student['created_at'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<p><a href="../logout.php">Logout</a></p>
</body>
</html>
