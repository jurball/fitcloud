-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema sportmi
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sportmi
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sportmi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `sportmi` ;

-- -----------------------------------------------------
-- Table `sportmi`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportmi`.`users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(22) NOT NULL,
  `last` VARCHAR(22) NOT NULL,
  `telep` VARCHAR(19) NOT NULL,
  `email` VARCHAR(70) NOT NULL,
  `pass` VARCHAR(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `telep` (`telep` ASC) VISIBLE,
  UNIQUE INDEX `email` (`email` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sportmi`.`store`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportmi`.`store` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `product` VARCHAR(22) NOT NULL,
  `price` INT NOT NULL,
  `description` VARCHAR(2000) NOT NULL,
  `quantity` INT NOT NULL,
  `img` LONGBLOB NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `product` (`product` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 11
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sportmi`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportmi`.`orders` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `ind` INT NOT NULL,
  `city` VARCHAR(50) NOT NULL,
  `street` VARCHAR(100) NOT NULL,
  `log` VARCHAR(100) NOT NULL,
  `users_id` INT UNSIGNED NOT NULL,
  `store_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_orders_users_idx` (`users_id` ASC) VISIBLE,
  INDEX `fk_orders_store1_idx` (`store_id` ASC) VISIBLE,
  CONSTRAINT `fk_orders_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `sportmi`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_store1`
    FOREIGN KEY (`store_id`)
    REFERENCES `sportmi`.`store` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `sportmi`.`support`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportmi`.`support` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(24) NOT NULL,
  `tele` VARCHAR(22) NOT NULL,
  `mail` VARCHAR(70) NOT NULL,
  `message` VARCHAR(5000) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

USE `sportmi` ;

-- -----------------------------------------------------
-- Placeholder table for view `sportmi`.`view_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sportmi`.`view_users` (`id` INT, `name` INT, `last` INT);

-- -----------------------------------------------------
-- View `sportmi`.`view_users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sportmi`.`view_users`;
USE `sportmi`;
CREATE  OR REPLACE VIEW `view_users` AS SELECT id, name, last FROM `users`;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
