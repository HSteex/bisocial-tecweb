-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bisocial
-- -----------------------------------------------------

CREATE SCHEMA IF NOT EXISTS `bisocial` DEFAULT CHARACTER SET utf8 ;
USE `bisocial` ;

-- -----------------------------------------------------
-- Table `bisocial`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bisocial`.`user` (
                                                 `user_id` INT NOT NULL AUTO_INCREMENT,
                                                 `username` VARCHAR(100) NOT NULL,
                                                 `email` VARCHAR(100) NOT NULL,
                                                 `password` CHAR(128) NOT NULL,
                                                 `salt` CHAR(128) NOT NULL,
                                                 `nome` VARCHAR(45),
                                                 `cognome` VARCHAR(45),
                                                 `bio` VARCHAR(512),
                                                 `user_image` VARCHAR(100),
                                                 PRIMARY KEY (`user_id`),
                                                 UNIQUE KEY `username` (`username`))
    ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `bisocial`.`login_attempts` (
                                                `user_id` INT NOT NULL,
                                                `time` VARCHAR(30) NOT NULL)
    ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `bisocial`.`follower`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bisocial`.`follower` (
                                                 `follow_id` INT NOT NULL AUTO_INCREMENT,
                                                 `source_id` INT NOT NULL,
                                                 `target_id` INT NOT NULL,
                                                 PRIMARY KEY (`follow_id`),
                                                 INDEX `idx_follower_source` (`source_id` ASC),
                                                 CONSTRAINT `fk_follower_source`
                                                    FOREIGN KEY (`source_id`)
                                                    REFERENCES `bisocial`.`user` (`user_id`)
                                                    ON DELETE NO ACTION
                                                    ON UPDATE NO ACTION)
    ENGINE = InnoDB;

