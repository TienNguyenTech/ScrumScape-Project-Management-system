<?php
ob_start();
session_start();
require('../auth.php');

require_once('../database/dao.php');
$dao = new DAO();
$user = $dao->getUserByUsername($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dashboard and Sprints</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600&family=Montserrat:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        main {
            font-family: 'Lexend', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /*team user card*/
        .maincard {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 45px;
            margin-left: 100px;
        }

        .user-info {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .team-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        .team-table th,
        .team-table td {
            padding: 5px;
            text-align: left;
        }

        .team-table td {
            border: none;
        }

        .user-icon {
            width: 50px;
            height: 50px;
        }

        .user-details h2 {
            margin: 0;
            text-align: left;
            font-size: 18px;
            font-weight: 600;
        }

        .user-details p {
            margin: 0;
            text-align: left;
            font-size: 16px;
            color: gray;
        }

        .links {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .link-item {
            display: flex;
            align-items: center;
        }

        .link-item a {
            text-decoration: none;
            font-size: 14px;
            color: black;
            display: flex;
            align-items: center;
        }

        .link-item a img {
            margin-right: 5px;
        }

        .tasks {
            background-color: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            position: relative;
            left: -100px;
            top: -10px;
        }

        .tasks h3 {
            font-size: 18px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .tasks p {
            font-size: 14px;
            color: gray;
            margin-bottom: 15px;
        }

        .task-item {
            background-color: #f4f4f4;
            border-radius: 8px;
            height: 40px;
            margin-bottom: 10px;
            box-shadow: 0 4px 0 rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            color: black;
            padding: 10px;
            word-wrap: break-word;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
        }

        td {
            border: none;
        }


        .view-more button {
            background-color: #1fafed;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        .view-more button:hover {
            background-color: #1a56d1;
        }

        .icon img {
            width: 20px;
            cursor: pointer;
        }
    </style>
</head>

<body>



    <main>
        <?php
        require_once("./navbar.php");
        ?>

        <div style="display: flex;" class="mt-5 ml-5">
            <div class="maincard">
                <div class="tasks">
                    <div class="user-info">
                        <table class="team-table">
                            <tr>

                                <td style="width: 60px; padding-bottom: 20px">
                                    <img class="user-icon"
                                        src="https://www.iconpacks.net/icons/2/free-user-icon-3296-thumb.png"
                                        alt="user icon">
                                </td>
                                <td>
                                    <div class="user-details">
                                        <h2>Welcome, <?= $user->user_fname ?>!</h2>
                                        <?php
                                        if ($user->admin == 0) {

                                            ?>
                                            <p>Team Member Dashboard</p>
                                            <?php
                                        } else {
                                            ?>
                                            <p>Admin Dashboard</p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div class="links">
                                        <?php
                                        if ($user->admin == 1) {
                                            ?>
                                            <div class="link-item">
                                                <a href="/user/add.php">
                                                    <img style="padding-right: 5px" src="../assets/add_team.svg"
                                                        alt="Add Team Icon" height="18">
                                                    Add Team Members
                                                </a>
                                            </div>
                                            <div class="link-item">
                                                <a href="/user/">
                                                    <img style="padding-right: 3px" src="../assets/view_team.svg"
                                                        alt="View Team Icon" height="18">
                                                    View Team Members
                                                </a>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                        <div class="link-item">
                                            <a href="../password_reset.php">
                                                <img style="padding-right: 5px"
                                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/dc/Settings-icon-symbol-vector.png/480px-Settings-icon-symbol-vector.png"
                                                    alt="Settings Icon" height="20">
                                                Reset Password
                                            </a>
                                        </div>
                                        <div class="link-item">
                                            <a href="../logout.php">
                                                <img style="padding-right: 5px"
                                                    src="https://static-00.iconduck.com/assets.00/log-out-icon-2048x2048-cru8zabe.png"
                                                    alt="Logout Icon" height="20">
                                                Logout
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <style>
                    body,
                    html {
                        height: 100%;
                        margin: 0;
                    }

                    /* Main background */
                    main {
                        /* background-image: url(), url("https://www.transparenttextures.com/patterns/water.png"); */
                        background-size: cover, 200px 200px;
                        /* Make the water texture larger */
                        background-position: center, 0% 50%;
                        /* Center the main image, position water texture */
                        position: relative;
                        /* Relative background */
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        z-index: 0;
                        /* Background below other elements */
                    }
                </style>

                <style>
                    /* Basic styles for the calendar */
                    .calendar {
                        display: inline-block;
                        font-family: 'Lexend', sans-serif;
                        background-color: white;
                        padding: 20px;
                        border-radius: 12px;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        width: 310px;
                        text-align: center;
                        position: relative;
                        left: -100px;
                        top: -10px;
                    }

                    .calendar h3 {
                        text-align: center;
                        margin: 0;
                        padding: 5px;
                    }

                    .calendar .day {
                        display: inline-block;
                        width: 30px;
                        height: 30px;
                        line-height: 30px;
                        text-align: center;
                        margin: 2px;
                        border-radius: 50%;
                        color: #333;
                    }

                    .calendar .today {
                        background-color: #007bff;
                        color: white;
                    }

                    .calendar .day-name {
                        font-weight: bold;
                        width: 40px;
                        display: inline-block;
                        text-align: center;
                        margin: 0;
                        padding: 0;
                    }
                </style>
                <div class="calendar">
                    <h3 id="calendar-title"></h3>
                    <div id="calendar-days"></div>
                    <div class="button-container">
                        <button onclick="previousMonth()" class="custom-btn1">Previous</button>
                        <button onclick="nextMonth()" class="custom-btn1">Next</button>
                    </div>
                </div>

                <style>
        .custom-btn1 {
            padding: 10px 20px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s, transform 0.3s; /* Smooth transition */
        }

        .custom-btn1:hover {
            background-color: #45a049; /* Darker green on hover */
            transform: scale(1.05); /* Slightly enlarge on hover */
        }

        .button-container {
            display: flex; /* Align buttons inline */
            justify-content: center; /* Center align the buttons */
            margin-top: 20px; /* Space above the buttons */
        }
        #calendar-title {
    padding-bottom: 20px; /* Adjust the value as needed */
}

    </style>
            </div>

            <div class="m-5">
                <?php
                require_once("../sprints/table.php");
                ?>
            </div>

        </div>
    </main>
    <script>
        const calendarTitle = document.getElementById('calendar-title');
        const calendarDays = document.getElementById('calendar-days');

        let currentDate = new Date();

        function generateCalendar() {
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            // First day of the month
            const firstDayOfMonth = new Date(year, month, 1);
            // Last day of the month
            const lastDayOfMonth = new Date(year, month + 1, 0);
            // Last day of the previous month
            const lastDayOfPrevMonth = new Date(year, month, 0);

            // Set the calendar title
            calendarTitle.innerText = `${firstDayOfMonth.toLocaleString('default', { month: 'long' })} ${year}`;

            // Clear previous calendar days
            calendarDays.innerHTML = '';

            // Calculate leading spaces
            const leadingSpaces = firstDayOfMonth.getDay();

            // Add days from the previous month
            for (let i = leadingSpaces; i > 0; i--) {
                const day = lastDayOfPrevMonth.getDate() - i + 1;
                const dayElement = document.createElement('div');
                dayElement.className = 'day';
                dayElement.innerText = day;
                dayElement.style.color = 'lightgray'; // Style for previous month days
                calendarDays.appendChild(dayElement);
            }

            // Add days of the current month
            for (let day = 1; day <= lastDayOfMonth.getDate(); day++) {
                const dayElement = document.createElement('div');
                dayElement.className = 'day';
                if (day === new Date().getDate() && month === new Date().getMonth() && year === new Date().getFullYear()) {
                    dayElement.classList.add('today'); // Highlight today
                }
                dayElement.innerText = day;
                calendarDays.appendChild(dayElement);
            }

            // Calculate trailing spaces
            const trailingSpaces = 42 - (leadingSpaces + lastDayOfMonth.getDate());
            for (let i = 0; i < trailingSpaces; i++) {
                const dayElement = document.createElement('div');
                dayElement.className = 'day';
                dayElement.style.color = 'lightgray'; // Style for next month days
                calendarDays.appendChild(dayElement);
            }
        }

        function previousMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            generateCalendar();
        }

        function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            generateCalendar();
        }

        // Initial call to generate the calendar
        generateCalendar();
    </script>

</body>

</html>