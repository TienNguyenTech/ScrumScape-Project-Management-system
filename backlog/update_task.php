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
    $taskObj = $task[0];
    $taskId = $taskObj->task_id;
    $taskNo = $taskObj->task_no;
    $taskName = $taskObj->task_name;
    $currentStoryPoints = $taskObj->story_points;
    $currentPriority = $taskObj->priority;
    $status = $taskObj->status;
    $createdAt = $taskObj->created_at;
    $sprintId = $taskObj->sprint_id;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $taskName = $_POST['taskName'];
    $storyPoints = (int)$_POST['storyPoints'];
    if ($storyPoints == 0) { $storyPoints = NULL; }
    $priority = $_POST['priority'];
    $status = "Not Started";
    $sprintId = NULL;
    $taskNo = 1;
    var_dump($taskNo, $taskName, $storyPoints, $priority, $status, $sprintId);
    $dao->updateTask($taskId, $taskId, $taskName, $storyPoints, $priority, $status, $sprintId);

    header("Location: /backlog/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Create Task Page </title>

    <!-- Boostrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>

        .container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            height: 100vh;
            width: 100%;
        }

        .content-container {
            display: flex;
            gap: 30px;
            width: 100%;
            height: 50vh;

        }

        .column {
            flex: 1;
            margin-top: 40px;
        }

        .column * {
            font-family: "IBM Plex Sans";
            /*font-weight: light;*/
            font-size: 18px;
            color: #6F7482;
            /*font-style: regular;*/
            margin: 20px;

        }

        .column h1 {
            font-family: "Montserrat";
            font-weight: bold;
            font-size: 40px;
            color: #242731;
        }

        .custom-btn {
            background-color:#0888C7;
            color:white;
        }

        .custom-btn:hover {
            background-color: #0A6C9C;
            color:white;
        }

        .form-control {
            background-color: #F8FAFC;
            border:none
        }

        .footer {
            display: flex;
            margin-top: 50px;
            justify-content: flex-end;
        }


    </style>

</head>

<body>
<?php
require_once("../dashboard/navbar.php");
?>
<form class="container mt-5" method = 'post'>

    <!-- Main body -->
    <div class="content-container mt-5">

        <div class="column">
            <h1> Update Task </h1>
            <p> Update a task in the product backlog. </p>
        </div>

        <div class="column">
            <h4> Task Name </h4>
            <textarea name="taskName" id="taskName" class="form-control form-control-sm" style="resize: none; font-size: 1rem" rows="4" required><?php echo htmlspecialchars($taskName); ?></textarea>

            <h4> Story Points </h4>
            <select name="storyPoints" id="storyPoints" class="form-control">
                <option value="NULL" <?php echo $currentStoryPoints === null ? 'selected' : ''; ?>>-</option>
                <option value="1" <?php echo $currentStoryPoints == 1 ? 'selected' : ''; ?>>1</option>
                <option value="2" <?php echo $currentStoryPoints == 2 ? 'selected' : ''; ?>>2</option>
                <option value="3" <?php echo $currentStoryPoints == 3 ? 'selected' : ''; ?>>3</option>
                <option value="4" <?php echo $currentStoryPoints == 4 ? 'selected' : ''; ?>>4</option>
                <option value="5" <?php echo $currentStoryPoints == 5 ? 'selected' : ''; ?>>5</option>
            </select>

            <h4> Priority </h4>
            <select name="priority" id="priority" class="form-control font-weight-bold <?php echo $currentPriority === 'Low' ? 'bg-success' : ($currentPriority === 'Medium' ? 'bg-warning' : 'bg-danger'); ?>"" onchange="changeBg()" required>
                <option value="Low" <?php echo $currentPriority === 'Low' ? 'selected' : ''; ?>>Low</option>
                <option value="Medium" <?php echo $currentPriority === 'Medium' ? 'selected' : ''; ?>>Medium</option>
                <option value="Important" <?php echo $currentPriority === 'Important' ? 'selected' : ''; ?>>Important</option>
                <option value="Urgent" <?php echo $currentPriority === 'Urgent' ? 'selected' : ''; ?>>Urgent</option>
            </select>
        </div>

        <div class="column">
            <h4> Assign To</h4>
            <select class="form-control " required>
                <option> Jane Doe </option>
                <option> John Smith </option>
            </select>
        </div>
    </div>

    <!-- Footer with button-->
    <div class="footer">
        <button type="submit" class="btn custom-btn">Update</button>
    </div>
</form>
</div>
<script>
    function changeBg() {
        const select = document.getElementById("priority");
        const val = select.value;
        select.classList.remove("bg-danger", "bg-warning", "bg-success");
        if (val === 'Urgent') {
            select.classList.add('bg-danger');
        } else if (val === 'Medium') {
            select.classList.add('bg-warning');

        } else if (val === 'Low') {
            select.classList.add('bg-success');

        } else if (val === 'Important') {
            select.style.backgroundColor = '#FF8C00';
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6jJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
<?php
}
?>