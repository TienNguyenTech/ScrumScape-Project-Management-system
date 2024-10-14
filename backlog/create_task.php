<?php
ob_start();
session_start();
require('../auth.php');
require_once('../database/dao.php');

$dao = new DAO();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskName = $_POST['taskName'];
    $description =  $_POST['taskDesc'];
    $storyPoints = (float)$_POST['storyPoints'];
    if ($storyPoints == 0) {
        $storyPoints = NULL;
    }
    $type = $_POST['type'];
    $priority = $_POST['priority'];
    $status = "Not Started";

    $sprintId = NULL;
    $completionDate = NULL;
    $taskNo = 1;

    $tags = isset($_POST['tag_options']) ? $_POST['tag_options'] : [];

    var_dump($taskName, $description, $storyPoints, $type, $priority, $tags);
    $taskId = $dao->createTask($taskNo, $taskName, $description, $storyPoints, $type, $priority, $status, $sprintId, $completionDate, $tags);
    var_dump($taskId);
    header("Location: /backlog/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task Page</title>

    <!-- Boostrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>

        .body1 {
            display:flex;
            width: 100%;
            height:100vh;
        }

        .main-field {
            background-color: #E5E5E5;
            /*width: 80%;*/
            border: none;
            margin-bottom: 30px;
        }

        .main-field:focus {
            background-color: #E5E5E5;
            box-shadow: 0 0 0 0.2rem rgba(111, 116, 130, 0.25);
        }

        .main-header {
            font-size: 18px;
            color: #6F7482;
            font-family: "Montserrat"
            margin-bottom: 100px;
        }

        .custom-btn {
            background-color:#0888C7;
            color:white;
            font-size: 12px;
            font-family: "Montserrat"
        }

        .custom-btn:hover {
            background-color: #0A6C9C;
            color:white;
        }

        .sub-header {
            display:flex;
            gap: 15px;
            padding: 30px 0px 10px 50px;
        }

        .sub-header h4 {
            font-family: "Montserrat";
            color: #6F7482;
            font-weight: light;
            font-size: 15px;
        }

        .sub-field {
            /*width: 45%;*/
        }

        .info-section {
            height:18%;
        }

        .tags {
            display: flex;
            flex-direction: column;
            gap:13px;
            width: 50%;
            padding: 20px 0px 0px 00px;
        }

        .tag {
            margin-left: 10px;
            padding: 8px;
            border-radius: 10px;
            font-family: "Montserrat";
            font-weight: 0.9;
            color: white;
            font-size: 12px;
        }
    </style>

</head>

<body>
<?php
require_once("../dashboard/navbar.php");
?>

<div>

    <form class="body1" method = 'post'>

        <div style="width:75%;">

            <!-- Fields -->
            <div class="mt-5" style="padding: 50px 100px 0px 200px;">
                <h2 class="main-header" > Task Name </h2>
                <input name="taskName" id="taskName" class="form-control main-field" required type="text" placeholder="Insert task name...">

                <h2 class="main-header mt-5"> Task Description </h2>
                <textarea name="taskDesc" id="taskDesc" class="form-control main-field" rows="8" style="resize: none;" placeholder="Insert description..."></textarea>


                <div class="mt-5" style="text-align: right;">
                    <button type="submit" class="btn custom-btn">Create Task</button>
                </div>
            </div>

        </div>

        <!-- Side Panel -->
        <!-- Note: Don't add background color for dropdowns, otherwise might affect human aspect part of project.-->
        <div style="background-color: #F4F3F3; width: 25%;">

            <!-- Task Type -->
            <div class="info-section mt-3">
                <div class="sub-header">
                    <img src="../assets/task_icon_grey.svg" style="width:15px; color: #6F7482; padding-bottom: 8px;"/>
                    <h4> Task Type </h4>
                </div>
                <select  name="type" id="type" class="form-control" required class="form-control form-control-sm sub-field main-field" style="width: 75%; margin-left: 13%">
                    <option value="Story">Story</option>
                    <option value="Bug">Bug</option>
                </select>
                <hr style="border: 1px solid #AEA8A8; width: 50%; margin: 20px auto;">
            </div>

            <!-- Story Points -->
            <div class="info-section">
                <div class="sub-header">
                    <img src="../assets/storypt_icon_grey.svg" style="width:18px; color: #6F7482; padding-bottom: 8px;"/>
                    <h4> Story Points </h4>
                </div>
                <select name="storyPoints" id="storyPoints" class="form-control form-control-sm sub-field main-field" style="width: 75%; margin-left: 13%">
                    <option value="NULL">-</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                <hr style="border: 1px solid #AEA8A8; width: 50%; margin: 20px auto;">
            </div>

            <!-- Priority -->
            <div class="info-section">
                <div class="sub-header">
                    <img src="../assets/priority_icon_grey.svg" style="width:14px; color: #6F7482; padding-bottom: 8px;"/>
                    <h4> Priority </h4>
                </div>
                <select name="priority" id="priority" class="form-control form-control-sm sub-field main-field" style="width: 75%; margin-left: 13%">
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="Important">Important</option>
                    <option value="Urgent">Urgent</option>
                </select>
                <hr style="border: 1px solid #AEA8A8; width: 50%; margin: 20px auto;">
            </div>

            <!-- Tags -->
            <div class="info-section-tags" style="height: 40%;">
                <div class="sub-header">
                    <img src="../assets/tags_icon.svg" style="width:18px; color: #6F7482; padding-bottom: 8px;"/>
                    <h4> Tags </h4>
                </div>

                <!-- Don't change colours, picked specifically for colour blind aspect.-->
                <div class="ml-5" style="display:flex">
                    <div class="tags">
                        <div class="form-check">
                            <input class="form-check-input position-static custom-check" type="checkbox" id="frontendCheckbox" name="tag_options[]" value="1" aria-label="Frontend">
                            <span class="tag" style="background-color: #7F74F6;"> Frontend </span>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox" id="backendCheckbox" name="tag_options[]" value="2" aria-label="Backend">
                            <span class="tag" style="background-color: #7F74F6;"> Backend </span>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox" id="apiCheckbox" name="tag_options[]" value="3" aria-label="API">
                            <span class="tag" style="background-color: #E34F9F"> API </span>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox" id="databaseCheckbox" name="tag_options[]" value="4" aria-label="Database">
                            <span class="tag" style="background-color: #E34F9F"> Database </span>
                        </div>
                    </div>

                    <div class="tags">
                        <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox" id="frameworkCheckbox" name="tag_options[]" value="5" aria-label="Framework">
                            <span class="tag" style="background-color: #E34F9F"> Framework </span>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox" id="testingCheckbox" name="tag_options[]" value="6" aria-label="Testing">
                            <span class="tag" style="background-color: #E34F9F"> Testing </span>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox" id="uiCheckbox" name="tag_options[]" value="7" aria-label="UI">
                            <span class="tag" style="background-color: #E1982A"> UI </span>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input position-static" type="checkbox" id="uxCheckbox" name="tag_options[]" value="8" aria-label="UX">
                            <span class="tag" style="background-color: #E1982A"> UX </span>
                        </div>
                    </div>
                </div>


            </div>

        </div>

    </form>


</div>

</body>

</html>