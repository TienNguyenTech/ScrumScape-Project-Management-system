<?php
ob_start();
session_start();
require('../auth.php');

require_once('../database/dao.php');
$dao = new DAO();
$tasks = $dao->getAllTasks();

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap">
    <title>Task Board</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open sans', sans-serif;
        }

        body {
            background-color: #f4f4f4;
            padding: 20px;
        }

        .board-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .board-header h1 {
            font-size: 2em;
            margin-bottom: 5px;
        }

        .board-header p {
            font-size: 1.2em;
            color: #555;
        }

        .board {
            display: flex;
            justify-content: space-around;
            gap: 20px;
        }

        .column {
            background-color: #ffffff;
            padding: 10px;
            border-radius: 8px;
            width: 30%;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .column-header {
            font-size: 1.5em;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
            color: white;
        }

        .to-do {
            background-color: #f57c7c;
        }

        .in-dev {
            background-color: #f7d794;
        }

        .closed {
            background-color: #78e08f;
        }

        .task-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: box-shadow 0.3s;
        }

        .task-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .task-card h4 {
            font-size: 1.2em;
            margin-bottom: 5px;
        }

        .task-card p {
            font-size: 0.9em;
            margin-bottom: 10px;
            color: #666;
        }

        .priority {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.8em;
            font-weight: bold;
            color: white;
        }

        .critical {
            background-color: #e74c3c;
        }

        .medium {
            background-color: #f39c12;
        }

        .low {
            background-color: #51ad57;
        }
    </style>
</head>
<body>

    <div class="board-header">
        <h1>Project Name</h1>
        <p>Sprint 1, Date: 23/08/24 to 23/09/24</p>
    </div>

    <div class="board">
        <div class="column">
            <div class="column-header to-do">To-do List</div>

            <div class="task-card">
                <h4>TASK TITLE</h4>
                <span class="priority critical">Critical</span>
            </div>

            <div class="task-card">
                <h4>TASK TITLE</h4>
                <span class="priority low">Low</span>
            </div>

            <div class="task-card">
                <h4>TASK TITLE</h4>
                <span class="priority medium">Medium</span>
            </div>
        </div>

        <div class="column">
            <div class="column-header in-dev">In-Development</div>

            <div class="task-card">
                <h4>TASK TITLE</h4>
                <span class="priority low">Low</span>
            </div>

            <div class="task-card">
                <h4>TASK TITLE</h4>
                <span class="priority medium">Medium</span>
            </div>

            <div class="task-card">
                <h4>TASK TITLE</h4>
                <span class="priority critical">Critical</span>
            </div>
        </div>

        <div class="column">
            <div class="column-header closed">Closed/Done</div>

            <div class="task-card">
                <h4>TASK TITLE</h4>
                <span class="priority medium">Medium</span>
            </div>

            <div class="task-card">
                <h4>TASK TITLE</h4>
                <span class="priority low">Low</span>
            </div>

            <div class="task-card">
                <h4>TASK TITLE</h4>
                <span class="priority critical">Critical</span>
            </div>
        </div>
    </div>
</body>
</html>
