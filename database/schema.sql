DROP TABLE IF EXISTS
    `USER`;

CREATE TABLE `USER`
(
    `user_id`       INTEGER      NOT NULL AUTO_INCREMENT,
    `user_email`    VARCHAR(255) UNIQUE NOT NULL,
    `user_name` varchar(64) NOT NULL UNIQUE KEY,
    `user_password` VARCHAR(255)        NOT NULL,
    `user_fname`    VARCHAR(50),
    `user_lname`    VARCHAR(50),
    PRIMARY KEY (`user_id`)
);


INSERT INTO `USER` (`user_email`, `user_name`, `user_password`, `user_fname`, `user_lname`)
VALUES ('john.doe@example.com', 'admin', SHA2('admin12345', 0), 'John', 'Doe');