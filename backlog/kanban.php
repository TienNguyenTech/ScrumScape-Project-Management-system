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


if (isset($_GET['sprint_id'])) {
    $sprint_id = $_GET['sprint_id'];
    $row = $dao->getSprint($sprint_id);
    $start_date = $row->start_date;
    $end_date = $row->end_date;

    // Get total story points for the sprint
    $total_story_points = $dao->getTotalStoryPoints($sprint_id)->total_story_points;

    // Get completed story points grouped by date
    $result = $dao->getCompleteSprintPoints($sprint_id, $start_date, $end_date);

    // Prepare data for the actual burndown line (remaining points)
    $actualData = array();
    $cumulativeCompletedPoints = 0;
    
    foreach ($result as $row) {
        // Calculate remaining points by subtracting cumulative completed points from total story points
        $cumulativeCompletedPoints += $row->tot_story_points;
        $remainingPoints = $total_story_points - $cumulativeCompletedPoints;
        
        $actualData[] = array(
            "completion_date" => $row->completion_date,
            "remaining_points" => $remainingPoints,
            "line_type" => "Actual"  // This will differentiate actual vs expected line
        );
    }

    // Prepare data for the expected burndown line
    $expectedData = array(
        array(
            "completion_date" => $start_date,
            "remaining_points" => (int)$total_story_points,
            "line_type" => "Expected"
        ),
        array(
            "completion_date" => $end_date,
            "remaining_points" => 0,
            "line_type" => "Expected"
        )
    );

    // Merge the actual and expected data
    $data = array_merge($actualData, $expectedData);

    // Output the JSON data for Vega Lite
    echo json_encode($data);
}



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

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
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

    <div class="pure-g">
      <div class="pure-u-1-1"> <!-- 24-24 (full width)-->
        <h1>Burndown Chart</h1> 
        <div id="vis" class = "vis-container"></div>
        <script>
            // Fetch data from the same PHP file
            fetch(window.location.href + '&fetch_data=true')
                .then(response => response.json())
                .then(data => {
                    drawVegaLiteChart(data);
                });

            // Function to draw Vega Lite chart using fetched data
            function drawVegaLiteChart(data) {
                const spec = {
                    "$schema": "https://vega.github.io/schema/vega-lite/v5.json",
                    "config": {"view": {"stroke": ""}},
                    "title": {"text": "Sprint Burndown Chart"},
                    "width": "container",
                    "height": 500,
                    "data": {
                        "values": data
                    },
                    "layer": [
                        {
                            "mark": {
                                "type": "line",
                                "point": true,
                                "color": "blue"  // Actual burndown line color
                            },
                            "encoding": {
                                "x": {
                                    "field": "completion_date",
                                    "type": "temporal",
                                    "title": "Date"
                                },
                                "y": {
                                    "field": "remaining_points",
                                    "type": "quantitative",
                                    "title": "Remaining Story Points"
                                },
                                "color": {
                                    "field": "line_type",
                                    "type": "nominal",
                                    "scale": {
                                        "domain": ["Actual", "Expected"],
                                        "range": ["blue", "red"]  // Colors for actual and expected lines
                                    },
                                    "title": "Line Type"
                                }
                            }
                        },
                        {
                            "mark": {
                                "type": "line",
                                "strokeDash": [5, 5],  // Dashed line for expected burndown
                                "color": "red"  // Expected burndown line color
                            },
                            "encoding": {
                                "x": {
                                    "field": "completion_date",
                                    "type": "temporal"
                                },
                                "y": {
                                    "field": "remaining_points",
                                    "type": "quantitative"
                                },
                                "color": {
                                    "field": "line_type",
                                    "type": "nominal"
                                }
                            }
                        }
                    ]
                };

                vegaEmbed('#vis', spec);  // '#vis' is the container for the chart
            }


        </script>
        </div>
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
    <script type="text/javascript">
    var spec2 = "js/burndown.vg.json";
    vegaEmbed('#vis', spec2).then(function(result) {
      // Access the Vega view instance (https://vega.github.io/vega/docs/api/view/) as result.view
    }).catch(console.error);

    </script>
</body>
</html>
