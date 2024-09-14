# PHP Project Setup Guide

## Prerequisites

Before you can run this project, ensure that you have the following installed on your system:

- **PHP**: Make sure you have PHP installed. You can download it from [PHP's official website](https://www.php.net/downloads).
- **MySQL**: Ensure that MySQL is installed. You can download it from [MySQL's official website](https://dev.mysql.com/downloads/).
- **phpMyAdmin**: Install phpMyAdmin version 5.2.1 or later. You can download it from [phpMyAdmin's official website](https://www.phpmyadmin.net/downloads/).

## Setup Instructions

1. **Start phpMyAdmin**:
    - Open a terminal/command prompt and navigate to the directory where phpMyAdmin is located.
    - Run the following command to start phpMyAdmin on localhost:
      ```bash
      php -S localhost:8080
      ```
    - Open a web browser and go to [http://localhost:8080](http://localhost:8080).

2. **Create Database and User**:
    - Once phpMyAdmin is running, log in using your MySQL credentials.
    - Create a new user with the following details:
        - **Username**: `fit2101_project`
        - **Password**: `fit2101`
    - Create a new database named `fit2101_project`.

3. **Import Database Schema**:
    - After creating the database, navigate to the **SQL** tab in phpMyAdmin.
    - Open the `database/schema.sql` file located in your project directory.
    - Copy the contents of `schema.sql` and paste them into the SQL query editor in phpMyAdmin.
    - Execute the query to create the necessary tables in the `fit2101_project` database.

4. **Run the Application**:
    - Go back to your terminal/command prompt.
    - Navigate to the project directory:
      ```bash
      cd /path/to/your/project
      ```
    - Start the PHP built-in server on port 8081:
      ```bash
      php -S localhost:8081
      ```
    - Open a web browser and go to [http://localhost:8081](http://localhost:8081).

5. **Using the App**:
    - You should now see the application running in your browser. Follow the on-screen instructions to use the app.

## Troubleshooting

- Ensure that both phpMyAdmin and your PHP server are running on different ports to avoid conflicts.
- Double-check the database connection details in `database/connection.php` if you encounter issues connecting to the database.

## Contact

If you encounter any issues or have questions, please reach out to:

**Aditya Patel** - Full Stack Developer  
[apat0080@student.monash.edu](mailto:apat0080@student.monash.edu)
