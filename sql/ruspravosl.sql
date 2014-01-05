DROP DATABASE IF EXISTS `ruspravosl`;
CREATE DATABASE `ruspravosl` DEFAULT CHARSET utf8;

use `ruspravosl`;

GRANT SELECT, INSERT, UPDATE, DELETE
ON `ruspravosl`.*
TO `smite`@localhost IDENTIFIED BY 'smite107';

CREATE TABLE users (
   id             INT         NOT NULL AUTO_INCREMENT,
   email          VARCHAR(70) NOT NULL,
   login          VARCHAR(45) NOT NULL,
   password       CHAR(40)    NOT NULL,
   salt           VARCHAR(8)  NOT NULL,
   PRIMARY KEY(id),
   UNIQUE KEY(email)
);

CREATE TABLE IF NOT EXISTS `images` (
   `id`      INT(11) NOT NULL AUTO_INCREMENT,
   `good_id` INT(11) NOT NULL,
   PRIMARY KEY (`id`)
);