<?php
ob_start();
session_start();
require('../auth.php');
require_once('../database/dao.php');

$dao = new DAO();


// include 'dao.php';        // DAO class

// Step 1: Check if form data is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Take out variables
    $email = $_POST['user_email'];
    $username = $_POST['user_name'];
    $password = $_POST['user_password'];
    $first_name = $_POST['user_fname'];
    $last_name = $_POST['user_lname'];
    $is_admin = isset($_POST['admin']) ? 1 : 0;  // Checkbox for admin access (1 if checked, 0 if not)


    $result = $dao->insertUser($email, $username, $password, $first_name, $last_name, $is_admin);

    // Step 5: Handle the result of the insertion
    if ($result) {
        echo "Registration successful!";
        
    } else {
        echo "Error: Unable to register user.";
    }

    // Then, redirect the user to another page
    header("Location:dashboard/");
    exit();

}


?>