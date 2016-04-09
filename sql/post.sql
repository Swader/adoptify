-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema adoptify
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema adoptify
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `adoptify` DEFAULT CHARACTER SET utf8mb4 ;
-- -----------------------------------------------------
-- Schema adoptify_gk
-- -----------------------------------------------------
USE `adoptify` ;

-- -----------------------------------------------------
-- Table `adoptify`.`post`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `adoptify`.`post` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(150) NOT NULL,
  `longitude` DECIMAL(9,6) NULL,
  `latitude` DECIMAL(8,6) NULL,
  `description` TEXT NULL,
  `user_id` INT NOT NULL,
  `images` TEXT NULL,
  `stage` TINYINT(1) NOT NULL DEFAULT 1,
  `created` DATETIME NULL,
  `updated` DATETIME NULL,
  `valid_until` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `userid_idx` (`user_id` ASC),
  CONSTRAINT `userid`
  FOREIGN KEY (`user_id`)
  REFERENCES `adoptify_gk`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
  ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
