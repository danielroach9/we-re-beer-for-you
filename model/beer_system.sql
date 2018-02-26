DROP TABLE IF EXISTS `user`;
CREATE TABLE user(
	`uuid` INT(11) NOT NULL AUTO_INCREMENT,
	`first_name` VARCHAR(30) NOT NULL,
	`last_name` VARCHAR(30) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`email` VARCHAR(40) NOT NULL UNIQUE,
	`role` INT(11) NOT NULL,
	PRIMARY KEY (`uuid`),
	key `fk_user_role` (`role`),
	CONSTRAINT `fk_user_role` FOREIGN KEY (`role`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO `user` VALUES (0,'System','Administrator','admin','admin@admin.com',1);

DROP TABLE IF EXISTS `role`;
CREATE TABLE role(
	`role_id` INT(11) NOT NULL AUTO_INCREMENT,
	`role` VARCHAR(30) NOT NULL,
	PRIMARY KEY (`role_id`)
);

INSERT INTO `role` VALUES (0,'Administrator');

DROP TABLE IF EXISTS `rating`;
CREATE TABLE rating(
	`purchase_id` INT(11) NOT NULL AUTO_INCREMENT,
	`beerID` VARCHAR(30) NOT NULL,
	`comments` TEXT,
	`rating` INT(1) NOT NULL,
	`location` VARCHAR(75),
	`uuid` INT(11) NOT NULL,
	PRIMARY KEY (`purchase_id`),
	key `fk_rating_user` (`uuid`),
	CONSTRAINT `fk_rating_user` FOREIGN KEY (`uuid`) REFERENCES `user` (`uuid`) ON DELETE CASCADE ON UPDATE CASCADE
);