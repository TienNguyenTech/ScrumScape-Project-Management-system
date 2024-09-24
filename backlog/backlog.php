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

    <style> /* TODO: fix to be less redundant */
        body {
            background-color: #F5F5F5;
        }

        .header-search {
            display: flex; 
            align-items: center;
            gap:10px; 
            padding-top: 5%;
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
            gap:20px;
            align-items: center;
            padding-top: 15px;
            border: 1px solid #E8E8E8;
        }

        .table-row p{
            font-family: "Montserrat";   
            font-weight: 450;
        }

        .table-row button {
            padding: 0; 
            border: none; 
            background: none;
            cursor: pointer; 
            display: flex;
            align-items: center;
        }

        .task-buttons {
            display: flex;
            gap: 5px;
            padding-bottom: 10px;
            padding-right: 15px;
        }

        .btn-outline-warning:hover {
            color: white;
        }

        .btn-filter {
            color: #19526E;
        }

        .btn-filter:hover {
            color: white;
        }

    </style>
</head>

<body>
    
    <?php
    require_once("../dashboard/navbar.php");
        ?>

    <div class="container">

    <!-- Product Backlog Title, Searchbar and Button-->
        <div class="header-search">
            <h1>Product Backlog</h1>
            <input class="form-control search-bar col-sm-3" type="text" placeholder="Search Task">
            <a href="create_task.php"> <button type="button" class="btn custom-btn">+ Add Task</button></a>
        </div>
        
            <!--Task table header-->
            <div class="table-header">
                <div><h4><img src="/assets/task_icon.svg" style="width: 18px; margin-right: 10px; margin-bottom: 3px;"/>Task Name </h4></div>
                <div style="padding-left: 20px;"><h4> <img src="/assets/assignee_icon.svg" style="width: 18px; margin-right: 10px; margin-bottom: 3px;"/> Assignees </h4></div>

                <div style="display: flex; align-items: center; padding-left: 50px;">
                    <h4> <img src="/assets/storypt_icon.svg" style="width: 20px; margin-bottom: 3px;"/> Story Points</h4>
                    <button type="button" class="btn btn-filter" style="padding-bottom: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sort-down-alt" viewBox="0 0 16 16">
                            <path d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5"/>
                        </svg>
                    </button>
                </div>

                <div style="display: flex; align-items: center; padding-left: 50px;">
                    <h4> <img src="/assets/priority_icon.svg" style="width: 17px; margin-right: 10px;"/> Priority</h4>
                    <button type="button" class="btn btn-filter" style="padding-bottom: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="currentColor" class="bi bi-sort-down-alt" viewBox="0 0 16 16">
                            <path d="M3.5 3.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 12.293zm4 .5a.5.5 0 0 1 0-1h1a.5.5 0 0 1 0 1zm0 3a.5.5 0 0 1 0-1h3a.5.5 0 0 1 0 1zm0 3a.5.5 0 0 1 0-1h5a.5.5 0 0 1 0 1zM7 12.5a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7a.5.5 0 0 0-.5.5"/>
                        </svg>
                    </button>
                </div>
                <div style="width:100px"></div>
            </div>

            <!--Single task row-->
            <div class="table-row">
                <div style="padding-left: 30px; padding-bottom: 15px;">
                    <button type="button" class="btn btn-outline-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"></path>
                            <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"></path>
                        </svg>
                        <span class="visually-hidden"></span>
                    </button>
                </div>
                
                <div><p>Talk to client</p></div>

                <div style="display: flex; gap:10px; padding-left: 100px;">
                    <img src="/assets/user_icon.svg" style="width:20px; padding-bottom: 15px;"/>
                    <p> Initials</p>
                </div>

                <div style="padding-left: 200px;"><p>3</p></div>
                <div style="padding-left: 190px;"><p>High</p></div>
                
                <!--Buttons for log hours/edit/delete task-->
                <div class="task-buttons" style="padding-left: 100px;">
                    <button type="button" class="btn btn-outline-warning" style="padding:5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/>
                        </svg>
                        <span class="visually-hidden"></span>
                    </button>
                    </button>

                    <button type="button" class="btn btn-outline-danger" style="padding:5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                        </svg>
                        <span class="visually-hidden"></span>
                    </button>
                    
                    <button type="button" class="btn btn-outline-primary" style="padding:5px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                        <span class="visually-hidden"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>