ALTER TABLE `bisocial`.`follower`
ADD INDEX `idx_follower_target` (`target_id` ASC);
ALTER TABLE `bisocial`.`follower`
ADD CONSTRAINT `fk_follower_target`
        FOREIGN KEY (`target_id`)
            REFERENCES `bisocial`.`user` (`user_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;

-- -----------------------------------------------------
-- Table `bisocial`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bisocial`.`message` (
                                                     `message_id` INT NOT NULL AUTO_INCREMENT,
                                                     `source_id` INT NOT NULL,
                                                     `target_id` INT NOT NULL,
                                                     `message_body` TINYTEXT NOT NULL,
                                                     `created_at` DATETIME NOT NULL,
                                                     PRIMARY KEY (`message_id`),
                                                     INDEX `idx_message_source` (`source_id` ASC),
                                                     CONSTRAINT `fk_message_source`
                                                         FOREIGN KEY (`source_id`)
                                                             REFERENCES `bisocial`.`user` (`user_id`)
                                                             ON DELETE NO ACTION
                                                             ON UPDATE NO ACTION)
    ENGINE = InnoDB;

ALTER TABLE `bisocial`.`message`
    ADD INDEX `idx_message_target` (`target_id` ASC);
ALTER TABLE `bisocial`.`message`
    ADD CONSTRAINT `fk_message_target`
        FOREIGN KEY (`target_id`)
            REFERENCES `bisocial`.`user` (`user_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;

-- -----------------------------------------------------
-- Table `bisocial`.`community`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bisocial`.`community` (
                                                    `community_id` INT NOT NULL AUTO_INCREMENT,
                                                    `creator_id` INT NOT NULL,
                                                    `name` VARCHAR(100) NOT NULL,
                                                    `descrition` TINYTEXT NOT NULL,
                                                    `created_at` DATETIME NOT NULL,
                                                    `community_image` VARCHAR(100),
                                                    PRIMARY KEY (`community_id`),
                                                    INDEX `idx_community_creator` (`creator_id` ASC),
                                                    CONSTRAINT `fk_community_creator`
                                                        FOREIGN KEY (`creator_id`)
                                                            REFERENCES `bisocial`.`user` (`user_id`)
                                                            ON DELETE NO ACTION
                                                            ON UPDATE NO ACTION)
    ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `bisocial`.`member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bisocial`.`member` (
                                                 `member_id` INT NOT NULL AUTO_INCREMENT,
                                                 `community_id` INT NOT NULL,
                                                 `user_id` INT NOT NULL,
                                                 `role_id` SMALLINT NOT NULL,
                                                 PRIMARY KEY (`member_id`),
                                                 INDEX `idx_member_community` (`community_id` ASC),
                                                 CONSTRAINT `fk_member_community`
                                                     FOREIGN KEY (`community_id`)
                                                         REFERENCES `bisocial`.`user` (`user_id`)
                                                         ON DELETE NO ACTION
                                                         ON UPDATE NO ACTION)
    ENGINE = InnoDB;

ALTER TABLE `bisocial`.`member`
    ADD INDEX `idx_member_user` (`user_id` ASC);
ALTER TABLE `bisocial`.`member`
    ADD CONSTRAINT `fk_member_user`
        FOREIGN KEY (`user_id`)
            REFERENCES `bisocial`.`user` (`user_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;


-- -----------------------------------------------------
-- Table `bisocial`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bisocial`.`post` (
                                                   `post_id` INT NOT NULL AUTO_INCREMENT,
                                                   `creator_id` INT NOT NULL,
                                                   `description` TINYTEXT,
                                                   `created_at` DATE NOT NULL,
                                                   `post_image` VARCHAR(100),
                                                   PRIMARY KEY (`post_id`),
                                                   INDEX `idx_post_creator` (`creator_id` ASC),
                                                   CONSTRAINT `fk_post_creator`
                                                       FOREIGN KEY (`creator_id`)
                                                           REFERENCES `bisocial`.`user` (`user_id`)
                                                           ON DELETE NO ACTION
                                                           ON UPDATE NO ACTION)
    ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bisocial`.`like`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bisocial`.`like` (
                                                 `like_id` INT NOT NULL AUTO_INCREMENT,
                                                 `post_id` INT NOT NULL,
                                                 `user_id` INT NOT NULL,
                                                 PRIMARY KEY (`like_id`),
                                                 INDEX `idx_like_post` (`post_id` ASC),
                                                 CONSTRAINT `fk_like_post`
                                                     FOREIGN KEY (`post_id`)
                                                         REFERENCES `bisocial`.`post` (`post_id`)
                                                         ON DELETE NO ACTION
                                                         ON UPDATE NO ACTION)
    ENGINE = InnoDB;

ALTER TABLE `bisocial`.`like`
    ADD INDEX `idx_like_user` (`user_id` ASC);
ALTER TABLE `bisocial`.`like`
    ADD CONSTRAINT `fk_like_user`
        FOREIGN KEY (`user_id`)
            REFERENCES `bisocial`.`user` (`user_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;


-- -----------------------------------------------------
-- Table `bisocial`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bisocial`.`comment` (
                                                 `comment_id` INT NOT NULL AUTO_INCREMENT,
                                                 `post_id` INT NOT NULL,
                                                 `user_id` INT NOT NULL,
                                                 PRIMARY KEY (`comment_id`),
                                                 INDEX `idx_comment_post` (`post_id` ASC),
                                                 CONSTRAINT `fk_comment_post`
                                                     FOREIGN KEY (`post_id`)
                                                         REFERENCES `bisocial`.`post` (`post_id`)
                                                         ON DELETE NO ACTION
                                                         ON UPDATE NO ACTION)
    ENGINE = InnoDB;

ALTER TABLE `bisocial`.`comment`
    ADD INDEX `idx_comment_user` (`user_id` ASC);
ALTER TABLE `bisocial`.`comment`
    ADD CONSTRAINT `fk_comment_user`
        FOREIGN KEY (`user_id`)
            REFERENCES `bisocial`.`user` (`user_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
