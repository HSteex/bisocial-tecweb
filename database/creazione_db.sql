-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema besocial
-- -----------------------------------------------------

CREATE SCHEMA IF NOT EXISTS `besocial` DEFAULT CHARACTER SET utf8 ;
USE `besocial` ;

-- -----------------------------------------------------
-- Table `besocial`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `besocial`.`user` (
                                                 `user_id` INT NOT NULL AUTO_INCREMENT,
                                                 `username` VARCHAR(100) NOT NULL,
                                                 `email` VARCHAR(100) NOT NULL,
                                                 `password` CHAR(128) NOT NULL,
                                                 `salt` CHAR(128) NOT NULL,
                                                 `nome` VARCHAR(45) NOT NULL,
                                                 `cognome` VARCHAR(45) NOT NULL,
                                                 `bio` VARCHAR(512),
                                                 `user_image` VARCHAR(100),
                                                 PRIMARY KEY (`user_id`))
    ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `besocial`.`login_attemps` (
                                                `user_id` INT NOT NULL,
                                                `time` VARCHAR(30) NOT NULL)
    ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `besocial`.`follower`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `besocial`.`follower` (
                                                 `follow_id` INT NOT NULL AUTO_INCREMENT,
                                                 `source_id` INT NOT NULL,
                                                 `target_id` INT NOT NULL,
                                                 PRIMARY KEY (`follow_id`),
                                                 INDEX `idx_follower_source` (`source_id` ASC),
                                                 CONSTRAINT `fk_follower_source`
                                                    FOREIGN KEY (`source_id`)
                                                    REFERENCES `besocial`.`user` (`user_id`)
                                                    ON DELETE NO ACTION
                                                    ON UPDATE NO ACTION)
    ENGINE = InnoDB;

ALTER TABLE `besocial`.`follower`
ADD INDEX `idx_follower_target` (`target_id` ASC);
ALTER TABLE `besocial`.`follower`
ADD CONSTRAINT `fk_follower_target`
        FOREIGN KEY (`target_id`)
            REFERENCES `besocial`.`user` (`user_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;

-- -----------------------------------------------------
-- Table `besocial`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `besocial`.`message` (
                                                     `message_id` INT NOT NULL AUTO_INCREMENT,
                                                     `source_id` INT NOT NULL,
                                                     `target_id` INT NOT NULL,
                                                     `message_body` TINYTEXT NOT NULL,
                                                     `created_at` DATETIME NOT NULL,
                                                     PRIMARY KEY (`message_id`),
                                                     INDEX `idx_message_source` (`source_id` ASC),
                                                     CONSTRAINT `fk_message_source`
                                                         FOREIGN KEY (`source_id`)
                                                             REFERENCES `besocial`.`user` (`user_id`)
                                                             ON DELETE NO ACTION
                                                             ON UPDATE NO ACTION)
    ENGINE = InnoDB;

ALTER TABLE `besocial`.`message`
    ADD INDEX `idx_message_target` (`target_id` ASC);
ALTER TABLE `besocial`.`message`
    ADD CONSTRAINT `fk_message_target`
        FOREIGN KEY (`target_id`)
            REFERENCES `besocial`.`user` (`user_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;

-- -----------------------------------------------------
-- Table `besocial`.`community`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `besocial`.`community` (
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
                                                            REFERENCES `besocial`.`user` (`user_id`)
                                                            ON DELETE NO ACTION
                                                            ON UPDATE NO ACTION)
    ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `besocial`.`member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `besocial`.`member` (
                                                 `member_id` INT NOT NULL AUTO_INCREMENT,
                                                 `community_id` INT NOT NULL,
                                                 `user_id` INT NOT NULL,
                                                 `role_id` SMALLINT NOT NULL,
                                                 PRIMARY KEY (`member_id`),
                                                 INDEX `idx_member_community` (`community_id` ASC),
                                                 CONSTRAINT `fk_member_community`
                                                     FOREIGN KEY (`community_id`)
                                                         REFERENCES `besocial`.`user` (`user_id`)
                                                         ON DELETE NO ACTION
                                                         ON UPDATE NO ACTION)
    ENGINE = InnoDB;

ALTER TABLE `besocial`.`member`
    ADD INDEX `idx_member_user` (`user_id` ASC);
ALTER TABLE `besocial`.`member`
    ADD CONSTRAINT `fk_member_user`
        FOREIGN KEY (`user_id`)
            REFERENCES `besocial`.`user` (`user_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;


-- -----------------------------------------------------
-- Table `besocial`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `besocial`.`post` (
                                                   `post_id` INT NOT NULL AUTO_INCREMENT,
                                                   `creator_id` INT NOT NULL,
                                                   `community_id` INT,
                                                   `description` TINYTEXT NOT NULL,
                                                   `created_at` DATE NOT NULL,
                                                   `post_image` VARCHAR(100),
                                                   PRIMARY KEY (`post_id`),
                                                   INDEX `idx_post_creator` (`creator_id` ASC),
                                                   CONSTRAINT `fk_post_creator`
                                                       FOREIGN KEY (`creator_id`)
                                                           REFERENCES `besocial`.`user` (`user_id`)
                                                           ON DELETE NO ACTION
                                                           ON UPDATE NO ACTION)
    ENGINE = InnoDB;

ALTER TABLE `besocial`.`post`
    ADD CONSTRAINT `fk_post_community`
        FOREIGN KEY (`community_id`)
            REFERENCES `besocial`.`community` (`community_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;


-- -----------------------------------------------------
-- Table `besocial`.`like`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `besocial`.`like` (
                                                 `like_id` INT NOT NULL AUTO_INCREMENT,
                                                 `post_id` INT NOT NULL,
                                                 `user_id` INT NOT NULL,
                                                 PRIMARY KEY (`like_id`),
                                                 INDEX `idx_like_post` (`post_id` ASC),
                                                 CONSTRAINT `fk_like_post`
                                                     FOREIGN KEY (`post_id`)
                                                         REFERENCES `besocial`.`post` (`post_id`)
                                                         ON DELETE NO ACTION
                                                         ON UPDATE NO ACTION)
    ENGINE = InnoDB;

ALTER TABLE `besocial`.`like`
    ADD INDEX `idx_like_user` (`user_id` ASC);
ALTER TABLE `besocial`.`like`
    ADD CONSTRAINT `fk_like_user`
        FOREIGN KEY (`user_id`)
            REFERENCES `besocial`.`user` (`user_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;


-- -----------------------------------------------------
-- Table `besocial`.`comment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `besocial`.`comment` (
                                                 `comment_id` INT NOT NULL AUTO_INCREMENT,
                                                 `post_id` INT NOT NULL,
                                                 `user_id` INT NOT NULL,
                                                 PRIMARY KEY (`comment_id`),
                                                 INDEX `idx_comment_post` (`post_id` ASC),
                                                 CONSTRAINT `fk_comment_post`
                                                     FOREIGN KEY (`post_id`)
                                                         REFERENCES `besocial`.`post` (`post_id`)
                                                         ON DELETE NO ACTION
                                                         ON UPDATE NO ACTION)
    ENGINE = InnoDB;

ALTER TABLE `besocial`.`comment`
    ADD INDEX `idx_comment_user` (`user_id` ASC);
ALTER TABLE `besocial`.`comment`
    ADD CONSTRAINT `fk_comment_user`
        FOREIGN KEY (`user_id`)
            REFERENCES `besocial`.`user` (`user_id`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
