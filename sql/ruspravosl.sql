DROP DATABASE IF EXISTS `ruspravosl`;
CREATE DATABASE `ruspravosl` DEFAULT CHARSET utf8;

use `ruspravosl`;

GRANT ALL
ON `ruspravosl`.*
TO `smite`@localhost IDENTIFIED BY 'smite107';


CREATE TABLE IF NOT EXISTS `users` (
   `id`          INT          NOT NULL AUTO_INCREMENT,
   `login`       VARCHAR(45)  NOT NULL,
   `name`        VARCHAR(80)  NOT NULL,
   `surname`     VARCHAR(80)  NOT NULL,
   `age`         INT          NOT NULL,
   `address`     VARCHAR(100) NOT NULL,
   `school`      VARCHAR(80)  NOT NULL,
   `password`    CHAR(50)     NOT NULL,
   `salt`        VARCHAR(8)   NOT NULL,
   PRIMARY KEY(`id`),
   UNIQUE KEY(`login`)
);

CREATE TABLE IF NOT EXISTS `jury` (
   `id`    INT          NOT NULL AUTO_INCREMENT,
   `name`  VARCHAR(120) NOT NULL,
   `info`  TEXT,
   PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `main_news` (
   `id`        INT  NOT NULL AUTO_INCREMENT,
   `text_head` TEXT NOT NULL,
   `text_body` TEXT NOT NULL,
   PRIMARY KEY(`id`)
);

INSERT INTO `main_news`(`text_head`, `text_body`) VALUES
   ('Конкурс начался!', 'Конкурс предусматривает два этапа. В ноябре во всех военных округах пройдет первый отборочный тур. Второй тур и заключительный концерт лауреатов конкурса состоятся в Москве в сентябре будущего года. Для каждого военного оркестра обязательным является исполнение Государственного гимна России, а также ряда других произведений - "Славься" М. Глинки, "Развод караулов" В. Павлова, "Красная заря" С. Чернецкого, военных маршей и плац-концертов.');

CREATE TABLE IF NOT EXISTS `categories` (
   `id`        INT         NOT NULL AUTO_INCREMENT,
   `name`      VARCHAR(80) NOT NULL,
   `parent_id` INT,
   PRIMARY KEY(`id`),
   FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`)
);

CREATE TABLE IF NOT EXISTS `images` (
   `id`          INT(11) NOT NULL AUTO_INCREMENT,
   `user_id`     INT(11) NOT NULL,
   `category_id` INT     NOT NULL,
   `status`      INT(1)  NOT NULL DEFAULT 0,
   PRIMARY KEY (`id`),
   FOREIGN KEY (`user_id`)     REFERENCES `users`(`id`),
   FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`)
);

DROP TRIGGER IF EXISTS `insert_categories`;
DELIMITER //
CREATE TRIGGER `insert_categories` BEFORE INSERT ON `categories`
FOR EACH ROW BEGIN
   IF new.parent_id = -1 THEN
      SET new.parent_id = null;
   END IF;
END
//
DELIMITER ;

INSERT INTO `categories`(`id`, `name`, `parent_id`) VALUES
   (1, 'Художественное искусство', 1),
   (2, '8-12 лет', 1),
   (3, '13-18 лет', 1),
   (4, 'Декоративно-прикладное искусство', 4),
   (5, '8-12 лет', 4),
   (6, '13-18 лет', 4);

DROP TRIGGER IF EXISTS `insert_users`;

DELIMITER //

CREATE TRIGGER `insert_users` BEFORE INSERT ON `users`
FOR EACH ROW BEGIN
   SET new.password = create_encrypted_pass(new.password, new.salt);
END
//

DELIMITER $$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_cat`(IN cur_id INT)
BEGIN
   DECLARE pid INT;
   SELECT `parent_id` INTO pid FROM `categories` WHERE `id` = cur_id;
   IF (pid is NULL) THEN
      UPDATE `categories` SET `parent_id` = cur_id WHERE `id` = cur_id;
   END IF;
END$$

CREATE DEFINER=`smite`@`localhost` FUNCTION `create_encrypted_pass`(pass CHAR(50), salt VARCHAR(8)) RETURNS char(50) CHARSET utf8
BEGIN
   RETURN MD5(CONCAT(salt, MD5(CONCAT(pass, salt)), SUBSTR(salt, 2)));
END$$

DELIMITER ;