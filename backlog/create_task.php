<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Create Task Page </title>

    <!-- Boostrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    
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
            font-weight: light;
            font-size: 18px;
            color: #6F7482;
            font-style: regular;
            margin: 20px;
            
        }

        .column h1 {
            font-family: "Montserrat";
            font-weight: bold;
            font-size: 40px;
            color: #242731;
        }

        .custom-btn {
            background-color:#0888C7;
            color:white; 
        }

        .custom-btn:hover {
            background-color: #0A6C9C;
            color:white;
        }
        
        .form-control {
            background-color: #F8FAFC;
            border:none
        }

        .footer {
            display: flex;
            margin-top: 50px;
            justify-content: flex-end;
        }


    </style>

</head>

<body>
<?php
    require_once("../dashboard/navbar.php");
        ?>
<div class="container">

    <!-- Header with logo-->
    <div class="header" style="margin-left: -120px; margin-top: 70px;">  
        <img src="/assets/logo.png" width="180px"/>
    </div>

    <!-- Main body -->
    <div class="content-container"> 
        
        <div class="column">
            <h1> Create Task </h1>
            <p> Add a new task to the product backlog. </p>
        </div>
        
        <div class="column">
            <h4> Task Name </h4>
            <input class="form-control form-control-sm" type="text" placeholder="Text">
            <h4> Story Points </h4>
            <input class="form-control form-control-sm" type="text" placeholder="Text">
            <h4> Priority </h4>
            <select class="form-control">
                <option> High </option>
                <option> Medium </option>
                <option> Low </option>
            </select>
        </div>

        <div class="column">
            <h4> Assign To</h4>
            <select class="form-control">
                <option> Jane Doe </option>
                <option> John Smith </option>
            </select>
        </div>
    </div>

    <!-- Footer with button-->
    <div class="footer"> 
        <button type="button" class="btn custom-btn">Create Task</button>
    </div>
</div>
</body>
</html>