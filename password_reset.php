<?php
ob_start();

// Activate the session
session_start();
require_once('./database/dao.php');
$dao = new DAO();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['newPassword']) && !empty($_POST['confirmPassword'])) {

        var_dump($_POST['username'],$_POST['newPassword'],$_POST['confirmPassword'] );

        if($_POST['newPassword'] != $_POST['confirmPassword']) {
            $alert_message = "New password does not match confirm password"; // create alert var to display later on
            $alert_type = "danger";
        }
        else {
            $worked = $dao->resetPassword($_POST['newPassword'], $_POST['username']);

            if (!$worked) {
                $alert_message = "Username not found"; // create alert var to display later on
                $alert_type = "danger";
            }
            else {
            header("Location: login.php"); // go the login if password reset was successful
            exit();
            }
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="icon" href="../assets/logo-sm.png">
    <link rel="stylesheet" href="./styles.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .login-bg {
            background-image: url("assets/login-bg.png");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            z-index: -1;
        }
        .heading {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 600;
            font-style: normal;
            color: var(--color-p);
            font-size: 38px;
            text-align:center;
         }
        .sub-heading {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 200;
            font-style: normal;
            color: var(--color-s);
            font-size: 20px;
            text-align:center;
        }
        .input {
            background-color: #f1f1f1; font-weight: bolder; border: none; height: 50px; border-radius: 8px;
            width: 70%;
        }

        a:hover{
            color: var(--color-s);
            text-decoration:none;
            cursor:pointer;
        }

    </style>
    <title>Reset Password</title>
</head>
<body>
<div class="login-bg">
    <!-- <div class="shadow" style="background: white; height: 100%; width: 38%; z-index: 0; display: flex"";> -->
    <div class = "box" style = "width: 1000px; height: 550px; background-color: white; border-radius: 15px; position: absolute; top: 75px;  left: 250px;";>
        <div  style=" margin-top: 5px; margin-left: 5px; z-index: 1; width: 100%">
            <img src="assets/logo.png" style="width: 200px;"/>
            <div style="margin-left: 0px; margin-top: 0px">
                <form method="POST">
                    <h1 class="heading">Reset Password</h1>
                    <p class="sub-heading">Enter username and new password</p>
                    <div style="margin-left: 250px; margin-top: 5px">

                        <label for="username"></label>
                        <input type="text" class="form-control input" id="username" name="username" required placeholder="Username">
                        <label for="new password"></label>
                        <input type="password" class="form-control input" id="newPassword" name="newPassword" required placeholder="New password">
                        <label for="confirm new password"></label>
                        <input type="password" class="form-control input" id="confirmPassword" name="confirmPassword" required placeholder="Confirm new password">
                        
                        <div style="width: 100%; margin-left: 130px" class="mt-3 d-flex justify-content-between">
                            <button type="submit" value="Reset Password" class="mt-4 btn btn-primary" style="width: 200px; border: none; border-radius: 15px; background-color: var(--color-s)">Reset Password</button>
                        </div>
                        </form>
               
                    </div>
            </div>

        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6jJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>