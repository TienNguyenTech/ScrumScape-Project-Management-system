<?php
require_once("connection.php");

/**
 * @var string $db_hostname
 * @var string $db_name
 * @var string $db_username
 * @var string $db_password
 */
class dao
{
    private $_query;
    private $_db_handle;
    private $_stmt;
    private $_error;

    public function __construct() {
        $this->connectDatabase();
    }

    private function connectDatabase() {
        try {
            global $db_hostname, $db_username, $db_password, $db_name;
            $dsn = "mysql:host=$db_hostname;dbname=$db_name";
            $this->_db_handle = new PDO($dsn, $db_username, $db_password);
        } catch (PDOException $e) {
            $this->_error = $e->getMessage();
        }
    }

    public function get_error() {
        return $this->_error;
    }

    // ================================================ USER METHODS ==================================================

    // Insert a new user into the USER table
    public function insertUser($email, $username, $password, $fname, $lname) {
        try {
            $this->_query = "INSERT INTO `USER` (`user_email`, `user_name`, `user_password`, `user_fname`, `user_lname`) VALUES (?, ?, SHA2(?, 256), ?, ?)";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $result = $this->_stmt->execute([$email, $username, $password, $fname, $lname]);
            return $result;
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return false;
        }
    }

    // Retrieve a user based on email and password
    public function getUserByCredentials($username, $password) {
        try {
            $this->_query = "SELECT * FROM `USER` WHERE `user_name` = ? AND `user_password` = SHA2(?, 256)";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$username, $password]);
            return $this->_stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }
}
