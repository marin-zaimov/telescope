SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `maui` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `maui` ;

-- -----------------------------------------------------
-- Table `maui`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `maui`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(255) NOT NULL ,
  `password` VARCHAR(255) NOT NULL ,
  `firstName` VARCHAR(255) NOT NULL ,
  `lastName` VARCHAR(255) NOT NULL ,
  `organization` VARCHAR(255) NULL ,
  `GMToffset` VARCHAR(5) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `maui`.`reservations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `maui`.`reservations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `userId` INT NOT NULL ,
  `startTime` TIMESTAMP NOT NULL ,
  `endTime` TIMESTAMP NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `userId` (`userId` ASC) ,
  CONSTRAINT `userId`
    FOREIGN KEY (`userId` )
    REFERENCES `maui`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `maui`.`media`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `maui`.`media` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `userId` INT NOT NULL ,
  `fileName` VARCHAR(255) NOT NULL ,
  `type` ENUM('IMAGE','VIDEO') NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `userId` (`userId` ASC) ,
  CONSTRAINT `userId`
    FOREIGN KEY (`userId` )
    REFERENCES `maui`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
