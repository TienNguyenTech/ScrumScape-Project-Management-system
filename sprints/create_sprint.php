
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Update Sprint Page </title>

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
    </style>

</head>

<body>
    <div class="container">

        <!-- Header with logo-->
        <div class="header" style="margin-left: -120px; margin-top: 30px;">
            <img src="/assets/logo.png" width="180px" />
        </div>

        <!-- Main body -->
        <div class="content-container">

            <div class="column">
                <h1> Create Sprint </h1>
                <p> Add a new sprint and allocate tasks to it. </p>
                <h4> Start Date & Time </h4>
                <select class="form-control">
                    <option> Aditya Patel </option>
                    <option> Danna Pabayo </option>
                    <option> Tien Nguyen </option>
                </select>
                <h4> End Date & Time </h4>
                <select class="form-control">
                    <option> Aditya Patel </option>
                    <option> Danna Pabayo </option>
                    <option> Tien Nguyen </option>
                </select>
            </div>

            <div class="column">
                <h4> Sprint Name </h4>
                <input class="form-control form-control-sm" type="text" placeholder="My first sprint">
                <h4> Assign to </h4>
                <div class="scrollable-box">
                    <div class="task-card">
                        <h3 class="task-title">Person 1</h3>
                    </div>
                    <div class="task-card">
                        <h3 class="task-title">Person 2</h3>
                    </div>
                    <div class="task-card">
                        <h3 class="task-title">Person 3</h3>
                    </div>
                    <div class="task-card">
                        <h3 class="task-title">Person 4</h3>
                    </div>
                    <div class="task-card">
                        <h3 class="task-title">Person 5</h3>
                    </div>
                    <div class="task-card">
                        <h3 class="task-title">Person 6</h3>
                    </div>

                </div>

                <style>
                    .scrollable-box {
                        width: 100%;
                        height: 300px;
                        overflow-y: scroll;
                        padding: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        background-color: #F8FAFC;
                        border: none;
                    }

                    .task-card {
                        background-color: #F8FAFC;
                        border: none;
                        padding: 10px;
                        /* Reduced padding to lower the height */
                        width: 90%;
                        /* Make the cards wider, you can adjust the percentage */
                        margin: 10px auto;
                        /* Center the card horizontally and add spacing */
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                        /* Optional shadow */
                        border-radius: 8px;
                        /* Optional: to give the cards rounded corners */
                    }

                    .task-title {
                        font-size: 1.2rem;
                        margin-bottom: 5px;
                        /* Less margin to reduce space under title */
                    }
                </style>


            </div>
            

            <div class="column">
    <h4>Tasks</h4>
    <div class="scrollable-box">
        <?php if (!empty($tasks) && is_array($tasks)): ?>
            <?php foreach ($tasks as $task): ?>
                <div class="task-card">
                    <p class="task-title"><?= htmlspecialchars($task->task_name) ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No tasks available.</p>
        <?php endif; ?>
    </div>
</div>

        
            
        

        <!-- Footer with button-->
        <div class="footer">
            <button type="button" class="btn custom-btn">Update Sprint</button>
        </div>
    </div>
</body>

</html>