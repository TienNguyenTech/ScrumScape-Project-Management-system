

<?php
ob_start();
session_start();
require('../auth.php');

require_once('../database/dao.php');
$dao = new DAO();
$users = $dao->getAllUsers();


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

        .chart-placeholder {
        width: 100%;
        height: 420px;
        background-color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 5px;
        overflow: hidden; 
        }

        .chart-placeholder img {
        max-height: 90%; 
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
                        <h4 class="mb-0">Email</h4>
                    </div>
                </th>
                <th class="d-flex align-items-center " style="border: none">
                    <div class="heading"> 
                        <h4 class="mb-0">View Individual Progress</h4>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
            <tr class="custom-row">
                <td class="d-flex align-items-center table-cell" style="border: none;">
                    <div class="user-name">
                    <?= htmlspecialchars($user->user_name); ?>
                    </div>
                </td>
                <td class="d-flex align-items-center table-cell" style="border: none;">
                    <div class="user-email">
                    <?= htmlspecialchars($user->user_email); ?>
                    </div>   
                </td>

                <td class="icon d-flex align-items-center table-cell justify-content-center" onclick="openModal(<?= $user->user_id ?>)">
                        <img src="https://static-00.iconduck.com/assets.00/line-chart-icon-2048x1890-dzg7lyvp.png" alt="View Progress" title="View Progress">
                </td>

<!-- 
                <td class="d-flex align-items-center table-cell justify-content-center" style="border: none; gap: 4px">
                    <a href="../backlog/updatesprint.html">
                        <button type="button" class="btn btn-outline-primary" style="padding:7px; border: none;" onclick="event.stopPropagation();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                        </button>
                    </a>

                    <form method="POST" action="">
                        <input type="hidden" name="sprint_id" value="?= $sprint->sprint_id ?">
                        <button type="submit" class="btn btn-outline-danger" style="padding:7px; border: none;" onclick="return confirm('Are you sure you want to delete this sprint?'); event.stopPropagation();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0"/>
                            </svg>
                        </button>
                    </form>
                </td> -->

            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>


    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Member Name</h2>
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
                            <input type="date" id="dateInput" name="dateInput">
                        </form>
                    </td>
                    <td>    
                        <form>
                            <label for="dateInput">End Date:</label>
                            <input type="date" id="dateInput" name="dateInput">
                        </form>
                    </td>   
                    <td>
                        <button class="create-member-btn">Update</button>
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


                    const url = new URL('backlog/member_hours_chart.php?user_id=' + modal.title, window.location.origin);

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
                            "width": "container",
                            "height": 200,
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
                                        "ticks": false  // Removes the X-axis ticks
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
        function openModal(userID) {
            modal.style.display = "block";
            modal.title = userID;
        }
        function closeModal() {
            modal.style.display = "none";
            modal.title = null;
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>











<!-- 


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Team Members</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 85%;
            margin: 0 auto;
            background-color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
            font-size: 18px;
        }

        tr {
            background-color: #E4F3F5; 
            border-bottom: 10px solid #ffffff;
        }

        .title-search {
            background-color: white;
            display: flex;
            justify-content: flex-start;
            align-items: left;
            padding: 10px;
        }

        .title-search h2 {
            margin: 0;
            font-size: 40px; 
            font-weight: bold;
        }

        .search-bar {
            display: flex;
            align-items: center;
            border: 0px;
            padding: 5px;
            background-color: #E6EBEC;
        }

        .search-bar input {
            border: none;
            outline: none;
            padding: 8px;
            font-size: 14px;
            background-color: #E6EBEC;
            color: #909090;
        }

        .search-bar img {
            width: 20px;
            height: 20px;
            margin-left: 5px;
            cursor: pointer;
        }

        .search-bar img:hover {
            transform: scale(1.1);
        }

        button {
            padding: 8px 16px;
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #2980b9;
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

        .create-member-btn {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            float: right;
            margin-top: 10px;
        }

        .team-table {
            margin-top: 20px;
        }

        /*Popup Modal styles */
        .modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        left: 50%;  
        top: 50%;   
        width: 100%; 
        height: 100%; 
        padding-top: 20px; 
        transform: translate(-50%, -60%); 
        }


        .modal-content {
            background-color: #ffffff;
            margin: 10% auto; 
            padding: 15px;
            height: 75%; 
            width: 50%; 
            box-shadow: 0 4px 20px rgba(8, 58, 86, 0.5);
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

        .chart-placeholder {
        width: 100%;
        height: 420px;
        background-color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 5px;
        overflow: hidden; 
        }

        .chart-placeholder img {
        max-height: 90%; 
        }

        input[type="date"] {
        border: none; 
        background-color: #ddecf0; 
        color: #727272; 
        font-size: 16px; 
        padding: 10px; 
        border-radius: 4px; 
        outline: none; 
        width: 100%; 
        box-sizing: border-box; 
    }

        input[type="date"]::placeholder {
        color: #727272; 
    }

    </style>
</head>
<body>

    <div class="container">
        <table>
            <tr class="title-search">
                <td>
                    <h2>Team Members</h2>
                </td>
                <td>
                    <div class="search-bar">
                        <input type="text" placeholder="Search member name">
                        <img src="https://cdn-icons-png.flaticon.com/512/482/482631.png" alt="Search" title="Search">
                    </div>
                </td>
            </tr>
        </table>

        <table class="team-table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>View Individual Progress</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Team Member Name</td>
                    <td>teammemberemail@gmail.com</td>
                    <td class="icon" onclick="openModal()">
                        <img src="https://static-00.iconduck.com/assets.00/line-chart-icon-2048x1890-dzg7lyvp.png" alt="View Progress" title="View Progress">
                    </td>
                </tr>
                <tr>
                    <td>Team Member Name</td>
                    <td>teammemberemail@gmail.com</td>
                    <td class="icon" onclick="openModal()">
                        <img src="https://static-00.iconduck.com/assets.00/line-chart-icon-2048x1890-dzg7lyvp.png" alt="View Progress" title="View Progress">
                    </td>
                </tr>
                <tr>
                    <td>Team Member Name</td>
                    <td>teammemberemail@gmail.com</td>
                    <td class="icon" onclick="openModal()">
                        <img src="https://static-00.iconduck.com/assets.00/line-chart-icon-2048x1890-dzg7lyvp.png" alt="View Progress" title="View Progress">
                    </td>
                </tr>
                <tr>
                    <td>Team Member Name</td>
                    <td>teammemberemail@gmail.com</td>
                    <td class="icon" onclick="openModal()">
                        <img src="https://static-00.iconduck.com/assets.00/line-chart-icon-2048x1890-dzg7lyvp.png" alt="View Progress" title="View Progress">
                    </td>
                </tr>
                <tr>
                    <td>Team Member Name</td>
                    <td>teammemberemail@gmail.com</td>
                    <td class="icon" onclick="openModal()">
                        <img src="https://static-00.iconduck.com/assets.00/line-chart-icon-2048x1890-dzg7lyvp.png" alt="View Progress" title="View Progress">
                    </td>
                </tr>
            </tbody>
        </table>

        <button class="create-member-btn">+ Create New Member</button>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Member Name</h2>
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
                            <input type="date" id="dateInput" name="dateInput">
                        </form>
                    </td>
                    <td>    
                        <form>
                            <label for="dateInput">End Date:</label>
                            <input type="date" id="dateInput" name="dateInput">
                        </form>
                    </td>   
                    <td>
                        <button class="create-member-btn">Update</button>
                    </td>
                    </tr>
                </tbody>
            </table>
            <div class="chart-placeholder">
                <img src="https://images.twinkl.co.uk/tw1n/image/private/t_630/u/ux/barchart_ver_1.jpg" alt="Graph Placeholder">
            </div>
            
        </div>
    </div>

    <script>
        var modal = document.getElementById("myModal");
        function openModal() {
            modal.style.display = "block";
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

</body>
</html> -->
