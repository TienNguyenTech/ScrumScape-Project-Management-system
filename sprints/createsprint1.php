<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Sprint</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: white;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 120px 90px 120px;
            border-radius: 10px;
            margin: auto;
        }

        h1 {
            font-size: 40px;
            margin-bottom: 20px;
            font-weight: bold;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        td {
            padding: 10px;
            vertical-align: top;
            border: 0;
        }
        td + td {
            padding-left: 40px;
        }
        input[type="text"] {
            width: 96%;
            padding: 8px;
            margin-bottom: 10px;
            border: 0;
            border-radius: 2px;
            background-color: #f8fafc;
            color: #b8bcca;
            height: 38px;
            font-size: 15px;
        }
        input::placeholder {
            color: #b8bcca;  
            font-size: 15px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 0;
            border-radius: 2px;
            background-color: #f8fafc;
            color: #b8bcca;
            height: 50px;
            font-size: 15px;

        }

        input[type="date"] {
            width: 110%;
            padding: 8px;
            margin-bottom: 10px;
            border: 0;
            border-radius: 2px;
            background-color: #f8fafc;
            color: #b8bcca;
            height: 38px;
            font-size: 15px;
        }

        input[type="time"] {
            width: 90%;
            padding: 8px;
            margin-bottom: 10px;
            border: 0;
            border-radius: 2px;
            background-color: #f8fafc;
            color: #b8bcca;
            height: 38px;
            font-size: 15px;

        }

        input[type="text"]:hover, input[type="date"]:hover, input[type="time"]:hover, select:hover,
        input[type="text"]:focus, input[type="date"]:focus, input[type="time"]:focus, select:focus {
            background-color: #c6dae7;
            outline: none;
            color: #b8bcca;
        }

        .label-container {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight:bold;
        }
        .label-container user {
            height:30px;
            width: 30px;
            border-radius: 5px;
            display: flex;
            align-items: center; 
            justify-content: center;
            color: #474848;
        }
        user.P { background-color: #fab2ca; }
        user.CT { background-color: #c2ecc4; }
        user.AS { background-color: #ffdba5; }
        
        .grey-container {
            background-color: #f8fafc;
            padding: 10px;
            border-radius: 5px;
        }
        .x-symbol {
            color: rgb(151, 151, 151);
            cursor: pointer;
            font-weight: bold;
            padding-right: 10px;
            text-align: right;
        }
        button {
            padding: 10px 15px;
            background-color: #4f92da;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: auto;
            float: right; 
        }


    </style>
</head>
<body>

    <div class="container">

        <table>
            <tr>
                <td colspan="2">
                    <h1>Create Sprint</h1>
                    <p style="color: #575F6E">Add a new sprint and allocate tasks to it.</p>
                </td>
                <td rowspan="2">
                    <label for="sprint-name">Sprint Name</label><br>
                    <input type="text" id="sprint-name" placeholder="Enter Sprint Name"><br>
                    <label for="assign-to">Assign to</label><br>
                    <select id="assign-to">
                        <option value="">Name</option>
                    </select><br>
                    <div class="grey-container" style="height:216px">
                        <table>
                            <tr>
                                <td class="x-symbol">X</td>
                                <td class="label-container"><user class="P">P</user> Name Name</td>
                            </tr>
                            <tr>
                                <td class="x-symbol">X</td>
                                <td class="label-container"><user class="CT">CT</user> Name Name</td>
                            </tr>
                            <tr>
                                <td class="x-symbol">X</td>
                                <td class="label-container"><user class="AS">AS</user> Name Name</td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td rowspan="2">
                    <label for="task-name">Tasks</label><br>
                    <select id="task-name">
                        <option value="">Name</option>
                    </select><br>
                    <div class="grey-container" style="height:300px">
                        <table>
                            <tr>
                                <td class="x-symbol">X</td>
                                <td class="label-container"><user class="P">P</user> Task Name</td>
                            </tr>
                            <tr>
                                <td class="x-symbol">X</td>
                                <td class="label-container"><user class="CT">CT</user> Task Name</td>
                            </tr>
                            <tr>
                                <td class="x-symbol">X</td>
                                <td class="label-container"><user class="AS">AS</user> Task Name</td>
                            </tr>
                        </table>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="start-date">Start Date</label><br>
                    <input type="date" id="start-date"><br>
                    <label for="end-date">End Date</label><br>
                    <input type="date" id="end-date"><br>
                </td>
                <td>
                    <label for="start-time">Start Time</label><br>
                    <input type="time" id="start-time">
                    <label for="end-time">End Time</label><br>
                    <input type="time" id="end-time">
                </td>
            </tr>
        </table>
        
        <button>Create</button>
    </div>

</body>
</html>
