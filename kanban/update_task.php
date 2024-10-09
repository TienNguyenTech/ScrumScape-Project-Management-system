<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task Page</title>

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

        .assign-to {
            background-color: #059BE5;
            color: white;
            font-family: "Montserrat";
            font-weight: regular;
            width: 25%;
            border-radius: 8px;
            border:none;
        }

        .assign-to:focus {
            background-color: #059BE5;
            color:white;
            box-shadow: none;
        }

        .main-header {
            font-size: 15px;
            color: #6F7482;
            font-family: "Montserrat";
            margin-bottom: 10px;
            font-weight: bold;
            padding-top:30px;
        }

        .custom-btn {
            background-color:#0888C7;
            color:white; 
            font-size: 12px;
            font-family: "Montserrat";
        }

        .custom-btn:hover {
            background-color: #0A6C9C;
            color:white;
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
                <div>
                    <img src="../assets/logo.png" style="width: 250px; padding: 80px 0px 0px 100px; "/>
                </div>

                <!-- Fields -->
                <div style="padding: 50px 0px 0px 200px;">
                    <h1 style="font-family: Montserrat; font-weight: bold; font-size: 30px;"> Task Name </h1>
                    <h2 class="main-header">Assign To </h2>
                    <select class="form-control form-control-sm assign-to">
                        <option>Jane Doe</option>
                    </select>
                    <h2 class="main-header"> Task Description </h2>
                    <textarea class="form-control main-field" rows="8" style="resize: none;" placeholder="Insert description..."></textarea>
                </div>

                <!-- Button -->
                <div style="padding: 10px 0px 0px 75%">
                    <button type="button" class="btn custom-btn">Update Task</button>
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
                    <select class="form-control form-control-sm sub-field main-field">
                        <option>Story</option>
                        <option> Bug </option>
                    </select>
                    <hr style="border: 1px solid #AEA8A8; width: 50%; margin: 20px auto;">
                </div>

                <!-- Story Points -->
                <div class="info-section">
                    <div class="sub-header">
                        <img src="../assets/storypt_icon_grey.svg" style="width:18px; color: #6F7482; padding-bottom: 8px;"/>    
                        <h4> Story Points </h4>
                    </div>
                    <select class="form-control form-control-sm sub-field main-field">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                    <hr style="border: 1px solid #AEA8A8; width: 50%; margin: 20px auto;">
                </div>

                <!-- Priority -->
                <div class="info-section">
                    <div class="sub-header">
                        <img src="../assets/priority_icon_grey.svg" style="width:14px; color: #6F7482; padding-bottom: 8px;"/>    
                        <h4> Priority </h4>
                    </div>
                    <select class="form-control form-control-sm sub-field main-field">
                        <option>Low</option>
                        <option>Medium</option>
                        <option>Important</option>
                        <option>Urgent</option>
                    </select>
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
                                <input class="form-check-input position-static custom-check" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
                                <span class="tag" style="background-color: #7F74F6;"> Frontend </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
                                <span class="tag" style="background-color: #7F74F6;"> Backend </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
                                <span class="tag" style="background-color: #E34F9F"> API </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
                                <span class="tag" style="background-color: #E34F9F"> Database </span>
                            </div>
                        </div>

                        <div class="tags">
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
                                <span class="tag" style="background-color: #E34F9F"> Framework </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
                                <span class="tag" style="background-color: #E34F9F"> Testing </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
                                <span class="tag" style="background-color: #E1982A"> UI </span>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input position-static" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
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