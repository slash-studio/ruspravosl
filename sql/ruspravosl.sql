DROP DATABASE IF EXISTS `ruspravosl`;
CREATE DATABASE `ruspravosl` DEFAULT CHARSET utf8;

use `ruspravosl`;

GRANT ALL
ON `ruspravosl`.*
TO `smite`@localhost IDENTIFIED BY 'smite107';


CREATE TABLE `users` (
   `id`          INT         NOT NULL AUTO_INCREMENT,
   `login`       VARCHAR(45) NOT NULL,
   `name`        VARCHAR(80) NOT NULL,
   `surname`     VARCHAR(80) NOT NULL,
   `age`         INT         NOT NULL,
   `address`     VARCHAR(100) NOT NULL,
   `school`      VARCHAR(80) NOT NULL,
   `password`    CHAR(50)    NOT NULL,
   `salt`        VARCHAR(8)  NOT NULL,
   PRIMARY KEY(`id`),
   UNIQUE KEY(`login`)
);

CREATE TABLE IF NOT EXISTS `images` (
   `id`      INT(11) NOT NULL AUTO_INCREMENT,
   `user_id` INT(11) NOT NULL,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
);


DROP TRIGGER IF EXISTS `insert_users`;

DELIMITER //

CREATE TRIGGER `insert_users` BEFORE INSERT ON `users`
FOR EACH ROW BEGIN
   SET new.password = create_encrypted_pass(new.password, new.salt);
END
//
DELIMITER ;


DELIMITER $$

CREATE DEFINER=`smite`@`localhost` FUNCTION `create_encrypted_pass`(pass CHAR(50), salt VARCHAR(8)) RETURNS char(50) CHARSET utf8
BEGIN
   RETURN MD5(CONCAT(salt, MD5(CONCAT(pass, salt)), SUBSTR(salt, 2)));
END$$

DELIMITER ;