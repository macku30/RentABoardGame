-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `rentABook` DEFAULT CHARACTER SET utf8 ;
USE `rentABook`;

-- -----------------------------------------------------
-- Table ``rentABook`.`Lender`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rentABook`.`Lender` (
  `identifier` VARCHAR(20) NOT NULL,
  `name` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`identifier`))
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `rentABook`.`Warehouse`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rentABook`.`Warehouse` (
  `idWarehouse` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idWarehouse`))
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `rentABook`.`Game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rentABook`.`Game` (
  `idGame` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `identifier` VARCHAR(45) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `owner` VARCHAR(255) NOT NULL,
  `Warehouse_idWarehouse` INT(11) UNSIGNED NULL,
  PRIMARY KEY (`idGame`),
  INDEX `Game_FKIndex1` (`Warehouse_idWarehouse` ASC),
  CONSTRAINT `fk_{9BC18EA8-BA75-4652-8C55-21419DC75E59}`
    FOREIGN KEY (`Warehouse_idWarehouse`)
    REFERENCES `rentABook`.`Warehouse` (`idWarehouse`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `rentABook`.`Event`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rentABook`.`Event` (
  `idEvent` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `startDate` DATE NOT NULL,
  `endDate` DATE NOT NULL,
  PRIMARY KEY (`idEvent`))
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `rentABook`.`Hire`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rentABook`.`Hire` (
  `idHire` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Game_idGame` INT(11) UNSIGNED NOT NULL,
  `Lender_identifier` VARCHAR(20) NOT NULL,
  `Event_idEvent` INT(11) UNSIGNED NOT NULL,
  `weight` VARCHAR(20) NOT NULL,
  `hireStart` DATETIME NOT NULL,
  `hireEnd` DATETIME NULL,
  PRIMARY KEY (`idHire`),
  INDEX `Hire_FKIndex1` (`Lender_identifier` ASC),
  INDEX `Hire_FKIndex2` (`Game_idGame` ASC),
  INDEX `Hire_FKIndex3` (`Event_idEvent` ASC),
  CONSTRAINT `fk_{9DF3028C-EE10-48DC-8009-B08ABC82695F}`
    FOREIGN KEY (`Lender_identifier`)
    REFERENCES `rentABook`.`Lender` (`identifier`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{FF717C9F-A30C-483C-A0A3-38CD43FC9F1B}`
    FOREIGN KEY (`Game_idGame`)
    REFERENCES `rentABook`.`Game` (`idGame`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{5D467488-0079-45C4-8B08-7A3BE56BF2AD}`
    FOREIGN KEY (`Event_idEvent`)
    REFERENCES `rentABook`.`Event` (`idEvent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `rentABook`.`GamesAvailableForEvent`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rentABook`.`GamesAvailableForEvent` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Game_idGame` INT(11) UNSIGNED NOT NULL,
  `Event_idEvent` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `GamesAvailableForEvent_FKIndex1` (`Event_idEvent` ASC),
  INDEX `GamesAvailableForEvent_FKIndex2` (`Game_idGame` ASC),
  CONSTRAINT `fk_{D25E97CA-C0DB-4301-B476-23BC66310DA7}`
    FOREIGN KEY (`Event_idEvent`)
    REFERENCES `rentABook`.`Event` (`idEvent`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_{89432B4C-2D70-425A-836A-4FE95A350A46}`
    FOREIGN KEY (`Game_idGame`)
    REFERENCES `rentABook`.`Game` (`idGame`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


-- -----------------------------------------------------
-- Table `rentABook`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rentABook`.`User` (
  `idUser` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `password_2` VARCHAR(45) NOT NULL,
  `canLend` TINYINT(1) NULL,
  `canAddGames` TINYINT(1) NULL,
  `canAddEvents` TINYINT(1) NULL,
  `canManageGames` TINYINT(1) NULL,
  `canManageLenders` TINYINT(1) NULL,
  `canManageUsers` TINYINT(1) NULL,
  PRIMARY KEY (`idUser`))
PACK_KEYS = 0
ROW_FORMAT = DEFAULT;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
