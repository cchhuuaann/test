

DROP TABLE IF EXISTS `vazby`.`swords`;
DROP TABLE IF EXISTS `vazby`.`swords_users`;
DROP TABLE IF EXISTS `vazby`.`users`;


CREATE TABLE `vazby`.`swords` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`name` varchar(25) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,	PRIMARY KEY  (`id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_czech_ci,
	ENGINE=InnoDB;

CREATE TABLE `vazby`.`swords_users` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`sword_id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,	PRIMARY KEY  (`id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_czech_ci,
	ENGINE=InnoDB;

CREATE TABLE `vazby`.`users` (
	`id` int(10) NOT NULL AUTO_INCREMENT,
	`name` varchar(25) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,	PRIMARY KEY  (`id`)) 	DEFAULT CHARSET=utf8,
	COLLATE=utf8_czech_ci,
	ENGINE=InnoDB;

