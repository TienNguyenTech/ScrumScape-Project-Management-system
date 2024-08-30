<?php
global $dbh;
require_once("../connection.php");
require_once("../authentication.php");

$queryStudentsWithSchools = "SELECT
        `st`.`id`, `st`.`first_name`, `st`.`surname`, `st`.`home_address`, `st`.`parent_phone`, `st`.`parent_email`, `st`.`date_of_birth`, `st`.`subscribed`,
        `sc`.`name` AS `school_name`,
        COUNT(`cs`.`course_id`) AS `number_courses`
    FROM `students` `st`
    LEFT JOIN `schools` `sc` ON `st`.`school_id` = `sc`.`id`
    LEFT JOIN `courses_students` `cs` ON `cs`.`student_id` = `st`.`id`
    GROUP BY `st`.`id`
    ORDER BY `st`.`id` ASC";

$stmt = $dbh->prepare($queryStudentsWithSchools);
$stmt->execute();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>List Students</title>

    <style>
        table, tr, th, td {
            border: 1px black solid;
        }
    </style>
</head>
<body>
<p><a href="../index.php">Back to Homepage</a> <a href="add.php">Add new student</a></p>
<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">First Name</th>
        <th scope="col">Surname</th>
        <th scope="col">Home Address</th>
        <th scope="col">Parent Phone/Mobile</th>
        <th scope="col">Parent Email</th>
        <th scope="col">Date of Birth</th>
        <th scope="col">Subscribed?</th>
        <th scope="col">School</th>
        <th scope="col"># Courses Enrolled</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $stmt->fetchObject()): ?>
        <tr>
            <th scope="row"><?= $row->id ?></th>
            <td class="student-firstname"><?= $row->first_name ?></td>
            <td class="student-surname"><?= $row->surname ?></td>
            <td><?= $row->home_address ?></td>
            <td><?= $row->parent_phone ?></td>
            <td><?= $row->parent_email ?></td>
            <td><?= ($row->date_of_birth) ? (new DateTime($row->date_of_birth))->format('j M o') : "" ?></td>
            <td><?= $row->subscribed ? "Yes" : "No" ?></td>
            <td><?= ($row->school_name) ?? "<i>No School</i>" ?></td>
            <td><?= $row->number_courses ?></td>
            <td><a href="update.php?id=<?= $row->id ?>">Update</a> <a href="delete.php?id=<?= $row->id ?>" class="delete-student">Delete</a></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
<script>
    // Add a confirmation box to all delete buttons
    Array.from(document.getElementsByClassName('delete-student')).forEach((element) => {
        element.addEventListener('click', (event) => {
            // Get student full name from the table row
            let buttonParent = event.target.parentNode.parentNode;
            let studentFullName = buttonParent.querySelector('.student-firstname').textContent + " " + buttonParent.querySelector('.student-surname').textContent;
            // Render the dialog box
            if (!confirm('Are you sure to delete the student "' + studentFullName + '"?'))
                event.preventDefault();  // If the user cancel the dialog box, do nothing
        })
    });
</script>
</body>
</html>
