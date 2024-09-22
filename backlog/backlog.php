<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Backlog Page</title>

    <!-- Bootstrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;600&family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #F5F5F5;
        }

        .header-search {
            display: flex; 
            align-items: center;
            gap:10px; 
            padding-top: 15%;
        }

        .header-search h1 {
            font-family: "Montserrat";
            color: #1F6190;
            margin: 0; 
            width: 60%;
        }

        .search-bar {
            border-radius: 25px;
            background-color: #E8E8E8;
            border: 0px;
            margin-right: 25px;
        }
        .custom-btn {
            background-color:#1F6190;
            color:white; 
        }

        .custom-btn:hover {
            background-color: #0A6C9C;
            color:white;
        }

        .table-header {
            background-color: #0888C7;
            margin-top: 60px;
            border-radius: 7px;
            display: inline-flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
            height: 50px;
            padding-left:30px;
            padding-top: 10px;
        }

        .table-header h4 {
            font-family: "Lexend";
            font-size:15px;
            color: white;
        }

        .table-row {
            background-color: #FDF8F8;
            border-radius: 7px;
            display: inline-flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
        }

        .table-row p{
            font-family: "Montserrat";   
            font-weight: 450;
        }

        .table-row .btn {
            border: none;
            background-color: transparent;
            padding: 0;
        }

        .table-row .btn img {
            width: 18px;
        }

    </style>
</head>

<body>

    <div class="container">

        <div class="header-search">
            <h1>Product Backlog</h1>
            <input class="form-control search-bar col-sm-3" type="text" placeholder="Search Task">

            <button type="button" class="btn custom-btn">+ Add Task</button>
        </div>
        

            <div class="table-header">
                <div>
                    <h4> <img src="/assets/task_icon.svg" style="width: 18px; margin-right: 10px; margin-bottom: 3px;"/>Task Name </h4>
                </div>
                <div>
                    <h4> <img src="/assets/assignee_icon.svg" style="width: 18px; margin-right: 10px; margin-bottom: 3px;"/> Assignees </h4>
                </div>
                <div>
                    <h4> <img src="/assets/storypt_icon.svg" style="width: 20px; margin-right: 10px; margin-bottom: 3px;"/> Story Points</h4>
                </div>
                <div>
                    <h4> <img src="/assets/priority_icon.svg" style="width: 17px; margin-right: 10px;"/> Priority</h4>
                </div>
                <div style="width:100px"></div>
            </div>

            <!-- Table row with a clickable checkbox button -->
            <div class="table-row">
                <div>
                    <input type="checkbox" class="btn-check" id="task1-checkbox" autocomplete="off">
                    <label class="btn" for="task1-checkbox">
                        <img src="/assets/checkbox.svg" alt="Checkbox">
                    </label>
                </div>
                <div> <p> Talk to client </p></div>
                <div></div>
                <div> <p> 3 </p> </div>
                <div> <p> High </p> </div>
                <div></div>
                <div></div>
                <div></div>
            </div>

        </div>

    </div>
    
</body>
</html>