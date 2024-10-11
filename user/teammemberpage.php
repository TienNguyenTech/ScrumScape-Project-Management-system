<!DOCTYPE html>
<html lang="en">
<head>
    <title>Team Members</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 85%;
            margin: 0 auto;
            background-color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: white;
            font-size: 18px;
        }

        tr {
            background-color: #E4F3F5; 
            border-bottom: 10px solid #ffffff;
        }

        .title-search {
            background-color: white;
            display: flex;
            justify-content: flex-start;
            align-items: left;
            padding: 10px;
        }

        .title-search h2 {
            margin: 0;
            font-size: 40px; 
            font-weight: bold;
        }

        .search-bar {
            display: flex;
            align-items: center;
            border: 0px;
            padding: 5px;
            background-color: #E6EBEC;
        }

        .search-bar input {
            border: none;
            outline: none;
            padding: 8px;
            font-size: 14px;
            background-color: #E6EBEC;
            color: #909090;
        }

        .search-bar img {
            width: 20px;
            height: 20px;
            margin-left: 5px;
            cursor: pointer;
        }

        .search-bar img:hover {
            transform: scale(1.1);
        }

        button {
            padding: 8px 16px;
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #2980b9;
        }

        .icon {
            text-align: center;
            cursor: pointer;
        }

        .icon img {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .icon img:hover {
            transform: scale(1.1);
            transition: transform 0.2s;
        }

        .create-member-btn {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            float: right;
            margin-top: 10px;
        }

        .team-table {
            margin-top: 20px;
        }

        /*Popup Modal styles */
        .modal {
        display: none; 
        position: fixed; 
        z-index: 1; 
        left: 50%;  
        top: 50%;   
        width: 100%; 
        height: 100%; 
        padding-top: 20px; 
        transform: translate(-50%, -60%); 
        }


        .modal-content {
            background-color: #ffffff;
            margin: 10% auto; 
            padding: 15px;
            height: 75%; 
            width: 50%; 
            box-shadow: 0 4px 20px rgba(8, 58, 86, 0.5);
            overflow: auto; 
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,.close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        
        .modal-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .modal-table th, .modal-table td {
            padding: 10px;
            border: 0px;
            text-align: left;
            background-color: white;
        }

        .modal-table th {
            background-color: #ffffff;
            color: rgb(0, 0, 0)
        }

        .chart-placeholder {
        width: 100%;
        height: 420px;
        background-color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 5px;
        overflow: hidden; 
        }

        .chart-placeholder img {
        max-height: 90%; 
        }

        input[type="date"] {
        border: none; 
        background-color: #ddecf0; 
        color: #727272; 
        font-size: 16px; 
        padding: 10px; 
        border-radius: 4px; 
        outline: none; 
        width: 100%; 
        box-sizing: border-box; 
    }

        input[type="date"]::placeholder {
        color: #727272; 
    }

    </style>
</head>
<body>

    <div class="container">
        <table>
            <tr class="title-search">
                <td>
                    <h2>Team Members</h2>
                </td>
                <td>
                    <div class="search-bar">
                        <input type="text" placeholder="Search member name">
                        <img src="https://cdn-icons-png.flaticon.com/512/482/482631.png" alt="Search" title="Search">
                    </div>
                </td>
            </tr>
        </table>

        <table class="team-table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>View Individual Progress</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Team Member Name</td>
                    <td>teammemberemail@gmail.com</td>
                    <td class="icon" onclick="openModal()">
                        <img src="https://static-00.iconduck.com/assets.00/line-chart-icon-2048x1890-dzg7lyvp.png" alt="View Progress" title="View Progress">
                    </td>
                </tr>
                <tr>
                    <td>Team Member Name</td>
                    <td>teammemberemail@gmail.com</td>
                    <td class="icon" onclick="openModal()">
                        <img src="https://static-00.iconduck.com/assets.00/line-chart-icon-2048x1890-dzg7lyvp.png" alt="View Progress" title="View Progress">
                    </td>
                </tr>
                <tr>
                    <td>Team Member Name</td>
                    <td>teammemberemail@gmail.com</td>
                    <td class="icon" onclick="openModal()">
                        <img src="https://static-00.iconduck.com/assets.00/line-chart-icon-2048x1890-dzg7lyvp.png" alt="View Progress" title="View Progress">
                    </td>
                </tr>
                <tr>
                    <td>Team Member Name</td>
                    <td>teammemberemail@gmail.com</td>
                    <td class="icon" onclick="openModal()">
                        <img src="https://static-00.iconduck.com/assets.00/line-chart-icon-2048x1890-dzg7lyvp.png" alt="View Progress" title="View Progress">
                    </td>
                </tr>
                <tr>
                    <td>Team Member Name</td>
                    <td>teammemberemail@gmail.com</td>
                    <td class="icon" onclick="openModal()">
                        <img src="https://static-00.iconduck.com/assets.00/line-chart-icon-2048x1890-dzg7lyvp.png" alt="View Progress" title="View Progress">
                    </td>
                </tr>
            </tbody>
        </table>

        <button class="create-member-btn">+ Create New Member</button>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Member Name</h2>
            <table class="modal-table">
                <thead>
                    <tr>
                        <th>Select Date Range</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>    
                        <form>
                            <label for="dateInput">Start Date:</label>
                            <input type="date" id="dateInput" name="dateInput">
                        </form>
                    </td>
                    <td>    
                        <form>
                            <label for="dateInput">End Date:</label>
                            <input type="date" id="dateInput" name="dateInput">
                        </form>
                    </td>   
                    <td>
                        <button class="create-member-btn">Update</button>
                    </td>
                    </tr>
                </tbody>
            </table>
            <div class="chart-placeholder">
                <img src="https://images.twinkl.co.uk/tw1n/image/private/t_630/u/ux/barchart_ver_1.jpg" alt="Graph Placeholder">
            </div>
            
        </div>
    </div>

    <script>
        var modal = document.getElementById("myModal");
        function openModal() {
            modal.style.display = "block";
        }
        function closeModal() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>
</html>
