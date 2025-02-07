<?php
require('../auth.php');
if (session_status() === PHP_SESSION_NONE) {
    ob_start();
    session_start();
}
require_once('../database/dao.php');
$dao = new DAO();
$user = $dao->getUserByUsername($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap link-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Fonts links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <style>
        body {
            /* background-image: url("../assets/login-bg.png"), url("https://www.transparenttextures.com/patterns/water.png");
            background-size: cover, 200px 200px;
            /* Make the water texture larger */
            background-position: center, 0% 50%;
            /* Center the main image, position water texture */
            position: relative;
            Relative background */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            /* Background below other elements */
        }

        .drop-shadow {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .navbar-toggler img {
            width: 30px;
            height: 30px;
        }


        .admin-card * {
            color: black;
            font-family: "Montserrat", sans-serif;
            margin: 8px;
        }


        .admin-card a:hover {
            color: grey;
        }


        .sublinks img {
            width: 15px;
            height: 15px;
        }

        /* Sidebar */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: #fff;
            overflow-x: hidden;
            transition: 0.5s;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
        }

        .sidebar a {
            padding: 15px 30px;
            text-decoration: none;
            font-size: 19px;
            color: #111;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #f1f1f1;
            background-color: grey;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 10px;
            left: 25px;
            font-size: 36px;
        }

        img {
            border: none;
            outline: none;
        }
    </style>
</head>

<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-light bg-white drop-shadow d-flex justify-content-between align-items-center">
        <a class="navbar-brand" href="/dashboard">
            <img src="../assets/logo.png" style="width: 150px;" class="d-inline-block align-top" alt="logo">
        </a>
        <!-- Hamburger button -->
        <div style="border: none" id="hamburger-btn" class="navbar-toggler mt-2 mr-3" onclick="openNav()">
            <img src="../assets/ham.png" alt="Menu" class="img-fluid navbar-toggle">
        </div>
    </nav>


    <!-- Sidebar -->
    <div id="mySidebar" class="sidebar">
        <br>
        <a href="/dashboard">Dashboard</a>
        <br>
        <a href="/backlog/index.php">Backlog</a>
        <a href="/backlog/create_task.php">Create Tasks</a>
        <br>
        <a href="/sprints/index.php">All Sprints</a>
        <a href="/sprints/create_sprint.php">Create Sprints</a>


        <br>
        <a href="/user/index.php">All Team Members</a>
        <?php
        if ($user->admin == 1) {
            ?>
            <a href="/user/add.php">Add Team Members</a>
            <br>
            <?php
        }
        ?>

    </div>

    <!-- Bootstrap optional javascript-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7HfUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <!-- Sidebar toggle scripts -->
    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
        }

        // Close sidebar if clicked outside of it
        document.addEventListener('click', function (event) {
            var sidebar = document.getElementById('mySidebar');
            var hamburgerBtn = document.getElementById('hamburger-btn');

            if (!sidebar.contains(event.target) && !hamburgerBtn.contains(event.target)) {
                closeNav();
            }
        });
    </script>
</body>

</html>