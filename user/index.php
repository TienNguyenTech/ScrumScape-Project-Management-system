

<?php
ob_start();
session_start();
require('../auth.php');

require_once('../database/dao.php');
$dao = new DAO();
$members = $dao->getAllUsers();
$user = $dao->getUserByUsername($_SESSION['user_id']);






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Dashboard</title>

    <!-- Bootstrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/vega@5.20.2"></script>
    <script src="https://cdn.jsdelivr.net/npm/vega-lite@5.1.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/vega-embed@6.17.0"></script>

    <style>
        body {
            background-color: #F5F5F5;
        }

        /* .container {
            width: 85%;
            margin: 0 auto;
            background-color: white;
        } */

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
            color: white;
        }

        .table {
            margin-bottom: 150px;
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
            padding-left: 2.5%;
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
            background-color: #FDF8F8;
            border-radius: 7px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 50px;
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



        .icon {
            text-align: center;
            cursor: pointer;
        }

        .icon img {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .icon img:hover {
            transform: scale(1.1);
            transition: transform 0.2s;
        }



        /* Popup Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            display: flex; /* Flexbox for centering */
            justify-content: center; /* Horizontally centered */
            align-items: center; /* Vertically centered */
        }

        .modal-content {
            background-color: #ffffff;
            padding: 15px;
            width: auto;  /* Let content determine width */
            max-width: 600px; /* Set a max width for the modal content */
            box-shadow: 0 4px 20px rgba(8, 58, 86, 0.5);
            border-radius: 10px; /* Optional: gives a rounded border */
            overflow: auto;
        }



        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,.close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .modal-table th, .modal-table td {
            padding: 10px;
            border: 0px;
            text-align: left;
            background-color: white;
        }

        .modal-table th {
            background-color: #ffffff;
            color: rgb(0, 0, 0)
        }


        /* input[type="date"] {
        border: none;
        background-color: #ddecf0;  f8fafc
        color: #727272;  b8bcca
        font-size: 16px;
        padding: 10px;
        border-radius: 4px;
        outline: none;
        width: 100%;
        box-sizing: border-box;
    } */



        input[type="date"] {
            width: 110%;
            padding: 8px;
            margin-bottom: 10px;
            border: 0;
            border-radius: 2px;
            background-color: #f8fafc;
            color: #727272;
            height: 38px;
            font-size: 15px;
        }

        input[type="date"]::placeholder {
            color: #727272;
        }


        .vis-container {
            height: 400px; /* Adjust height as needed */
            width: 100%;   /* Full width */
        }


    </style>
</head>

<body>

<?php
require_once("../dashboard/navbar.php");
?>

<div class="container">
    <!-- Sprint Title, Searchbar and Button-->
    <div class="header-search">
        <h1>Team Members</h1>
        <input class="form-control search-bar col-sm-3" id="memberSearchInput" type="text" placeholder="Search Member" onkeyup="searchMembers()">
        <a href="add.php"> <button type="button" class="btn custom-btn">+ Create New Member</button></a>
    </div>

    <!--Task table header-->
    <table class="table">
        <thead>
        <tr class="table-header">
            <th class="d-flex align-items-center " style="border: none">
                <div class="heading">
                    <h4 class="mb-0">Name</h4>
                </div>
            </th>
            <th class="d-flex align-items-center " style="border: none">
                <div class="heading">
                    <h4 class="mb-0">Username</h4>
                </div>
            </th>
            <th class="d-flex align-items-center " style="border: none">
                <div class="heading">
                    <h4 class="mb-0">Email</h4>
                </div>
            </th>
            <?php
            if ($user->admin == 1) {
                ?>
                <th class="d-flex align-items-center " style="border: none">
                    <div class="heading">
                        <h4 class="mb-0">View Individual Progress</h4>
                    </div>
                </th>
                <?php
            }
            ?>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($members as $member): ?>
            <tr class="custom-row">
                <td class="d-flex align-items-center table-cell" style="border: none;">
                    <div class="user-name">
                        <?= htmlspecialchars($member->user_fname . " " . $member->user_lname); ?>
                    </div>
                </td>
                <td class="d-flex align-items-center table-cell" style="border: none;">
                    <div class="user-name">
                        <?= htmlspecialchars($member->user_name); ?>
                    </div>
                </td>
                <td class="d-flex align-items-center table-cell" style="border: none;">
                    <div class="user-email">
                        <?= htmlspecialchars($member->user_email); ?>
                    </div>
                </td>
                <?php
                if ($user->admin == 1) {
                    ?>
                    <td class="icon d-flex align-items-center table-cell justify-content-center" onclick="openModal(<?= $member->user_id ?>, '<?= htmlspecialchars(($member->user_fname . " " . $member->user_lname), ENT_QUOTES) ?>')">
                        <img src="https://static-00.iconduck.com/assets.00/line-chart-icon-2048x1890-dzg7lyvp.png" alt="View Progress" title="View Progress">
                    </td>
                    <?php
                }
                ?>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>
<div id="myModal" class="modal" title = "">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id = 'modal-member-name'>Member Name</h2>
        <table class="modal-table">
            <thead>
            <tr>
                <th>Select Date Range</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <form>
                        <label for="dateInput">Start Date:</label>
                        <input type="date" id="startDateInput" name="startDateInput">
                    </form>
                </td>
                <td>
                    <form>
                        <label for="dateInput">End Date:</label>
                        <input type="date" id="endDateInput" name="endDateInput">
                    </form>
                </td>
                <td>
                    <button type="button" class="btn custom-btn" style="margin-left: 10px; margin-top: 20px;" onclick = "updateChart()">Go</button>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="pure-g">
            <div class="pure-u-1-1"> <!-- 24-24 (full width)-->
                <div id="vis1" class="vis-container"></div>
                <script type="text/javascript">
                    // Fetch data from the fetch_data.php file
                    // Assuming the script is located in the same directory
                    var modal = document.getElementById("myModal");


                    const url = new URL('user/member_hours_chart.php', window.location.origin);
                    url.searchParams.append('user_id', modal.getAttribute("data-user-id"));
                    url.searchParams.append('start_date', document.getElementById('startDateInput').value);
                    url.searchParams.append('end_date', document.getElementById('endDateInput').value);

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
                                "config": {"view": {"stroke": ""}},
                                "title": {"text": "Hours Logged"},
                                "height": 300,
                                "width": 400,
                                "background": "transparent",
                                "data": {
                                    "values": data
                                },
                                "mark": {
                                    "type": "bar",  // Bar chart
                                    "color": "#6cb3d4"  // Bar color
                                },
                                "encoding": {
                                    "x": {
                                        "field": "date",
                                        "type": "temporal",
                                        "title": "Date",
                                        "axis": {
                                            "grid": false,  // Removes the X-axis grid
                                            "ticks": false,  // Removes the X-axis ticks
                                            "format": "%d/%m",  // Formats date as dd/mm 
                                            "tickCount": "day" // Increments by one day 
                                        }
                                    },
                                    "y": {
                                        "field": "hours",  // Changed to hours_logged
                                        "type": "quantitative",
                                        "title": "Hours Logged",
                                        "axis": {
                                            "grid": false,  // Removes the Y-axis grid
                                            "ticks": false,  // Removes the Y-axis ticks
                                            "orient": "left"  // Ensures the Y-axis is on the left
                                        }
                                    }
                                }
                            }
                        ;

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
</div>

