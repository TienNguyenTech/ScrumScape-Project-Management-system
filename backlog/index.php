<?php
ob_start();
session_start();
require('../auth.php');

require_once('../database/dao.php');
$dao = new DAO();
$tasks = $dao->getAllTasks();
//var_dump(count($tasks));

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    if ($dao->deleteTask($task_id)) {
        header("Location: index.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Backlog Page</title>

    <!-- Bootstrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #F5F5F5;
        }

        .header-search {
            display: flex; 
            align-items: center;
            gap:10px; 
            padding-top: 5%;
        }

        .header-search h1 {
            font-family: "Montserrat";
            color: #1F6190;
            width: 60%;
        }

        .search-bar { /* fix*/
            border-radius: 25px;
            background-color: #E8E8E8;
            border: 0px;
            margin-right: 25px;
        }
        .custom-btn {
            background-color:#1F6190;
            color:white; 
        }

        .custom-btn:hover {
            background-color: #0A6C9C;
            color:white;
        }

        .table-header {
            background-color: #0888C7;
            margin-top: 40px;
            border-radius: 7px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 50px;
            padding-right: 5%;
            padding-left: 2.5%;
        }

        .table-header h4 {
            font-family: "Lexend";
            font-size:15px;
            color: white;
        }

        .table-row {
            background-color: #FDF8F8;
            border-radius: 7px;
            border: 1px solid #E8E8E8;
            align-items: center;
            padding-top: 15px;
            display: flex;
            justify-content: space-between;
            height: 50px;
            padding-right: 2.5%;
            padding-left: 2.5%;
        }

        .table-row p{
            font-family: "Montserrat";   
            font-weight: 450;
        }

        .table-row button {
            padding: 0; 
            border: none; 
            background: none;
            cursor: pointer; 
            display: flex;
            align-items: center;
        }

        .task-buttons {
            display: flex;
            gap: 5px;
            padding-bottom: 10px;
            padding-right: 15px;
        }

        .btn-outline-warning:hover {
            color: white;
        }

        .btn-filter {
            color: #19526E;
        }

        .btn-filter:hover {
            color: white;
        }

        .header-icons {
            width: 18px; margin-right: 10px; margin-bottom: 3px;
        }
        .no-hover {
            pointer-events: none;
        }
        .custom-row {
            background-color: #FDF8F8;
            border-radius: 7px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 50px;
            padding-left: 2.5%;
            margin-top: 2px;
        }
        .custom-row td:first-child {
            border-top-left-radius: 7px;
            border-bottom-left-radius: 7px;
        }
        .custom-row td:last-child {
            border-top-right-radius: 7px;
            border-bottom-right-radius: 7px;
        }
        .truncate {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            margin-right: 2%;
        }
        .table-cell {
            flex: 1;
        }
        .time-indicator {
            position: absolute;
            background-color: #ffcb3b;
            border: 1px solid #ffc107;
            border-radius: 5px;
            padding: 5px 10px;
            margin-right: 270px;
            width: 150px;
            transition: opacity 0.3s ease;
        }
    </style>
</head>

<body>
    
    <?php
    require_once("../dashboard/navbar.php");
        ?>

    <div class="container mb-5">
        <!-- Product Backlog Title, Searchbar and Button-->
        <div class="header-search">
            <h1>Product Backlog</h1>
            <input class="form-control search-bar col-sm-3" id="taskSearchInput" type="text" placeholder="Search Task" onkeyup="searchTasks()">
            <a href="create_task.php"> <button type="button" class="btn custom-btn">+ Add Task</button></a>
        </div>

            <!--Task table header-->
        <table class="table" style="margin-bottom: 0">
            <thead>
            <tr class="table-header">
                <th class="d-flex align-items-center" style="border: none">
                    <h4 class="mb-0"><img src="/assets/task_icon.svg" class="header-icons"/>Task Name</h4>
                </th>
                <th class="d-flex align-items-center" style="border: none">
                    <h4 class="mb-0"><img src="/assets/storypt_icon.svg" class="header-icons"/>Story Points</h4>
                </th>
                <th class="d-flex align-items-center" style="border: none">
                    <h4 class="mb-0"><img src="/assets/priority_icon.svg" class="header-icons"/>Priority</h4>
                </th>
                <th class="d-flex align-items-center" style="border: none">
                    <h4 class="mb-0"><img src="/assets/actions_task.svg" class="header-icons"/>Actions</h4>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tasks as $task): ?>
            <tr class="custom-row">
                <td class="d-flex align-items-center truncate table-cell task-name" style="border: none;">
                    <?= htmlspecialchars($task->task_name); ?>
                </td>

                <td class="d-flex align-items-center table-cell" style="border: none">
                    <div style="margin-left: 70px;">
                        <?php
                        if ($task->story_points == NULL) {
                            echo '-';
                        }
                        else {
                            echo htmlspecialchars((int)$task->story_points);
                        }
                        ?>
                    </div>
                </td>
                <td class="d-flex align-items-center table-cell " style="border: none;">
                    <div style="margin-left: 82px;">
                        <span style="margin-right: 5px">
                        <?php
                            if($task->priority == "Urgent") {
                        ?>      <img src="/assets/red-f.svg"/>
                        <?php
                            }
                        if($task->priority == "Medium") {
                            ?>      <img src="/assets/yello1-f.svg"/>
                            <?php
                        }
                        if($task->priority == "Low") {
                            ?>      <img src="/assets/green-f.svg"/>
                            <?php
                        }
                        if($task->priority == "Important") {
                            ?>      <img src="/assets/yell-f.svg"/>
                            <?php
                        }
                        ?>
                        </span>
                        <?=htmlspecialchars($task->priority); ?>
                    </div>
                </td>
                <td class="d-flex align-items-center table-cell justify-content-center" style="border: none; gap: 4px">
                    <button type="button" class="btn btn-outline-warning" style="padding:5px;border: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                        </svg>
                        <span class="visually-hidden"></span>
                    </button>
                    <div id="timeIndicator" class="time-indicator" style="display: none;">
                        <?php
                            $date = new DateTime($task->created_at);
                            echo "Created on:" . '<br>';
                            echo $date->format('d/m/y') . ' | ';
                            echo $date->format('H:i');
                        ?>
                    </div>
                    <a href="update_task.php?id=<?= htmlspecialchars($task->task_id); ?>"">
                        <button type="button" class="btn btn-outline-primary" style="padding:7px; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                            <span class="visually-hidden"></span>
                        </button>
                    </a>
                    <a href="index.php?id=<?= htmlspecialchars($task->task_id); ?>" onclick="return confirm('Are you sure you want to delete this task?');">
                    <button type="button" class="btn btn-outline-danger" style="padding:7px; border: none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                        </svg>
                        <span class="visually-hidden"></span>
                    </button>
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const timeButtons = document.querySelectorAll('.btn-outline-warning');
            timeButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const timeIndicator = e.target.closest('tr').querySelector('.time-indicator');
                    if (timeIndicator.style.display === 'none' || timeIndicator.style.display === '') {
                        timeIndicator.style.display = 'block';
                    } else {
                        timeIndicator.style.display = 'none';
                    }
                });
            });
        });
        function searchTasks() {
            let input = document.getElementById('taskSearchInput');
            let filter = input.value.toLowerCase();
            let rows = document.querySelectorAll('.custom-row');

            rows.forEach(row => {
                const taskName = row.querySelector('.task-name').textContent.toLowerCase();
                // console.log(taskName)
                if (taskName.includes(filter)) {
                    // console.log("found")
                    row.style.display = "";
                } else {
                    // console.log("found")
                    row.style.display = "none";
                }
            });

        }
    </script>
</body>
</html>