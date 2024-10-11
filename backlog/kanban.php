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

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Open Sans', sans-serif;
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

        .pure-g {
            margin-bottom: 40px;
        }

        .small-font {
            font-size: 14px;
        }


    </style>
</head>
<body>

    <div class="board-header">
        <h1>Project Name</h1>
        <p>Sprint 1, Date: 23/08/24 to 23/09/24</p>
    </div>

    <div class="pure-g">
      <div class="pure-u-1-2"> <!-- 24-24 (full width)-->
        <div id="vis1" class="vis-container"></div>
        <script type="text/javascript">
            // Fetch data from the fetch_data.php file
            // Assuming the script is located in the same directory

            const url = new URL('backlog/burndown.php?sprint_id=' + <?php echo $_GET['sprint_id']; ?>, window.location.origin);

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
                    "config": {"view": {"stroke": ""}},
                    "title": {"text": "Sprint Burndown Chart"},
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
                                "color": "#6cb3d4"  // Actual burndown line color
                            },
                            "encoding": {
                                "x": {
                                    "field": "completion_date",
                                    "type": "temporal",
                                    "title": "Date",
                                    "axis": {
                                        "grid": false,  // Removes the X-axis line
                                        "ticks": false    // Removes the X-axis ticks
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
                                        "range": ["#6cb3d4", "#d46c6c"]  // Colors for actual and expected lines
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

    <div class="board">
        <div class="column to-do">
            <div class="column-header">To Do</div>
            <!-- Add your task cards for To Do here -->
            <div class="task-card">
                <h4>Task 1</h4>
                <p>Description of task 1.</p>
                <span class="priority critical">Critical</span>
            </div>
            <div class="task-card">
                <h4>Task 2</h4>
                <p>Description of task 2.</p>
                <span class="priority medium">Medium</span>
            </div>
        </div>
        
        <div class="column in-dev">
            <div class="column-header">In Development</div>
            <!-- Add your task cards for In Development here -->
            <div class="task-card">
                <h4>Task 3</h4>
                <p>Description of task 3.</p>
                <span class="priority low">Low</span>
            </div>
        </div>
        
        <div class="column closed">
            <div class="column-header">Closed</div>
            <!-- Add your task cards for Closed here -->
            <div class="task-card">
                <h4>Task 4</h4>
                <p>Description of task 4.</p>
                <span class="priority critical">Critical</span>
            </div>
        </div>
    </div>
</body>
</html>

