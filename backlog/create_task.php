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
//    $completionDate = $_POST['completionDate'] ? $_POST['completionDate'] : null;
    $completionDate = NULL;
    $taskNo = 1;

    $dao->createTask($taskNo, $taskName, $description, $storyPoints, $type, $priority, $status, $sprintId, $completionDate);
    var_dump($taskNo, $taskName, $description, $storyPoints, $type, $priority, $status, $sprintId, $completionDate);
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
            <h1> Create Task </h1>
            <p> Add a new task to the product backlog. </p>
        </div>

        <div class="column">
            <h4> Task Name </h4>
            <textarea name="taskName" id="taskName" class="form-control form-control-sm" style="resize: none; font-size: 1rem" rows="4" placeholder="Implement Feature..." required></textarea>
            <h4> Story Points </h4>
            <select name="storyPoints" id="storyPoints" class="form-control">
                <option value="NULL">-</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <h4> Priority </h4>
            <select name="priority" id="priority" class="form-control font-weight-bold bg-success" onchange="changeBg()" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="Important">Important</option>
                <option value="Urgent">Urgent</option>
            </select>
        </div>

        <div class="column">
            <h4> Task Description </h4>
            <textarea name="taskDesc" id="taskDesc" class="form-control form-control-sm" style="resize: none; font-size: 1rem" rows="4" placeholder="As a user I would like to..."></textarea>

            <h4> Type</h4>
            <select name="type" id="type" class="form-control" required>
                <option value="Story">Story</option>
                <option value="Bug">Bug</option>
            </select>

            <h4> Assign To</h4>
            <select class="form-control " required>
                <option> Jane Doe </option>
                <option> John Smith </option>
            </select>
        </div>


    </div>

    <!-- Footer with button-->
    <div class="footer"> 
        <button type="submit" class="btn custom-btn">Create</button>
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