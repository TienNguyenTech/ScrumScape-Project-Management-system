<?php ob_start();
session_start();
require('../auth.php');
require_once('../database/dao.php');
$dao = new DAO();

//var_dump($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['user_email'];
    $username = $_POST['user_name'];
    $password = $_POST['user_password'];
    $fname = $_POST['fName'];
    $lname = $_POST['lName'];
    $isAdmin = isset($_POST['isAdmin']) ? 1 : 0;

    $result = $dao->insertUser($email, $username, $password, $fname, $lname, $isAdmin);
//    var_dump($result);
    if ($result) {
        header('Location: /user/index.php');
        exit();
    } else {
        echo "Error: Unable to insert user. Please try again.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Add Team Member </title>

    <!-- Boostrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <link
            href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            height: 100vh;
            width: 100%;
        }

        .content-container {
            display: flex;
            gap: 30px;
            width: 100%;
            height: 50vh;

        }

        .column {
            flex: 1;
            margin-top: 40px;
        }

        .column * {
            font-family: "IBM Plex Sans";
            /*font-weight: light;*/
            font-size: 18px;
            color: #6F7482;
            /*font-style: regular;*/
            margin: 20px;

        }

        .column h1 {
            font-family: "Montserrat";
            font-weight: bold;
            font-size: 40px;
            color: #242731;
        }

        .custom-btn {
            background-color: #0888C7;
            color: white;
        }

        .custom-btn:hover {
            background-color: #0A6C9C;
            color: white;
        }

        .form-control {
            background-color: #F8FAFC;
            border: none
        }

        .footer {
            display: flex;
            margin-top: 50px;
            justify-content: flex-end;
        }



        /* Style for the scrollable box */
        .scrollable-box {
            width: 400px;
            height: 310px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 25px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Style for individual cards */
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            cursor: pointer;
            transition: background-color 0.3s, border-color 0.3s;
        }

        /* Style for selected cards */
        .card.selected {
            background-color: #4caf50;
            color: white;
            border-color: #4caf50;
        }
    </style>

</head>

<body>
<?php
require_once("../dashboard/navbar.php");
?>
<form action="add.php" class="container mt-5" method='POST'>

    <!-- Main body -->
    <div class="content-container mt-5">

        <div class="column" style="margin-left:-50px;">
            <h1> Create New Team Member </h1>
            <p style="color:black;"> Add a new team member into group. </p>
        </div>

        <div class="column">
            <h4 style="color:black;"> Username </h4>
            <input name="user_name" id="user_name" class="form-control" required>
            <h4 style="color:black;"> Email </h4>
            <input type="email" class="form-control" id="user_email" name="user_email" required>
            <h4 style="color:black;"> Default Password </h4>
            <input type="password" class="form-control" id="user_password" name="user_password" required>
        </div>

        <div class="column" style="margin-left:20px;">
            <h4 style="color:black;"> First Name </h4>
            <input name="fName" id="fName" class="form-control" required>
            <h4 style="color:black;"> Last Name </h4>
            <input name="lName" id="lName" class="form-control" required>

            <div style="display: flex; align-items: center;" class="mt-5">
                <input type="checkbox" name="isAdmin" id="isAdmin" style="transform: scale(1.5); margin-left: 8px">
                <h4 style="margin: 0; color:black; "> Admin? </h4>
            </div>
        </div>

    </div>

    <!-- Footer with button-->
    <div class="footer">
        <button type="submit" class="btn custom-btn" id="createButton">Create</button>
    </div>
</form>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6jJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>