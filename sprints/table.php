<?php
ob_start();
require('../database/authentication.php');

// Activate the session
//session_start();
require_once('../database/dao.php');
$dao = new DAO();

$sprints = $dao->getAllSprints();

?>

<!DOCTYPE html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="../assets/logo-sm.png">
<!--    <link rel="stylesheet" href="./styles.css">-->
    <style>
        body {
            font-family: 'Lexend', sans-serif;
            background-color: #f4f4f4;
            height: 100vh;
            margin: 0;
        }

        .header {
            color: white;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            height: 70px;
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9js-JOlLed4a0hLYt-YkdopyN3EVPRzBTRaERMwu3P6emcrSx');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 25px;
        }

        .container {
            background-color: white;
            width: 750px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 50px;
        }


        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            font-weight: bold;
        }

        td {
            border: none;
        }

        .view-more {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
        }

        .view-more button {
            background-color: #1fafed;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        .view-more button:hover {
            background-color: #1a56d1;
        }

        .sprint-card-middle {
            background-color: #A1E8F8;
            padding: 10px 5px;
            height:20px;
            margin: 15px 0;
        }

        .sprint-card-left {
            background-color: #A1E8F8;
            border-radius: 15px 0 0 15px;
            padding: 10px 5px;
            height:20px;
            margin: 15px 0;
        }

        .sprint-card-right {
            background-color: #A1E8F8;
            border-radius: 0 15px 15px 0;
            padding: 10px 5px;
            height:20px;
            margin: 15px 0;
        }

        .icon img {
            width: 20px;
            cursor: pointer;
        }


    </style>
</head>
<body>

<div class="container">
    <div class="header">
        MY SPRINTS
    </div>

    <table>
        <thead>
        <tr>
            <th>Sprint No.</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Edit/View</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($sprints): ?>
            <?php foreach ($sprints as $sprint): ?>
                <tr>
                    <td class="sprint-card-left"><?= htmlspecialchars($sprint->sprint_no) ?></td>
                    <td class="sprint-card-middle"><?= htmlspecialchars($sprint->status) ?></td>
                    <td class="sprint-card-middle"><?= htmlspecialchars($sprint->start_date) ?></td>
                    <td class="sprint-card-middle"><?= htmlspecialchars($sprint->end_date) ?></td>
                    <td class="sprint-card-right icon">
                        <a href="/sprints/kanban.html">
<!--                        <a href="edit_sprint.php?sprint_no=--><?php //= htmlspecialchars($sprint->sprint_no) ?><!--">-->
                            <img src="https://cdn-icons-png.freepik.com/256/8256/8256321.png" alt="Edit Icon">
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No sprints found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>