<script>
    function searchMembers() {
        let input = document.getElementById('memberSearchInput');
        let filter = input.value.toLowerCase();
        let rows = document.querySelectorAll('.custom-row');

        rows.forEach(row => {
            const userName = row.querySelector('.user-name').textContent.toLowerCase();
            // console.log(taskName)
            if (userName.includes(filter)) {
                // console.log("found")
                row.style.display = "";
            } else {
                // console.log("found")
                row.style.display = "none";
            }
        });

    }
</script>

<script>
    var modal = document.getElementById("myModal");
    var modalTitle = document.getElementById("modal-member-name");
    function openModal(userID, userName) {
        modal.style.display = "block";
        modal.setAttribute("data-user-id", userID);
        modalTitle.innerText = userName;
    }
    function closeModal() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<script>
    function updateChart() {
        const userId = document.getElementById("myModal").getAttribute("data-user-id");
        const startDate = document.getElementById('startDateInput').value;
        const endDate = document.getElementById('endDateInput').value;

        const start = new Date(startDate);
        const end = new Date(endDate);

        // Input sanitation: Check if end date is before start date
        if (end < start) {
            alert("End date cannot be before start date. Please select valid dates.");
            return; // Exit the function if the dates are invalid
        }

        const oneWeekInMilliseconds = 7 * 24 * 60 * 60 * 1000; // 7 days in milliseconds

        // Input sanitation: Check if end date is before start date
        if (end - start > oneWeekInMilliseconds) {
            alert("Start and end date cannot be more than a week apart.");
            return; // Exit the function if the dates are invalid
        }

        const url = new URL('user/member_hours_chart.php', window.location.origin);
        url.searchParams.append('user_id', userId);
        url.searchParams.append('start_date', startDate);
        url.searchParams.append('end_date', endDate);

        console.log(url.toString());


        fetch(url)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                drawVegaLiteChart(data);
            })
            .catch(error => console.error('Error fetching data:', error));
    }

</script>


</body>
</html>
