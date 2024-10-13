<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task Page</title>

    <!-- Boostrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        
        .body1 {
            display:flex;
            width: 100%;
            height:100vh;
        }

        .main-field {
            background-color: #E5E5E5;
            width: 80%;
            border: none;
            margin-bottom: 30px;
        }

        .main-field:focus {
            background-color: #E5E5E5;
            box-shadow: 0 0 0 0.2rem rgba(111, 116, 130, 0.25); 
        }

        .main-header {
            font-size: 20px;
            color: #6F7482;
            font-family: "Montserrat"
            margin-bottom: 100px;
            font-weight: bold;
            padding: 30px 0px 10px 0px;
        }

        .desc {
            width: 75%;
            font-family: Montserrat;
            font-size: 15px;
        }

        .sub-header {
            display:flex;
            gap: 15px;
            padding: 30px 0px 10px 50px;
        }

        .sub-header h4 {
            font-family: "Montserrat";
            color: #6F7482;
            font-weight: light;
            font-size: 15px;
        }
        
        .sub-field {
            width: 45%;
            margin-left: 100px;
            font-family: Montserrat;
            font-size: 13px;
            font-weight: bold;
        }

        .info-section {
            height:20%;
        }

        .tags {
            display: flex;
            flex-direction: column;
            gap:13px;
            width: 50%;
            padding: 20px 0px 0px 50px;
        }

        .tag {
            margin-left: 10px;
            padding: 8px;
            border-radius: 10px;
            font-family: "Montserrat";
            font-weight: 0.9;
            color: white;
            font-size: 12px;
        }
    </style>

</head>

<body>

    <div> 

        <div class="body1"> 
            
            <div style="width:75%;">
                <!-- Logo -->
                <div style= " display:flex;">
                    <img src="../assets/logo.png" style="width: 250px; padding: 80px 0px 0px 100px; "/>
                    <div style="padding: 95px 0px 0px 750px; display:flex;">
                        <!-- Edit task button, redirect to update task backlog view. -->
                        <button type="button" class="btn btn-outline-primary" style="padding:7px; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                            </svg>
                            <span class="visually-hidden"></span>
                        </button>
                        <!-- Exit task inspect button, redirect to product backlog. -->
                        <button type="button" class="btn btn-outline-danger" style="padding: 8px; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="20" height="20" fill="currentColor">
                                <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"/>
                            </svg>
                            <span class="visually-hidden"></span>
                        </button>

                    </div>
                </div>

                <!-- Fields -->
                <div style="padding: 50px 0px 0px 200px;">
                    <h1 style="font-family: Montserrat; font-weight: bold; font-size: 30px;"> Task Name </h1>
                    <h2 class="main-header">Description </h2>
                    <p class="desc">
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
                        sunt in culpa qui officia deserunt mollit anim id est laborum."
                    </p>
                </div>
            </div>

            <!-- Side Panel -->
            <!-- Note: Don't add background color for dropdowns, otherwise might affect human aspect part of project.-->
            <div style="background-color: #F4F3F3; width: 25%;">

                <!-- Task Type -->
                <div class="info-section">
                    <div class="sub-header">
                        <img src="../assets/task_icon_grey.svg" style="width:15px; color: #6F7482; padding-bottom: 8px;"/>    
                        <h4> Task Type </h4>
                    </div>
                    <p class="sub-field"> Story </p>
                    <hr style="border: 1px solid #AEA8A8; width: 50%; margin: 20px auto;">
                </div>

                <!-- Story Points -->
                <div class="info-section">
                    <div class="sub-header">
                        <img src="../assets/storypt_icon_grey.svg" style="width:18px; color: #6F7482; padding-bottom: 8px;"/>    
                        <h4> Story Points </h4>
                    </div>
                    <p class="sub-field"> 1 </p>
                    <hr style="border: 1px solid #AEA8A8; width: 50%; margin: 20px auto;">
                </div>

                <!-- Priority -->
                <div class="info-section">
                    <div class="sub-header">
                        <img src="../assets/priority_icon_grey.svg" style="width:14px; color: #6F7482; padding-bottom: 8px;"/>    
                        <h4> Priority </h4>
                    </div>
                    <p class="sub-field"> Low </p>
                    <hr style="border: 1px solid #AEA8A8; width: 50%; margin: 20px auto;">
                </div>

                <!-- Tags -->
                <div class="info-section-tags" style="height: 40%;">
                    <div class="sub-header">
                        <img src="../assets/tags_icon.svg" style="width:18px; color: #6F7482; padding-bottom: 8px;"/>    
                        <h4> Tags </h4>
                    </div>
                    
                    <!-- Don't change colours, picked specifically for colour blind aspect.-->
                    <div style="display:flex;">
                        <div class="tags">
                            <div class="form-check">
                                <span class="tag" style="background-color: #7F74F6;"> Frontend </span>
                            </div>
                            <div class="form-check">
                                <span class="tag" style="background-color: #7F74F6;"> Backend </span>
                            </div>
                            <div class="form-check">
                                <span class="tag" style="background-color: #E34F9F"> API </span>
                            </div>
                            <div class="form-check">
                                <span class="tag" style="background-color: #E34F9F"> Database </span>
                            </div>
                        </div>

                        <div class="tags">
                            <div class="form-check">
                                <span class="tag" style="background-color: #E34F9F"> Framework </span>
                            </div>
                            <div class="form-check">
                                <span class="tag" style="background-color: #E34F9F"> Testing </span>
                            </div>
                            <div class="form-check">
                                <span class="tag" style="background-color: #E1982A"> UI </span>
                            </div>
                            <div class="form-check">
                                <span class="tag" style="background-color: #E1982A"> UX </span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            
            </div>

        </div>

        <div class="body2">
        </div>

    </div>

</body>

</html>