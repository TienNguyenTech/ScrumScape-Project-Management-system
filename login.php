<?php
// Activate the session
session_start();

global $dbh;
require_once("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Check the user by username and password (plaintext matching)
        $query = "SELECT * FROM `users` WHERE `username` = :username AND `password` = :password";
        $stmt = $dbh->prepare($query);

        if ($stmt->execute([
                'username' => $_POST['username'],
                'password' => $_POST['password']
            ]) && $stmt->rowCount() == 1) {
            // When the user is found, grab its id and store it into the session for future reference
            $row = $stmt->fetchObject();
            $_SESSION['user_id'] = $row->id;
            //Successfully logged in, redirect user to dashboard
            header("Location: index.php");
        } else {
            $error_message = "Either username or password is incorrect!";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="password"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
        }
        h3.error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h1>Log in</h1>
    <h3 class="error"><?= $error_message ?? "" ?></h3>
    <form method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Login"/>
    </form>
</div>
</body>
</html>
