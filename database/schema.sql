DROP TABLE IF EXISTS
    `USER`;

DROP TABLE IF EXISTS
    `SPRINT`;

-- Creating USER table
CREATE TABLE `USER`
(
    `user_id`       INTEGER      NOT NULL AUTO_INCREMENT,
    `user_email`    VARCHAR(255) UNIQUE NOT NULL,
    `user_name`     VARCHAR(64)  NOT NULL UNIQUE KEY,
    `user_password` VARCHAR(255) NOT NULL,
    `user_fname`    VARCHAR(50),
    `user_lname`    VARCHAR(50),
    `admin`         BOOLEAN      NOT NULL,
    PRIMARY KEY (`user_id`)
);

-- Creating SPRINT table
CREATE TABLE `SPRINT`
(
    `Sprint_No`   INTEGER      NOT NULL AUTO_INCREMENT,
    `Status`      VARCHAR(50)  NOT NULL,
    `Start_Date`  DATE         NOT NULL,
    `End_Date`    DATE         NOT NULL,
    PRIMARY KEY (`Sprint_No`)
);

-- Inserting sample users
INSERT INTO `USER` (`user_email`, `user_name`, `user_password`, `user_fname`, `user_lname`, `admin`)
VALUES
    ('john.doe@example.com', 'admin', SHA2('admin12345', 0), 'John', 'Doe', TRUE),
    ('jane.doe@example.com', 'jane_d', SHA2('jane12345', 0), 'Jane', 'Doe', FALSE),
    ('alex.smith@example.com', 'alex_s', SHA2('alexpass', 0), 'Alex', 'Smith', FALSE);

-- Inserting sample sprints
INSERT INTO `SPRINT` (`Status`, `Start_Date`, `End_Date`)
VALUES
    ('Not Started', '2024-09-01', '2024-09-15'),
    ('In Progress', '2024-09-16', '2024-09-30'),
    ('Completed', '2024-08-01', '2024-08-15');
