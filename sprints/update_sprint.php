<?php
ob_start();
session_start();
require('../auth.php');
require_once('../database/dao.php');

$dao = new DAO();

$sprintId = $_GET['sprintId'];
$currentSprint = $dao->getSprint($sprintId);
$tasks = $dao->getTasksBySprintId($sprintId);
$backlogTasks = $dao->getAllTasks();
if (!$currentSprint) {
    echo "Sprint not found.";
    exit();
}

$sprintName = $currentSprint->sprint_name;
$currentStartDate = $currentSprint->start_date;
$currentEndDate = $currentSprint->end_date;
$status = $currentSprint->status;

// Handle form submission for updating the sprint
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated values from the form
    $sprintName = $_POST['sprintName'];
    $startDate = date('Y-m-d', strtotime($_POST['startDate']));
    $endDate = date('Y-m-d', strtotime($_POST['endDate']));
    $status = $_POST['status'];

    // Use the updated selected tasks from the hidden input
    $selectedTasks = isset($_POST['selectedTasks']) ? explode(',', $_POST['selectedTasks']) : [];
    var_dump($selectedTasks);

    $currentTaskIds = array_column($tasks, 'task_id');
    var_dump($currentTaskIds);
    if (!empty($currentTaskIds)) {
        foreach ($currentTaskIds as $taskId) {
            $dao->removeTaskFromSprint($taskId);
        }
    }
    foreach ($selectedTasks as $taskId) {
        $dao->assignTaskToSprint($taskId, $sprintId);
    }
    var_dump($sprintName, $startDate, $endDate, $status);

     if ($dao->updateSprint($sprintId, 1, $sprintName, $startDate, $endDate, $status)) {
         echo "Sprint updated successfully.";
     } else {
         echo "Error updating sprint.";
     }

    // Redirect after successful update
    header("Location: /sprints/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Update Sprint </title>

    <!-- Boostrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

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
            background-color: #0888C7;
            color: white;
        }

        .custom-btn:hover {
            background-color: #0A6C9C;
            color: white;
        }

        .form-control {
            background-color: #F8FAFC;
            border: none
        }

        .footer {
            display: flex;
            margin-top: 50px;
            justify-content: flex-end;
        }



        /* Style for the scrollable box */
        .scrollable-box {
            width: 400px;
            height: 310px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .card.selected {
            background-color: #4caf50;
            color: white;
            border-color: #4caf50;
        }
    </style>
</head>

<body>
<?php require_once("../dashboard/navbar.php"); ?>
<form action="update_sprint.php?sprintId=<?= htmlspecialchars($sprintId); ?>" class="container mt-5" method='POST'>

    <!-- Main body -->
    <div class="content-container mt-5">
        <div class="column">
            <h1>Update Sprint</h1>
            <p>Update a sprint and assign tasks.</p>
        </div>

        <div class="column">
            <h4>Sprint Name</h4>
            <textarea name="sprintName" id="sprintName" class="form-control form-control-sm"
                      style="resize: none; font-size: 1rem" rows="4" required><?= htmlspecialchars($sprintName); ?></textarea>

            <h4>Start Date</h4>
            <input type="date" name="startDate" id="startDate" class="form-control"
                   value="<?= htmlspecialchars($currentStartDate); ?>" required>

            <h4>End Date</h4>
            <input type="date" name="endDate" id="endDate" class="form-control"
                   value="<?= htmlspecialchars($currentEndDate); ?>" required>

            <h4>Status</h4>
            <select name="status" id="status" class="form-control" required>
                <option value="Not Started" <?php if ($status == 'Not Started') echo 'selected'; ?>>Not Started</option>
                <option value="In Progress" <?php if ($status == 'In Progress') echo 'selected'; ?>>In Progress</option>
                <option value="Completed" <?php if ($status == 'Completed') echo 'selected'; ?>>Completed</option>
            </select>
        </div>

        <div class="column">
            <h4>Assign Tasks</h4>
            <div class="scrollable-box">

                    <?php foreach ($tasks as $task): ?>
                        <div class="card <?= in_array($task->task_id, array_column($tasks, 'task_id')) ? 'selected' : ''; ?>"
                             style="margin: 0; border: 1px solid #eee; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);"
                             data-task-id="<?= htmlspecialchars($task->task_id); ?>">
                            <label style="cursor: pointer;">
                                <input type="checkbox" name="selectedTasks[]" class="task-checkbox" style="margin: 0; opacity: 0; position: absolute;"
                                       value="<?= htmlspecialchars($task->task_id); ?>"
                                    <?= in_array($task->task_id, array_column($tasks, 'task_id')) ? 'checked' : ''; ?>>
                                <?= htmlspecialchars($task->task_name); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>

                    <?php foreach ($backlogTasks as $task): ?>
                        <div class="card" data-task-id="<?= htmlspecialchars($task->task_id); ?>"
                             style="margin: 0; border: 1px solid #eee; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
                            <label style="cursor: pointer;">
                                <input type="checkbox" name="selectedTasks[]" class="task-checkbox" style="margin: 0; opacity: 0; position: absolute;"
                                       value="<?= htmlspecialchars($task->task_id); ?>" onclick="updateSelectedTasks()">
                                <?= htmlspecialchars($task->task_name); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

            <input type="hidden" name="selectedTasks" id="selectedTasks" value="">
        </div>
    </div>

    <div class="footer">
    <?php if ($status != 'Completed'): ?>
        <button type="submit" class="btn custom-btn" id="updateButton">Update</button>
    <?php endif; ?>
</div>

</form>

<script>
    // JavaScript code as before to handle task selection
    const cards = document.querySelectorAll('.card');
    const selectedTasksInput = document.getElementById('selectedTasks');

    cards.forEach(card => {
        card.addEventListener('click', () => {
            const checkbox = card.querySelector('.task-checkbox');

            checkbox.checked = !checkbox.checked;
            card.classList.toggle('selected', checkbox.checked);

            updateSelectedTasks();
        });
    });

    function updateSelectedTasks() {
        const selectedTasks = [];
        const checkboxes = document.querySelectorAll('.task-checkbox:checked');

        checkboxes.forEach(checkbox => {
            selectedTasks.push(checkbox.value);
        });

        document.getElementById('selectedTasks').value = selectedTasks.join(',');
    }
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1z3y/8"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>
</html>
