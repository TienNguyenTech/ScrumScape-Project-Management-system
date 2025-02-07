<?php
ob_start();

// Activate the session
session_start();
require_once('./database/dao.php');
$dao = new DAO();

$alert_message = '';
$alert_type = '';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // If the username, new password, and confirm password fields aren't empty
    if (!empty($_POST['username']) && !empty($_POST['newPassword']) && !empty($_POST['confirmPassword'])) {


        // if the new password and confirm password don't match
        if($_POST['newPassword'] != $_POST['confirmPassword']) {
            $alert_message = "New password does not match confirm password"; 
            $alert_type = "danger";

            echo '<script type="text/javascript">
            window.onload = function () { alert("New password and confirm password do not match"); } 
            </script>'; 

        }
        else {
            $worked = $dao->resetPassword($_POST['newPassword'], $_POST['username']);

            // if the password was not able to be reset
            if (!$worked) {
                $alert_message = "Username not found"; 
                $alert_type = "danger";

                echo '<script type="text/javascript">
                window.onload = function () { alert("User not found"); } 
                </script>'; 
            }

            // Return to login if successful
            else {

                header("Location: login.php"); 
                exit();
            }
        }
         
    }
    else {
        echo '<script type="text/javascript">
        window.onload = function () { alert("One of the fields is empty"); } 
        </script>'; 
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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="icon" href="../assets/logo-sm.png">
    <link rel="stylesheet" href="./styles.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <style>
        body,
        html {
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
            text-align: center;
        }

        .sub-heading {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 200;
            font-style: normal;
            color: var(--color-s);
            font-size: 20px;
            text-align: center;
        }

        .input {
            background-color: #f1f1f1;
            font-weight: bolder;
            border: none;
            height: 50px;
            border-radius: 8px;
            width: 70%;
        }
        .passwordToggle {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
            color: var(--color-p);
            font-size: 14px;
            text-align:center;
        }

        .alert {
            padding: 10px;
            text-align: center;
            border-radius: 4px;
            margin-top: 10px;
            width: 70%;
           
        }

        .alert.danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert.success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-container {
            width: 70%;
            margin-left: auto;
            margin-right: auto;
        }

        a:hover {
            color: var(--color-s);
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <title>Reset Password</title>
</head>

<body>
    <div class="login-bg">
        <div class="box"
            style="width: 1000px; height: 550px; background-color: white; border-radius: 15px; position: absolute; top: 75px; left: 250px;">
            <div style="margin-top: 0px; margin-left: 5px; z-index: 1; width: 100%">
                <img src="assets/logo.png" style="width: 200px;" />
                <div style="margin-left: 0px; margin-top: 0px">
                    <form method="POST">
                        <h1 class="heading">Reset Password</h1>
                        <p class="sub-heading">Enter username and new password</p>
                        <div style="margin-left: 250px; margin-top: 0px">

                        <label for="username"></label>
                        <input type="text" class="form-control input" id="username" name="username" required placeholder="Username">
                        <label for="new password"></label>
                        <input id="newPassword" type="password" class="form-control input" id="newPassword" name="newPassword" required placeholder="New password">
                        <label for="confirm new password"></label>
                        <input id="confirmPassword" type="password" class="form-control input" id="confirmPassword" name="confirmPassword" required placeholder="Confirm new password">
                        
                        <div style="margin-top: 10px">
                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="password-toggle">
                        <input type="checkbox" id="password-toggle" class="mdl-switch__input" onclick="togglePassword()" >
                        <span class="mdl-switch__label passwordToggle">Show password</span>
                        <script>
                            function togglePassword() {
                                var x = document.getElementById("newPassword");
                                var y = document.getElementById("confirmPassword");
                                if (x.type === "password") {
                                    x.type = "text";
                                    y.type = "text";
                                } else {
                                    x.type = "password";
                                    y.type = "password";
                                }
                            }
                        </script>
                        </label>
                        </div>


                        <div style="width: 46%; margin-left: 0px" class="mt-3 d-flex justify-content-between">
                            <button onclick="window.location.href='login.php'" class="mt-4 btn btn-primary" style="width: 70px; border: none; border-radius: 15px; background-color: var(--color-s)">Back</button>
                            <button type="submit" value="Reset Password" class="mt-4 btn btn-primary" style="width: 200px; border: none; border-radius: 15px; background-color: var(--color-s)">Reset Password</button>
                        </div>
                        </form>

               
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