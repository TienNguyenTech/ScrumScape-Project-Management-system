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

    public function resetPassword($password, $username) {
        try {
            $this->_query = "UPDATE `USER` SET `user_password` = SHA2(?, 256) WHERE `user_name`  = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$password, $username]);
            $rowsAffected = $this->_stmt->rowCount();

            if ($rowsAffected === 0) {
                echo "No rows were updated.";
                return false;
            }
            return true;
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

    public function getUserByUsername($username) {
        try {
            $this->_query = "SELECT * FROM `USER` WHERE `user_name` = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$username]);
            return $this->_stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }

    // ================================================ SPRINT METHODS ==================================================

    public function getAllSprints() {
        try {
            $this->_query = "SELECT * FROM SPRINT";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute();
            return $this->_stmt->fetchAll(PDO::FETCH_OBJ);  
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }


    public function createSprint($no, $name, $start_date, $end_date, $duration) {
        try {
            $this->_query = "INSERT INTO sprint
            (sprint_no, sprint_name, start_date, end_date, status, created_at, duration) 
            VALUES (?, ?, ?, ?, 'Not Started', CURDATE(), ?)";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$no, $name, $start_date, $end_date, $duration]);
            $sprintId = $this->_db_handle->lastInsertId();
            return $sprintId;
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }
    
    
    public function deleteSprint($id) { 
        try {
            $this->_query = "DELETE FROM sprint WHERE sprint_id = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$id]); 
            $rowsAffected = $this->_stmt->rowCount();
            if ($rowsAffected === 0) {
                echo "No rows were deleted.";
                return false;
            }
            return true;
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return false;
        }
    }
        
    public function getSprint($id) { 
        try {
            $this->_query = "SELECT * FROM sprint WHERE sprint_id = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$id]); 
            $rowsAffected = $this->_stmt->rowCount();
            if ($rowsAffected === 0) {
                echo "No rows were selected.";
                return null;
            }
            if ($rowsAffected > 1) {
                echo "More than one row was returned.";
                return null;
            }
            return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }
        
        
    public function updateSprint($col, $val, $id) { 
        try {
            $this->_query = "update sprint set ? = ? WHERE sprint_id = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$col, $val, $id,]); 
            $rowsAffected = $this->_stmt->rowCount();
            if ($rowsAffected === 0) {
                echo "No rows were updated.";
                return false;
            }
            if ($rowsAffected > 1) {
                echo "More than one row was returned.";
                return false;
            }
            return true;
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return false;
        }
    }


    public function inspectSprint($id) { 
        try {
            $this->_query = "SELECT * FROM task WHERE sprint_id = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$id]); 
            $rowsAffected = $this->_stmt->rowCount();
            if ($rowsAffected === 0) {
                echo "No rows were selected.";
                return null;
            }
            return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }

    

}



