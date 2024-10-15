<?php
//ob_start();
//session_start();
require('../auth.php');

require_once('../database/dao.php');
$dao = new DAO();
$sprints = $dao->getAllSprints();



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sprint_id'])) {
    $sprintId = (int)$_POST['sprint_id']; // Get sprint_id from the form submission

    $worked = $dao->deleteSprint($sprintId);        // Call the delete function

    if (!$worked) {
        echo '<script type="text/javascript">
        window.onload = function () { alert("Delete unsuccessful."); } 
        </script>';
    } else {
        // Refresh the page after a successful deletion
        header('Location: ' . $_SERVER['PHP_SELF']);  // Reload the current page

        exit();  // Make sure no further code is executed
    }

    // Unset sprint_id from POST data
    unset($_POST['sprint_id']);
}







function formatDate($date) {
    $datetime = new DateTime($date);
    return $datetime->format('d/m/Y');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprints Page</title>

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
            /*padding-left: 2.5%;*/
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

        .sprint-buttons {
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
            background-color: #f4f4f4;/*#FDF8F8;*/
            border-radius: 7px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 75px;
            padding-left: 2.5%;
            margin-top: 5px;
        }

        .custom-row:hover {
            background-color: #E8E8E8;
            cursor: pointer;
            border-radius: 7px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 75px;
            padding-left: 2.5%;
            margin-top: 5px;
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





    </style>
</head>

<body>

<div class="container" style="padding-right: 30px;  padding-left: 30px; padding-bottom: 30px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);  background-color: white; width: 1000px;  position: relative; top: -58px; left:-125px; border-radius: 8px;">
    <!-- Sprint Title, Searchbar and Button-->
    <div class="header-search">
        <h1>Sprints</h1>
        <input class="form-control search-bar col-sm-3" id="sprintSearchInput" type="text" placeholder="Search Sprint" onkeyup="searchSprints()">
        <a href="/sprints/create_sprint.php"> <button type="button" class="btn custom-btn">+ Create Sprint</button></a>
    </div>

    <!--Task table header-->
    <table class="table" style="margin-bottom: 0">
        <thead>
        <tr class="table-header">
            <th class="d-flex align-items-center " style="border: none">
                <div class="heading">
                    <h4 class="mb-0"><img src="/assets/task_icon.svg" class="header-icons"/>Sprint ID</h4>
                </div>
            </th>
            <th class="d-flex align-items-center " style="border: none">
                <div class="heading">
                    <h4 class="mb-0">Title</h4>
                </div>
            </th>
            <th class="d-flex align-items-center" style="border: none">
                <div class="heading">
                    <h4 class="mb-0"><img src="/assets/calendar-plus.svg" class="header-icons"/>Start Date</h4>
                </div>
            </th>
            <th class="d-flex align-items-center" style="border: none">
                <div class="heading">
                    <h4 class="mb-0"><img src="/assets/calendar-check.svg" class="header-icons"/>End Date</h4>
                </div>
            </th>
            <th class="d-flex align-items-center" style="border: none">
                <div class="heading">
                    <h4 class="mb-0"><img src="/assets/chart-simple.svg" class="header-icons"/>Status</h4>
                </div>
            </th>
            <th class="d-flex align-items-center" style="border: none">
                <div class="heading">
                    <h4 class="mb-0"><img src="/assets/actions_task.svg" class="header-icons"/>Actions</h4>
                </div>
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($sprints as $sprint): ?>
            <tr class="custom-row" onclick="if (!event.target.closest('button'))  window.location='../kanban/index.php?sprint_id=<?= $sprint->sprint_id ?>';"">
            <td class="d-flex align-items-center truncate table-cell" style="border: none;">
                <?= htmlspecialchars($sprint->sprint_id); ?>
            </td>
            <td class="d-flex align-items-center table-cell" style="border: none; margin-left: -50px;">
                <div class="sprint-name ">
                    <?= htmlspecialchars($sprint->sprint_name); ?>
                </div>

            </td>
            <td class="d-flex align-items-center truncate table-cell" style="border: none;">
                <?= formatDate($sprint->start_date); ?>
            </td>
            <td class="d-flex align-items-center truncate table-cell " style="border: none;">
                <?=formatDate($sprint->end_date); ?>
            </td>
            <td class="d-flex align-items-center truncate table-cell " style="border: none;">
                <?=htmlspecialchars($sprint->status); ?>
                <?php
                // Determine the color based on status using hex codes
                $color = '';
                switch (strtolower($sprint->status)) {
                    case 'completed':
                        $color = '#28a745'; // Green
                        break;
                    case 'in progress':
                        $color = '#ffc107'; // Yellow
                        break;
                    case 'not started':
                        $color = '#dc3545'; // Red
                        break;
                    default:
                        $color = '#6c757d'; // Gray for other statuses
                        break;
                }
                ?>
                <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background-color: <?= $color; ?>; margin-left: 5px;"></span>
            </td>
            <td class="d-flex align-items-center table-cell justify-content-center" style="border: none; gap: 4px">
                <!-- Edit button -->
                <?php
                if ($sprint->status != 'Completed') {

                ?>
                <a href="../sprints/update_sprint.php?sprintId=<?= $sprint->sprint_id ?>">
                    <button type="button" class="btn btn-outline-primary" style="padding:7px; border: none;" onclick="event.stopPropagation();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                    </button>
                </a>
                    <?php
                }
                else{
                    echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp';
                }
                ?>


                <!-- Delete button -->
                <form method="POST" action="">
                    <input type="hidden" name="sprint_id" value="<?= $sprint->sprint_id ?>">
                    <button type="submit" class="btn btn-outline-danger" style="padding:7px; border: none;" onclick="return confirm('Are you sure you want to delete this sprint?'); event.stopPropagation();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0"/>
                        </svg>
                    </button>
                </form>
            </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>
<script>
    function searchSprints() {
        let input = document.getElementById('sprintSearchInput');
        let filter = input.value.toLowerCase();
        let rows = document.querySelectorAll('.custom-row');

        rows.forEach(row => {
            const sprintName = row.querySelector('.sprint-name').textContent.toLowerCase();
            // console.log(taskName)
            if (sprintName.includes(filter)) {
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