<?php
ob_start();
require('../database/authentication.php');

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

    </style>
</head>
<body>
<?php
require_once('../dashboard/navbar.php');
?>

<div class="mt-5">
    <?php
    require_once('../sprints/table.php');
    ?>
</div>

</div>
</body>
</html>
