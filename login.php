<?php
ob_start();

// Activate the session
session_start();
require_once('./database/dao.php');
$dao = new DAO();

// Test if the user already logged in. If yes, send the user back to dashboard
if (isset($_SESSION['user_id']))
    header("Location: index.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        var_dump($_POST['username'],$_POST['password'] );
        $user = $dao->getUserByCredentials($_POST['username'], $_POST['password']); // hash the password, when getting a user
        var_dump($user);
        if ($user) {
            $_SESSION['user_id'] = $user->user_email;
            header("Location: home.php"); // go the index if user is logged in
            exit();

        } else {
            $alert_message = "Email or Password is incorrect"; // create alert var to display later on
            $alert_type = "danger";
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
         }
        .sub-heading {
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 200;
            font-style: normal;
            color: var(--color-s);
            font-size: 20px;
        }
        .input {
            background-color: #f1f1f1; font-weight: bolder; border: none; height: 50px; border-radius: 8px;
            width: 70%;
        }
        .forgot-pass {
            height: 20px;
            font-family: "Montserrat", sans-serif;
            font-optical-sizing: auto;
            font-weight: 500;
            font-style: normal;
            color: var(--color-p);
            font-size: 14px;
            text-decoration: none;
        }
        a:hover{
            color: var(--color-s);
            text-decoration:none;
            cursor:pointer;
        }

    </style>
    <title>Login</title>
</head>
<body>
<div class="login-bg">
    <div class="shadow" style="background: white; height: 100%; width: 38%; z-index: 0; display: flex"">
        <div  style=" margin-top: 40px; margin-left: 50px; z-index: 1; width: 100%">
            <img src="assets/logo.png" style="width: 200px;"/>
            <div style="margin-left: 50px; margin-top: 140px">
                <form method="POST">
                    <h1 class="heading">Welcome back!</h1>
                    <p class="sub-heading">Ready to Scrum?</p>
                    <label for="username"></label>
                    <input type="text" class="form-control input" id="username" name="username" required placeholder="Username">
                    <label for="password"></label>
                    <input type="password" class="form-control input" id="password" name="password" required placeholder="Password">
                    <div style="width: 70%;" class="mt-3 d-flex justify-content-between">
                        <button type="submit" value="Login" class="mt-4 btn btn-primary" style="width: 80px; border: none; border-radius: 15px; background-color: var(--color-s)">Login</button>
                        <a href="password_reset.php" class="forgot-pass">Forgot Password?</a>
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