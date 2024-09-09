<?php
ob_start();

// Activate the session
//session_start();
require_once('../database/dao.php');
$dao = new DAO();

$sprints = $dao->getAllSprints();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="../assets/logo-sm.png">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .header {
            color: white;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            height: 70px;
            background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR9js-JOlLed4a0hLYt-YkdopyN3EVPRzBTRaERMwu3P6emcrSx');
            background-size: cover;
            background-position: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 25px;
        }

        .container {
            background-color: white;
            width: 750px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 50px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            font-weight: bold;
        }

        td {
            border: none;
        }

        .sprint-card-middle,
        .sprint-card-left,
        .sprint-card-right {
            background-color: #A1E8F8;
            padding: 10px 5px;
            height: 20px;
            margin: 15px 0;
        }

        .sprint-card-left {
            border-radius: 15px 0 0 15px;
        }

        .sprint-card-right {
            border-radius: 0 15px 15px 0;
        }

        .view-more button {
            background-color: #1fafed;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }

        .view-more button:hover {
            background-color: #1a56d1;
        }

        .icon img {
            width: 20px;
            cursor: pointer;
        }

        main {
            font-family: 'Lexend', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Team user card styling */
        .maincard {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 50px;
            margin-left: 100px;
        }

        .team-table th, .team-table td {
            padding: 5px;
            text-align: left;
        }

        .user-details h2 {
            margin: 0;
            text-align: left;
            font-size: 18px;
            font-weight: 600;
        }

        .user-details p {
            margin: 0;
            text-align: left;
            font-size: 16px;
            color: gray;
        }

        .link-item a {
            text-decoration: none;
            font-size: 14px;
            color: black;
            display: flex;
            align-items: center;
        }

        .link-item a img {
            margin-right: 5px;
        }

        .tasks h3 {
            font-size: 18px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .tasks p {
            font-size: 14px;
            color: gray;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<?php
require_once('../dashboard/navbar.php');
?>

<div class="container mt-5">
    <div class="header">
        MY SPRINTS
    </div>

    <table>
        <thead>
        <tr class="text-center">
            <th>Sprint No.</th>
            <th>Status</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Edit/View</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($sprints): ?>
            <?php foreach ($sprints as $sprint): ?>
                <tr>
                    <td class="sprint-card-left"><?= htmlspecialchars($sprint->sprint_no) ?></td>
                    <td class="sprint-card-middle"><?= htmlspecialchars($sprint->status) ?></td>
                    <td class="sprint-card-middle"><?= htmlspecialchars($sprint->start_date) ?></td>
                    <td class="sprint-card-middle"><?= htmlspecialchars($sprint->end_date) ?></td>
                    <td class="sprint-card-right icon">
                        <a href="edit_sprint.php?sprint_no=<?= htmlspecialchars($sprint->sprint_no) ?>">
                            <img src="https://cdn-icons-png.freepik.com/256/8256/8256321.png" alt="Edit Icon">
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No sprints found.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
