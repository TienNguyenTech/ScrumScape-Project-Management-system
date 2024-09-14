<?php
//require('../database/authentication.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">User Details</h2>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>User ID</th>
            <th>Email</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Admin</th>
        </tr>
        </thead>
        <tbody>
        <!-- Example Static Data -->
        <tr>
            <td>1</td>
            <td>john.doe@example.com</td>
            <td>admin</td>
            <td>John</td>
            <td>Doe</td>
            <td>Yes</td>
        </tr>
        <tr>
            <td>2</td>
            <td>jane.doe@example.com</td>
            <td>jane_d</td>
            <td>Jane</td>
            <td>Doe</td>
            <td>No</td>
        </tr>
        <tr>
            <td>3</td>
            <td>alex.smith@example.com</td>
            <td>alex_s</td>
            <td>Alex</td>
            <td>Smith</td>
            <td>No</td>
        </tr>

        <!-- Dynamically load user data from database here -->
        <?php
        // Sample PHP code for fetching user data from database
        // $conn = new mysqli('hostname', 'username', 'password', 'database');
        // $result = $conn->query("SELECT * FROM USER");
        // while ($row = $result->fetch_assoc()) {
        //     echo "<tr>";
        //     echo "<td>" . $row['user_id'] . "</td>";
        //     echo "<td>" . $row['user_email'] . "</td>";
        //     echo "<td>" . $row['user_name'] . "</td>";
        //     echo "<td>" . $row['user_fname'] . "</td>";
        //     echo "<td>" . $row['user_lname'] . "</td>";
        //     echo "<td>" . ($row['admin'] ? 'Yes' : 'No') . "</td>";
        //     echo "</tr>";
        // }
        ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
