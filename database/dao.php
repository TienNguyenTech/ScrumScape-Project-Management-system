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

    public function getAllUsers() {
        try {
            $this->_query = "SELECT * FROM user";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute();
            return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }


    public function getTeamMembers() {
        try {
            $this->_query = "SELECT * FROM user where admin = 0";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute();
            return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
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
            // Begin transaction to ensure atomicity
            $this->_db_handle->beginTransaction();
    
            // Update tasks to reset sprint_id and status
            $this->_query = "UPDATE TASK SET sprint_id = NULL, status = 'Not Started' WHERE sprint_id = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$id]);
    
            // Delete the sprint record
            $this->_query = "DELETE FROM sprint WHERE sprint_id = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$id]);
    
            // Check if any rows were affected in the DELETE query
            if ($this->_stmt->rowCount() === 0) {
                echo "No rows were deleted.";
                // Rollback transaction if no sprint was deleted
                $this->_db_handle->rollBack();
                return false;
            }
    
            // Commit the transaction if both queries succeed
            $this->_db_handle->commit();
            return true;
    
        } catch (Exception $e) {
            // Rollback the transaction in case of any error
            $this->_db_handle->rollBack();
            $this->_error = $e->getMessage();
            error_log("Error deleting sprint: " . $e->getMessage()); // Log the error for debugging
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
            return $this->_stmt->fetch(PDO::FETCH_OBJ);
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

    // ================================================ TASK METHODS ==================================================

    public function createTask($taskNo, $taskName, $storyPoints, $priority, $status, $sprintId) {
        try {
            $this->_query = "INSERT INTO task (task_no, task_name, story_points, priority, status, created_at, sprint_id) VALUES (?, ?, ?, ?, ?, CURDATE(), ?)";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$taskNo, $taskName, $storyPoints, $priority, $status, $sprintId]);
            return $this->_db_handle->lastInsertId();
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }

    public function getAllTasks() {
        try {
            $this->_query = "SELECT * FROM task  WHERE sprint_id IS NULL";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute();
            return $this->_stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }

    public function getTask($taskId) {
        try {
            $this->_query = "SELECT * FROM task WHERE task_id = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$taskId]);
            return $this->_stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }


    public function deleteTask($taskId) {
        try {
            $this->_query = "DELETE FROM task WHERE task_id = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$taskId]);
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


    public function updateTask($taskId, $taskNo, $taskName, $storyPoints, $priority, $status, $sprintId) {
        try {
            $this->_query = "UPDATE task 
                         SET task_no = ?, 
                             task_name = ?, 
                             story_points = ?, 
                             priority = ?, 
                             status = ?, 
                             sprint_id = ? 
                         WHERE task_id = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$taskNo, $taskName, $storyPoints, $priority, $status, $sprintId, $taskId]);
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





    
    // ================================================ TASK ASSIGNMENT METHODS ==================================================


    public function assignTask($userID, $taskID) {
        try {
            // Begin transaction to ensure atomicity
            $this->_db_handle->beginTransaction();
    
            $this->_query = "UPDATE task_assignment SET user_id = ?, assignment_date = CURDATE() WHERE task_id = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$userID, $taskID]);
            $rowsAffected = $this->_stmt->rowCount();

            if ($rowsAffected === 0) {
                $this->_query = "INSERT INTO task_assignment (user_id, task_id, assignment_date) VALUES (?, ?, CURDATE())";
                $this->_stmt = $this->_db_handle->prepare($this->_query);
                $this->_stmt->execute([$userID, $taskID]);                
            }

            // Commit the transaction if both queries succeed
            $this->_db_handle->commit();
            return true;
        } catch (Exception $e) {
            // Rollback the transaction in case of any error
            $this->_db_handle->rollBack();
            $this->_error = $e->getMessage();
            error_log("Error assigning task: " . $e->getMessage()); // Log the error for debugging
            return false;
        }
    }



    public function logHours($taskID, $userID, $hours) {
        try {
            $this->_query = "INSERT into hours_log (task_id, user_id, hours, log_date) VALUES (?, ?, ?, CURDATE());";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$taskID, $userID, $hours]);

            return true;
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return false;
        }
    }


    public function getTotalTaskHours($taskID) {
        try {
            $this->_query = "SELECT sum(hours) as total_hours FROM hours_log WHERE task_id = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$taskID]);
    
            $result = $this->_stmt->fetch(PDO::FETCH_OBJ);  // Fetch single row as object
            return $result->total_hours ?? 0;  // Return total_hours or 0 if no result
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }

    public function getTaskHours($taskID, $start_date, $end_date) {
        try {
            $this->_query = "SELECT DATE_FORMAT(log_date, '%d/%m/%Y') as date, hours FROM hours_log WHERE task_id = ?
            and log_date between ? and ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$taskID, $start_date, $end_date]);
    
            // Fetch all rows
            $result = $this->_stmt->fetchAll(PDO::FETCH_OBJ);
            
            // Check if result is empty
            if (empty($result)) {
                // Optionally log the message, return null or empty array instead of echoing
                // echo "No rows were returned."; 
                return null;  // or return []; depending on your use case
            }
    
            return $result;
        } catch (Exception $e) {
            // Store error and return null
            $this->_error = $e->getMessage();
            return null;
        }
    }
    

    public function getTotalUserHours($userID) {
        try {
            $this->_query = "SELECT sum(hours) as total_hours FROM hours_log WHERE user_id = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$userID]);
    
            $result = $this->_stmt->fetch(PDO::FETCH_OBJ);
            return $result->total_hours ?? 0;  // Return total_hours or 0 if no result
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }

    public function getUserHours($userID, $start_date, $end_date) {
        try {
            // Corrected DATE_FORMAT string
            $this->_query = "SELECT DATE_FORMAT(log_date, '%d/%m/%Y') as date, sum(hours) as total_hours FROM hours_log WHERE user_id = ?
            and log_date between ? and ?
            group by log_date";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$userID, $start_date, $end_date]);
        
            // Fetch all rows
            $result = $this->_stmt->fetchAll(PDO::FETCH_OBJ);
            
            // Check if result is empty
            if (empty($result)) {
                // Optionally log the message, return null or empty array instead of echoing
                // echo "No rows were returned."; 
                return null;  // or return []; depending on your use case
            }
    
            return $result;
        } catch (Exception $e) {
            // Store error and return null
            $this->_error = $e->getMessage();
            return null;
        }
    }
    
    

    public function getTotalSprintHours($sprintID) {
        try {
            $this->_query = "SELECT sum(hours) as total_hours FROM hours_log h JOIN task t ON h.task_id = t.task_id WHERE t.sprint_ID = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$sprintID]);
    
            $result = $this->_stmt->fetch(PDO::FETCH_OBJ);
            return $result->total_hours ?? 0;  // Return total_hours or 0 if no result
        } catch (Exception $e) {
            $this->_error = $e->getMessage();
            return null;
        }
    }

    public function getSprintHours($sprintID, $start_date, $end_date) {
        try {
            $this->_query = "SELECT DATE_FORMAT(h.log_date, '%d/%m/%Y') as date, h.hours 
            FROM hours_log h JOIN task t ON h.task_id = t.task_id 
            WHERE t.sprint_ID = ? and h.log_date between ? and ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$sprintID, $start_date, $end_date]);
    
            // Fetch all rows
            $result = $this->_stmt->fetchAll(PDO::FETCH_OBJ);
            
            // Check if result is empty
            if (empty($result)) {
                // Optionally log the message, return null or empty array instead of echoing
                // echo "No rows were returned."; 
                return null;  // or return []; depending on your use case
            }
    
            return $result;
        } catch (Exception $e) {
            // Store error and return null
            $this->_error = $e->getMessage();
            return null;
        }
    }



    // ================================================ CHART METHODS ==================================================






    public function getCompleteSprintPoints($sprintID, $start_date, $end_date) {
        try {
            $this->_query = "SELECT completion_date, sum(story_points) as tot_story_points
            FROM task
            WHERE sprint_ID = ? and status = 'Completed' and completion_date is not null
            and completion_date between ? and ?
            GROUP BY completion_date";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$sprintID, $start_date, $end_date]);
    
            // Fetch all rows
            $result = $this->_stmt->fetchAll(PDO::FETCH_OBJ);
            
            // Check if result is empty
            if (empty($result)) {
                // Optionally log the message, return null or empty array instead of echoing
                // echo "No rows were returned."; 
                return null;  // or return []; depending on your use case
            }
    
            return $result;
        } catch (Exception $e) {
            // Store error and return null
            $this->_error = $e->getMessage();
            return null;
        }
    }    

    public function getTotalStoryPoints($sprintID) {
        try {
            $this->_query = "SELECT sum(story_points) as total_story_points
            FROM task
            WHERE sprint_ID = ?";
            $this->_stmt = $this->_db_handle->prepare($this->_query);
            $this->_stmt->execute([$sprintID]);
    
            // Fetch all rows
            $result = $this->_stmt->fetch(PDO::FETCH_OBJ);
            
            // Check if result is empty
            if (empty($result)) {
                // Optionally log the message, return null or empty array instead of echoing
                // echo "No rows were returned."; 
                return null;  // or return []; depending on your use case
            }
    
            return $result;
        } catch (Exception $e) {
            // Store error and return null
            $this->_error = $e->getMessage();
            return null;
        }
    }    

}





