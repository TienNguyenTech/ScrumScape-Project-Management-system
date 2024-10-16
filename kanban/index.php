<?php
ob_start();
session_start();
require('../auth.php');
require_once('../database/dao.php');

$dao = new DAO();

$sprintId = $_GET['sprint_id'];
$currentSprint = $dao->getSprint($sprintId);
$tasks = $dao->getTasksBySprintId($sprintId);


//var_dump($currentSprint, '----------', $tasks);
//var_dump($tasks);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap">
    <title>Task Board</title>
    <script src="https://cdn.jsdelivr.net/npm/vega@5.20.2"></script>
    <script src="https://cdn.jsdelivr.net/npm/vega-lite@5.1.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/vega-embed@6.17.0"></script>

    <!-- Import pure.css -->
    <link rel="stylesheet" href="https://unpkg.com/purecss@2.0.3/build/pure-min.css"
        integrity="sha384-cg6SkqEOCV1NbJoCu11+bm0NvBRc8IYLRGXkmNrqUBfTjmMYwNKPWBTIKyw9mHNJ" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
        }

        body {
            background-color: #f4f4f4;
            /*padding: 20px;*/
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
            padding: 0 20px;
            border-radius: 8px;
            width: 25%;
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
            margin-right: -100px;
        }

        .in-dev {
            background-color: #E1982A;
        }

        .closed {
            background-color: #78e08f;
            margin-left:-100px;
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

        .urgent {
            background-color: darkred;
        }

        .important {
            background-color: #e74c3c;
        }

        .medium {
            background-color: #f39c12;
        }

        .low {
            background-color: #51ad57;
        }

        .vis-container {
            width: 100%;
        }


        .page {
            width: 1200px;
            background-color: white;
            margin: auto;
            padding: 50px;
            padding-top: 35px;
        }

        .description h2,
        h1 {
            margin-top: 0px;
        }



        .small-font {
            font-size: 14px;
        }

        .dragging {
            opacity: 0.5;
        }

        /* Add a dashed border to the column being dragged over */
        .dragover {
            border: 2px dashed #aaa;
        }
    </style>
</head>
<?php require_once("../dashboard/navbar.php"); ?>

<body>

    <div class="board-header mb-5 mt-5">
        <h1 style="color:black; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);"><?= $currentSprint->sprint_name ?></h1>
        <p style="color:black; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">Date:
            <?= date('d/m/Y', strtotime($currentSprint->start_date)) ?> to
            <?= date('d/m/Y', strtotime($currentSprint->end_date)) ?>
        </p>
    </div>



    <div class="board">

        <!-- To-Do Column -->
        <div class="column to-do" data-status="Not Started" ondragover="allowDrop(event)" ondrop="drop(event)">
            <div class="column-header">To-Do</div>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task->status == 'Not Started'): ?>
                    <div class="task-card" draggable="true" ondragstart="drag(event)" data-task-id="<?= $task->task_id ?>"
                        onclick="if (!event.target.closest('button'))  window.location='/kanban/update_task.php?id=<?= $task->task_id ?>';">
                        <h4><?= htmlspecialchars($task->task_name) ?></h4>
                        <p><?= htmlspecialchars($task->description) ?></p>
                        <span class="priority <?= strtolower($task->priority) ?>">
                            <?= ucfirst(htmlspecialchars($task->priority)) ?>
                        </span>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- In Development Column -->
        <div class="column in-dev" data-status="In Progress" ondragover="allowDrop(event)" ondrop="drop(event)">
            <div class="column-header">In Development</div>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task->status == 'In Progress'): ?>
                    <div class="task-card" draggable="true" ondragstart="drag(event)" data-task-id="<?= $task->task_id ?>"
                        onclick="if (!event.target.closest('button'))  window.location='/kanban/update_task.php?id=<?= $task->task_id ?>';">
                        <h4><?= htmlspecialchars($task->task_name) ?></h4>
                        <p><?= htmlspecialchars($task->description) ?></p>
                        <span class="priority <?= strtolower($task->priority) ?>">
                            <?= ucfirst(htmlspecialchars($task->priority)) ?>
                        </span>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <!-- Closed Column -->
        <div class="column closed" data-status="Completed" ondragover="allowDrop(event)" ondrop="drop(event)">
            <div class="column-header">Closed</div>
            <?php foreach ($tasks as $task): ?>
                <?php if ($task->status == 'Completed'): ?>
                    <div class="task-card" draggable="true" ondragstart="drag(event)" data-task-id="<?= $task->task_id ?>"
                        onclick="if (!event.target.closest('button'))  window.location='/kanban/update_task.php?id=<?= $task->task_id ?>';">
                        <h4><?= htmlspecialchars($task->task_name) ?></h4>
                        <p><?= htmlspecialchars($task->description) ?></p>
                        <span class="priority <?= strtolower($task->priority) ?>">
                            <?= ucfirst(htmlspecialchars($task->priority)) ?>
                        </span>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <style>
        .footer {
            display: flex;
            margin-top: 50px;
            justify-content: center;
        }

        .custom-btn {
                background-color: #1F6190;
                color: white;
            }
    </style>
    <div class="footer">
        <button class="btn custom-btn" onclick="location.reload();">Update Burndown Chart</button>
    </div>

    <div class="mt-4">
        <div
            style="display: flex; justify-content: center; margin: 50px; padding:50px; background-color: rgba(31, 175, 237, 0.3); backdrop-filter: blur(10px); box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: 1px solid rgba(255, 255, 255, 0.18); border-radius: 15px;">
            <div class="pure-u-1-2"> <!-- 24-24 (full width)-->
                <div id="vis1" class="vis-container"></div>
                <script type="text/javascript">
                    // Fetch data from the fetch_data.php file
                    // Assuming the script is located in the same directory

                    const url = new URL('kanban/burndown.php?sprint_id=' + <?php echo $_GET['sprint_id']; ?>, window.location.origin);
                    console.log(url.toString());

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data); // Check the fetched data structure
                            drawVegaLiteChart(data);
                        })
                        .catch(error => console.error('Error fetching data:', error));

                    // Function to draw Vega Lite chart using fetched data
                    function drawVegaLiteChart(data) {
                        const spec2 = {
                            "$schema": "https://vega.github.io/schema/vega-lite/v5.json",
                            "config": { "view": { "stroke": "" } },
                            "title": { "text": "Sprint Burndown Chart" },
                            "width": "container",
                            "height": 200,
                            "background": "transparent",
                            "data": {
                                "values": data
                            },
                            "layer": [
                                {
                                    "mark": {
                                        "type": "line",
                                        "point": true,
                                        "color": "#E1982A"  // Actual burndown line color
                                    },
                                    "encoding": {
                                        "x": {
                                            "field": "completion_date",
                                            "type": "temporal",
                                            "title": "Date",
                                            "axis": {
                                                "grid": false,  // Removes the X-axis line
                                                "ticks": false,    // Removes the X-axis ticks,
                                                "format": "%d/%m"  // Formats date as dd/mm
                                            }
                                        },
                                        "y": {
                                            "field": "remaining_points",
                                            "type": "quantitative",
                                            "title": "Remaining Story Points",
                                            "axis": {
                                                "grid": false,  // Removes the Y-axis line
                                                "ticks": false,   // Removes Y-axis ticks
                                                "orient": "left"  // Ensures the Y-axis is only on the left
                                            }
                                        },
                                        "color": {
                                            "field": "line_type",
                                            "type": "nominal",
                                            "scale": {
                                                "domain": ["Actual", "Expected"],
                                                "range": ["#E1982A", "#d46c6c"]  // Colors for actual and expected lines
                                            },
                                            "title": "Line Type"
                                        }
                                    }
                                },
                                {
                                    "mark": {
                                        "type": "line",
                                        "point": true,
                                        "color": "#d46c6c"  // Expected burndown line color
                                    },
                                    "encoding": {
                                        "x": {
                                            "field": "completion_date",
                                            "type": "temporal",
                                            "axis": {
                                                "grid": false,  // Removes the X-axis line
                                                "ticks": false    // Removes the X-axis ticks
                                            }
                                        },
                                        "y": {
                                            "field": "remaining_points",
                                            "type": "quantitative",
                                            "axis": null
                                        },
                                        "color": {
                                            "value": "#d46c6c"  // Color for expected line
                                        }
                                    },
                                    "transform": [
                                        {
                                            "filter": {
                                                "field": "line_type",
                                                "equal": "Expected"
                                            }
                                        }
                                    ]
                                }
                            ],
                            "resolve": {
                                "scale": {
                                    "y": "independent"
                                }
                            }
                        };

                        // Render the chart in the #vis div
                        vegaEmbed('#vis1', spec2).then(function (result) {
                            // Access the Vega view instance
                            console.log(result);
                        }).catch(console.error);
                    }
                </script>
            </div>
        </div>
    </div>

    <script>
        let draggedTask;

        function drag(event) {
            draggedTask = event.target;
            event.target.classList.add('dragging');
        }

        function allowDrop(event) {
            event.preventDefault();
            const column = event.target.closest('.column');
            if (column) {
                column.classList.add('dragover');
            }
        }

        function drop(event) {
            event.preventDefault();
            const column = event.target.closest('.column');
            column.classList.remove('dragover');

            if (draggedTask && column) {
                // Append the dragged task to the new column
                column.appendChild(draggedTask);
                draggedTask.classList.remove('dragging');

                // Update the task status in the backend (AJAX)
                const taskId = draggedTask.getAttribute('data-task-id');
                const newStatus = column.getAttribute('data-status');

                console.log(taskId, newStatus)

                // Send AJAX request to update task status in the database
                updateTaskStatus(taskId, newStatus);
            }
        }

        function updateTaskStatus(taskId, newStatus) {
            // Create an XMLHttpRequest object
            const xhr = new XMLHttpRequest();

            // Configure it: GET-request for the URL, including parameters
            xhr.open('GET', `update_task_status.php?taskId=${encodeURIComponent(taskId)}&newStatus=${encodeURIComponent(newStatus)}`, true);

            // xhr.onreadystatechange = function() {
            //     if (xhr.readyState === 4 && xhr.status === 200) {
            //         if (response.success) {
            //             console.log('Task status updated successfully.');
            //         } else {
            //             console.error('Error updating task status');
            //         }
            //     }
            // };
            xhr.send();
        }

    </script>
</body>

</html>