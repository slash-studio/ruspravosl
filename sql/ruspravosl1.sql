

DELIMITER //

CREATE TRIGGER `insert_contest` AFTER INSERT ON `contest`
FOR EACH ROW BEGIN
   DECLARE last_cat_id INT;
   SET last_cat_id = (SELECT id FROM categories ORDER BY id DESC LIMIT 1);
   IF ISNULL(last_cat_id) THEN
      SET last_cat_id = 1;
   END IF;
   INSERT INTO `categories`(`id`, `name`, `parent_id`, `path`, `contest_id`) VALUES
      (last_cat_id + 1, 'Художественное искусство', last_cat_id + 1, CONCAT(last_cat_id + 1, '.'), new.id),
      (last_cat_id + 2, 'Традиции православной культуры', last_cat_id + 1, CONCAT(last_cat_id + 2, '.', last_cat_id + 1, '.'), new.id),
      (last_cat_id + 3, 'Моя Родина', last_cat_id + 1, CONCAT(last_cat_id + 3, '.', last_cat_id + 1, '.'), new.id),
      (last_cat_id + 4, 'Декоративно-прикладное искусство', last_cat_id + 4, CONCAT(last_cat_id + 4, '.'), new.id),
      (last_cat_id + 5, 'Традиции православной культуры', last_cat_id + 5, CONCAT(last_cat_id + 5, '.', last_cat_id + 4, '.'), new.id);
END

DELIMITER //

CREATE TRIGGER `insert_categories` BEFORE INSERT ON `categories`
FOR EACH ROW BEGIN
   IF new.parent_id = -1 THEN
      SET new.parent_id = null;
   END IF;
END
//
DELIMITER ;

DROP TRIGGER IF EXISTS `insert_users`;

DELIMITER //

CREATE TRIGGER `insert_users` BEFORE INSERT ON `users`
FOR EACH ROW BEGIN
   SET new.password = create_encrypted_pass(new.password, new.salt);
END
//

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `do_update_cat_path`(IN cur_id INT, IN ppath VARCHAR(50))
BEGIN
   DECLARE done, id1 INT;
   DECLARE new_path VARCHAR(50);
   DECLARE cur1 CURSOR FOR SELECT `id` FROM `categories` WHERE `parent_id` = cur_id;
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 0;

   SET new_path = CONCAT(ppath, cur_id, '.');
   UPDATE `categories` SET `path` = new_path WHERE `id` = cur_id;
   SET done = 1;

   OPEN cur1;
   FETCH cur1 INTO id1;
   WHILE done = 1 DO
      IF id1 != cur_id THEN
         CALL do_update_cat_path(id1, new_path);
      END IF;
      FETCH cur1 INTO id1;
   END WHILE;

   CLOSE cur1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_cat_path`(IN cur_id INT)
BEGIN
   DECLARE pid INT;
   SET max_sp_recursion_depth=255;
   SELECT `parent_id` INTO pid FROM `categories` WHERE `id` = cur_id;
   IF (pid is NULL) THEN
      SET pid = cur_id;
      UPDATE `categories` SET `parent_id` = cur_id WHERE `id` = cur_id;
   END IF;
   IF (pid = cur_id) THEN
      CALL do_update_cat_path(cur_id, '');
   ELSE
      CALL do_update_cat_path(cur_id, (SElECT `path` FROM `categories` WHERE `id` = pid));
   END IF;
END$$


CREATE DEFINER=`smite`@`localhost` FUNCTION `create_encrypted_pass`(pass CHAR(50), salt VARCHAR(8)) RETURNS char(50) CHARSET utf8
BEGIN
   RETURN MD5(CONCAT(salt, MD5(CONCAT(pass, salt)), SUBSTR(salt, 2)));
END$$

DELIMITER ;