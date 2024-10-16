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

                <div class="tasks pic-blank-space"></div>

            </div>

            <div class="m-5">
                <?php
                require_once("../sprints/table.php");
                ?>
            </div>

        </div>
    </main>
</body>

</html>