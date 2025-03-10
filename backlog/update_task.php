<?php
ob_start();
session_start();
require('../auth.php');

require_once('../database/dao.php');
$dao = new DAO();

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $task = $dao->getTask($task_id);
}

if ($task) {
    $taskObj = $task;
    $taskId = $taskObj->task_id;
    $taskNo = $taskObj->task_no;
    $taskName = $taskObj->task_name;
    $taskDesc = $taskObj->description;
    $currentStoryPoints = $taskObj->story_points;
    $currentPriority = $taskObj->priority;
    $status = $taskObj->status;
    $createdAt = $taskObj->created_at;
    $sprintId = $taskObj->sprint_id;
    $taskType = $taskObj->type;

//    var_dump($taskObj);
    $tags = $dao->getTagsByTaskId($taskId);
//    var_dump($tags);
    $tagIds = !empty($tags) ? $tags : [];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $taskName = $_POST['taskName'];
        $taskDesc = $_POST['taskDesc'];
        $type = $_POST['type'];
        $storyPoints = (int)$_POST['storyPoints'];
        if ($storyPoints == 0) { $storyPoints = NULL; }
        $priority = $_POST['priority'];
        $status = "Not Started";
        $sprintId = NULL;
        $taskNo = 1;
        $newTags = isset($_POST['tag_options']) ? $_POST['tag_options'] : [];

        $updateResult = $dao->updateTask($taskId, $taskNo, $taskName, $taskDesc, $storyPoints, $type, $priority, $status, $sprintId, NULL, $newTags);

        header("Location: /backlog/index.php");
        exit();
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Update Task</title>

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
                    <input name="taskName" id="taskName" class="form-control main-field" required type="text" placeholder="Insert task name..." value="<?php echo htmlspecialchars($taskName); ?>">

                    <h2 class="main-header mt-5"> Task Description </h2>
                    <textarea name="taskDesc" id="taskDesc" class="form-control main-field" rows="8" style="resize: none;" placeholder="Insert description..."><?php echo htmlspecialchars($taskDesc); ?></textarea>

                    <div class="mt-5" style="text-align: right;">
                        <button type="submit" class="btn custom-btn">Update Task</button>
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
                    <select  name="type" id="type"  required class="form-control form-control-sm sub-field main-field" style="width: 75%; margin-left: 13%">
                        <option value="Story" <?php echo $taskType === 'Story' ? 'selected' : ''; ?>>Story</option>
                        <option value="Bug" <?php echo $taskType === 'Bug' ? 'selected' : ''; ?>>Bug</option>
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
                        <option value="NULL" <?php echo $currentStoryPoints === null ? 'selected' : ''; ?>>-</option>
                        <option value="1" <?php echo $currentStoryPoints == 1 ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?php echo $currentStoryPoints == 2 ? 'selected' : ''; ?>>2</option>
                        <option value="3" <?php echo $currentStoryPoints == 3 ? 'selected' : ''; ?>>3</option>
                        <option value="4" <?php echo $currentStoryPoints == 4 ? 'selected' : ''; ?>>4</option>
                        <option value="5" <?php echo $currentStoryPoints == 5 ? 'selected' : ''; ?>>5</option>
                        <option value="6" <?php echo $currentStoryPoints == 6 ? 'selected' : ''; ?>>6</option>
                        <option value="7" <?php echo $currentStoryPoints == 7 ? 'selected' : ''; ?>>7</option>
                        <option value="8" <?php echo $currentStoryPoints == 8 ? 'selected' : ''; ?>>8</option>
                        <option value="9" <?php echo $currentStoryPoints == 9 ? 'selected' : ''; ?>>9</option>
                        <option value="10" <?php echo $currentStoryPoints == 10 ? 'selected' : ''; ?>>10</option>
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
                        <option value="Low" <?php echo $currentPriority === 'Low' ? 'selected' : ''; ?>>Low</option>
                        <option value="Medium" <?php echo $currentPriority === 'Medium' ? 'selected' : ''; ?>>Medium</option>
                        <option value="Important" <?php echo $currentPriority === 'Important' ? 'selected' : ''; ?>>Important</option>
                        <option value="Urgent" <?php echo $currentPriority === 'Urgent' ? 'selected' : ''; ?>>Urgent</option>
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
                                <input class="form-check-input position-static custom-check" type="checkbox" id="frontendCheckbox" name="tag_options[]" value="1" aria-label="Frontend" <?php echo in_array(1, $tagIds) ? 'checked' : ''; ?>>
                                <span class="tag" style="background-color: #7F74F6;"> Frontend </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="backendCheckbox" name="tag_options[]" value="2" aria-label="Backend" <?php echo in_array(2, $tagIds) ? 'checked' : ''; ?>>
                                <span class="tag" style="background-color: #7F74F6;"> Backend </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="apiCheckbox" name="tag_options[]" value="3" aria-label="API" <?php echo in_array(3, $tagIds) ? 'checked' : ''; ?>>
                                <span class="tag" style="background-color: #E34F9F"> API </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="databaseCheckbox" name="tag_options[]" value="4" aria-label="Database" <?php echo in_array(4, $tagIds) ? 'checked' : ''; ?>>
                                <span class="tag" style="background-color: #E34F9F"> Database </span>
                            </div>
                        </div>

                        <div class="tags">
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="frameworkCheckbox" name="tag_options[]" value="5" aria-label="Framework" <?php echo in_array(5, $tagIds) ? 'checked' : ''; ?>>
                                <span class="tag" style="background-color: #E34F9F"> Framework </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="testingCheckbox" name="tag_options[]" value="6" aria-label="Testing" <?php echo in_array(6, $tagIds) ? 'checked' : ''; ?>>
                                <span class="tag" style="background-color: #E34F9F"> Testing </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="uiCheckbox" name="tag_options[]" value="7" aria-label="UI" <?php echo in_array(7, $tagIds) ? 'checked' : ''; ?>>
                                <span class="tag" style="background-color: #E1982A"> UI </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="uxCheckbox" name="tag_options[]" value="8" aria-label="UX" <?php echo in_array(8, $tagIds) ? 'checked' : ''; ?>>
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

    <?php
} else {
    echo "Task not found.";
}
ob_end_flush();
