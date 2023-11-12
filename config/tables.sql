-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema dbs12191674
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbs12191674
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbs12191674` DEFAULT CHARACTER SET utf8 ;
USE `dbs12191674` ;

-- -----------------------------------------------------
-- Table `dbs12191674`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbs12191674`.`user` (
  `userID` INT NOT NULL,
  `fname` VARCHAR(45) NULL,
  `lname` VARCHAR(45) NULL,
  `username` VARCHAR(150) NULL,
  `password` VARCHAR(45) NULL,
  `email` VARCHAR(150) NULL,
  PRIMARY KEY (`userID`));
-- ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbs12191674`.`video`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbs12191674`.`video` (
  `videoID` INT NOT NULL,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(5000) NULL,
  `path` VARCHAR(150) NULL,
  `category` VARCHAR(45) NULL,
  PRIMARY KEY (`videoID`));
-- ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbs12191674`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbs12191674`.`comments` (
  `commentsID` INT NOT NULL,
  `commentText` VARCHAR(5000) NULL,
  `userID` INT NOT NULL,
  `videoID` INT NOT NULL,
  PRIMARY KEY (`commentsID`),
  INDEX `fk_comments_user_idx` (`userID` ASC) VISIBLE,
  INDEX `fk_comments_video1_idx` (`videoID` ASC) VISIBLE,
  CONSTRAINT `fk_comments_user`
    FOREIGN KEY (`userID`)
    REFERENCES `dbs12191674`.`user` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_video1`
    FOREIGN KEY (`videoID`)
    REFERENCES `dbs12191674`.`video` (`videoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
-- ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbs12191674`.`task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbs12191674`.`task` (
  `taskID` INT NOT NULL,
  `title` VARCHAR(45) NULL,
  `description` VARCHAR(2000) NULL,
  `complete` TINYINT NULL,
  `userID` INT NOT NULL,
  `videoID` INT NOT NULL,
  PRIMARY KEY (`taskID`),
  INDEX `fk_task_user1_idx` (`userID` ASC) VISIBLE,
  INDEX `fk_task_video1_idx` (`videoID` ASC) VISIBLE,
  CONSTRAINT `fk_task_user1`
    FOREIGN KEY (`userID`)
    REFERENCES `dbs12191674`.`user` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_task_video1`
    FOREIGN KEY (`videoID`)
    REFERENCES `dbs12191674`.`video` (`videoID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);
-- ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dbs12191674`.`timestamps`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbs12191674`.`timestamps` (
  `create_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` TIMESTAMP NULL,
  `taskID` INT NOT NULL,
  `commentsID` INT NOT NULL,
  `userID` INT NOT NULL,
  INDEX `fk_timestamps_task1_idx` (`taskID` ASC) VISIBLE,
  INDEX `fk_timestamps_comments1_idx` (`commentsID` ASC) VISIBLE,
  INDEX `fk_timestamps_user1_idx` (`userID` ASC) VISIBLE,
  CONSTRAINT `fk_timestamps_task1`
    FOREIGN KEY (`taskID`)
    REFERENCES `dbs12191674`.`task` (`taskID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_timestamps_comments1`
    FOREIGN KEY (`commentsID`)
    REFERENCES `dbs12191674`.`comments` (`commentsID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_timestamps_user1`
    FOREIGN KEY (`userID`)
    REFERENCES `dbs12191674`.`user` (`userID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
