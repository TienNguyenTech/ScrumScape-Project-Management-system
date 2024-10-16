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
                <!-- 
                <style>
                    /* Add white space and center the image with a fade-in animation */
                    .pic-blank-space {
                        background-image: url("assets/login-bg.png");
                        background-size: cover;
                        /* Ensures the image covers the entire div */
                        background-position: center;
                        padding: 20px;
                        /* White space around the image */
                        background-color: white;
                        /* The white background */
                        border-radius: 15px;
                        /* Rounded corners */
                        width: 300px;
                        height: 200px;
                        margin: 20px auto;
                        /* Center the div */
                        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                        /* Subtle shadow */

                        /* Animation */
                        opacity: 0;
                        animation: fadeIn 2s forwards;
                    }

                    /* Fade-in animation */
                    @keyframes fadeIn {
                        to {
                            opacity: 1;
                        }
                    }

                    /* Add hover animation for a zoom-in effect */
                    .pic-blank-space:hover {
                        transform: scale(1.05);
                        /* Slight zoom-in on hover */
                        transition: transform 0.3s ease;
                    }
                </style>

                <div class="tasks pic-blank-space"></div> -->

                <style>
                    /* Create the water ripple effect */
                    @keyframes ripple {
                        0% {
                            background-position: 0% 50%;
                        }

                        50% {
                            background-position: 100% 50%;
                        }

                        100% {
                            background-position: 0% 50%;
                        }
                    }

                    .pic-blank-space {
                        /* background-image: url("assets/login-bg.png"), url("https://www.transparenttextures.com/patterns/water.png"); */
                        background-size: cover, 200px 200px;
                        /* Main image + water texture */
                        background-position: center, 0% 50%;
                        /* Position of water texture */
                        padding: 20px;
                        background-color: white;
                        border-radius: 15px;
                        width: 300px;
                        height: 200px;
                        /* margin: 20px auto; */
                        margin-left: -200px;
                        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);

                        /* Water animation */
                        animation: ripple 10s infinite linear;
                    }

                    /* Add a tilt effect for 3D-like perspective */
                    .pic-blank-space:hover {
                        transform: perspective(1000px) rotateX(5deg) rotateY(5deg);
                        transition: transform 0.5s ease;
                    }

                    /* .pic-blank-space::before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        background-image: url("assets/login-bg.png");
                        background-size: cover;
                        background-position: center;
                        filter: blur(8px); */
                    /* Adjust blur strength here */
                    /* border-radius: 15px; */
                    /* Match the border-radius of the parent */
                    /* z-index: 0; */
                    /* Keep it behind the text */
                    /* opacity: 0.5; */
                    /* Adjust the opacity for effect */
                    /* } */

                    #date-time {
                        color: #333;
                        /* Text color */
                        font-size: 18px;
                        font-family: 'Lexend', sans-serif;
                        text-align: center;
                        position: absolute;
                        top: 40px;
                        /* Adjust this based on where you want the date-time to appear */
                        left: 0;
                        right: 0;
                        /* Add a frame with color #1f6190 */
                        border: 8px solid #1f6190;
                        /* Frame with the specified color */
                        position: relative;
                        /* For absolute positioning inside */
                        animation: ripple 10s infinite linear;
                        margin: 10px 20px;
                        z-index: 1;
                    }
                </style>

                <style>
                    body, html {
            height: 100%; /* Đảm bảo body và html chiếm toàn bộ chiều cao */
            margin: 0; /* Bỏ margin mặc định */
        }
                    /* Main background */
                    main {
                        background-image: url("assets/login-bg.png"), url("https://www.transparenttextures.com/patterns/water.png");
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

                <div class="pic-blank-space">
                    <div id="date-time"></div> <!-- Placeholder for dynamic date and time -->
                </div>

            </div>

            <div class="m-5">
                <?php
                require_once("../sprints/table.php");
                ?>
            </div>

        </div>
    </main>
    <script>
        function updateTime() {
            const now = new Date();

            // Format the date to dd/mm/YY
            const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
            const date = now.toLocaleDateString('en-GB', options); // Use 'en-GB' for dd/mm/YY format
            const time = now.toLocaleTimeString(); // Keeps the default time format

            document.getElementById('date-time').innerHTML = `${date} <br> ${time}`;
        }


        // Call the function immediately to avoid waiting for the first interval
        updateTime();
        // Update the date and time every second (1000 milliseconds)
        setInterval(updateTime, 1000);
    </script>

</body>

</html>