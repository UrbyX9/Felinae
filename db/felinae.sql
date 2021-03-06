-- MySQL Script generated by MySQL Workbench
-- Tue Sep 15 09:57:02 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema felinae
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `felinae` ;

-- -----------------------------------------------------
-- Schema felinae
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `felinae` DEFAULT CHARACTER SET utf8 ;
USE `felinae` ;

-- -----------------------------------------------------
-- Table `felinae`.`brand`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`brand` ;

CREATE TABLE IF NOT EXISTS `felinae`.`brand` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'The field that saves ID of brand.',
  `title` VARCHAR(120) NOT NULL COMMENT 'The field that save the tittle of brand.',
  `image` TEXT NOT NULL COMMENT 'The field that save the path to image of brand.',
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'The date and time at which the brand was created.',
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() COMMENT 'The date and time at which the field was updated.',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `title_UNIQUE` (`title` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `felinae`.`product`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`product` ;

CREATE TABLE IF NOT EXISTS `felinae`.`product` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'product ID',
  `title` VARCHAR(150) NOT NULL COMMENT 'Product name/tittle to be displayed on page.',
  `metaTitle` VARCHAR(150) NULL COMMENT 'To be used for browser tittle and SEO.',
  `slug` VARCHAR(200) NOT NULL COMMENT 'The SLUG to form URL.',
  `summary` TINYTEXT NULL COMMENT 'The summary to mention key highlights.',
  `sku` SMALLINT(6) NOT NULL COMMENT 'The Stock Keeping Unit to track the prodact inventory.',
  `price` FLOAT NOT NULL DEFAULT 0 COMMENT 'The price of product.',
  `discount` FLOAT NULL DEFAULT 0 COMMENT 'The discount on product.',
  `quantity` SMALLINT(6) NOT NULL DEFAULT 0 COMMENT 'The available quantity of the product.',
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'The date and time at which the  product is created.',
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() COMMENT 'The date and time at which the product is updated.',
  `publishedAt` DATETIME NULL COMMENT 'The date and time at which the product is published on the site.',
  `startsAt` DATETIME NULL COMMENT 'The date and time at which the product sale starts.',
  `endsAt` DATETIME NULL COMMENT 'The date and time at which the product sale ends.',
  `content` TEXT NULL COMMENT 'Additional product information.',
  `weight` FLOAT NULL COMMENT 'The field contains the weight of the product (optional).',
  `length` FLOAT NULL COMMENT 'The field contains the lenght of the product (optional).',
  `width` FLOAT NULL COMMENT 'The field contains the width of the product (optional).',
  `depth` FLOAT NULL COMMENT 'The field contains the depth of the product (optional).',
  `brand_id` INT NULL COMMENT 'Field that containes the fk ID.',
  PRIMARY KEY (`id`),
  INDEX `fk_product_brand1_idx` (`brand_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_product_brand1`
    FOREIGN KEY (`brand_id`)
    REFERENCES `felinae`.`brand` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `felinae`.`product_image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`product_image` ;

CREATE TABLE IF NOT EXISTS `felinae`.`product_image` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'The ID of product image.',
  `image` TEXT NOT NULL COMMENT 'Fild that saves the image path.',
  `caption` VARCHAR(120) NULL DEFAULT 'image' COMMENT 'Image that save the image name (optional).',
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'The date and time at which the product image was created.',
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() COMMENT 'The date and time at which the product image was updated.',
  `product_id` INT NOT NULL COMMENT 'Field that saves the ID of parent product.',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `image_UNIQUE` (`image` ASC),
  INDEX `fk_product_image_product_idx` (`product_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_product_image_product`
    FOREIGN KEY (`product_id`)
    REFERENCES `felinae`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `felinae`.`category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`category` ;

CREATE TABLE IF NOT EXISTS `felinae`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Category field ID.',
  `category` VARCHAR(75) NOT NULL COMMENT 'The name of the catagory.',
  `metaTitle` VARCHAR(100) NULL COMMENT 'To be used for browser tittle and SEO.',
  `slug` VARCHAR(100) NOT NULL COMMENT 'The SLUG to form URL.',
  `parent_id` INT NULL COMMENT 'The field that contains the parent ID',
  PRIMARY KEY (`id`),
  INDEX `fk_category_category1_idx` (`parent_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_category_category1`
    FOREIGN KEY (`parent_id`)
    REFERENCES `felinae`.`category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `felinae`.`product_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`product_category` ;

CREATE TABLE IF NOT EXISTS `felinae`.`product_category` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'The ID of connecting field from product.',
  `category_id` INT NOT NULL COMMENT 'The connecting field ',
  `product_id` INT NOT NULL COMMENT 'The ID of connecting field from product.',
  PRIMARY KEY (`id`),
  INDEX `fk_product_category_category1_idx` (`category_id` ASC),
  INDEX `fk_product_category_product1_idx` (`product_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_product_category_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `felinae`.`category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_product_category_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `felinae`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `felinae`.`country`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`country` ;

CREATE TABLE IF NOT EXISTS `felinae`.`country` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'The Id field.',
  `country` VARCHAR(55) NOT NULL COMMENT 'The field that contains the country name',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `country_UNIQUE` (`country` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `felinae`.`city`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`city` ;

CREATE TABLE IF NOT EXISTS `felinae`.`city` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'The ID field.',
  `postalCode` VARCHAR(13) NOT NULL COMMENT 'The postal code of the given city.',
  `city` VARCHAR(60) NOT NULL COMMENT 'The field that saves the city.',
  `country_id` INT NOT NULL COMMENT 'Field that contains the ID of the country in which the city is located.',
  PRIMARY KEY (`id`),
  INDEX `fk_city_country1_idx` (`country_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_city_country1`
    FOREIGN KEY (`country_id`)
    REFERENCES `felinae`.`country` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `felinae`.`account`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`account` ;

CREATE TABLE IF NOT EXISTS `felinae`.`account` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'The ID field.',
  `username` VARCHAR(60) NOT NULL COMMENT 'The field that contains the users unique username.',
  `password` TEXT NOT NULL COMMENT 'The field that contains the hashed password.',
  `firstName` VARCHAR(90) NOT NULL COMMENT 'The field that contains the users name.',
  `lastName` VARCHAR(90) NOT NULL COMMENT 'The field that contains the users surname.',
  `email` VARCHAR(150) NOT NULL COMMENT 'The field that contains the users email.',
  `phoneNumber` VARCHAR(12) NULL COMMENT 'Field that contains the users phone number if inputed.',
  `address` VARCHAR(100) NOT NULL COMMENT 'This field contains the users address',
  `admin` SMALLINT(6) NOT NULL DEFAULT 0 COMMENT 'The field that defines if a user is a Admin.',
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'The date and time at which the account is created.',
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() COMMENT 'The date and time at which the account is updated.',
  `lastLogin` DATETIME NULL COMMENT 'The date and time at which the user last loged in.',
  `city_id` INT NOT NULL COMMENT 'The connecting ID field from City.',
  `token` TEXT NOT NULL,
  `active` BIT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_account_city1_idx` (`city_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_account_city1`
    FOREIGN KEY (`city_id`)
    REFERENCES `felinae`.`city` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '	';


-- -----------------------------------------------------
-- Table `felinae`.`review`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`review` ;

CREATE TABLE IF NOT EXISTS `felinae`.`review` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'The ID for review.',
  `comment` TINYTEXT NOT NULL COMMENT 'The field that contains the comment for a product.',
  `rating` TINYINT NULL COMMENT 'A rating for a product from user review.',
  `product_id` INT NOT NULL COMMENT 'The ID connecting field from product.',
  `account_id` INT NOT NULL COMMENT 'The ID connecting field from account.',
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`),
  INDEX `fk_review_product1_idx` (`product_id` ASC),
  INDEX `fk_review_account1_idx` (`account_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_review_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `felinae`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_review_account1`
    FOREIGN KEY (`account_id`)
    REFERENCES `felinae`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `felinae`.`order`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`order` ;

CREATE TABLE IF NOT EXISTS `felinae`.`order` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'The unique ID to indentify the order.',
  `sessionID` VARCHAR(100) NOT NULL COMMENT 'The unique session id associated with the order.',
  `status` SMALLINT(6) NOT NULL COMMENT 'The status of the order. (New, Checkout, Paid, Failed, Shipped, Delivered, Returned, Complete).',
  `subTotal` FLOAT NOT NULL COMMENT 'The total price of items.',
  `total` FLOAT NOT NULL COMMENT 'The total paid by the buyer.',
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'The date and time at which the order was created.',
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() COMMENT 'The date and time at which the order was updated.',
  `account_id` INT NOT NULL COMMENT 'The account/user ID associated with the order.',
  PRIMARY KEY (`id`),
  INDEX `fk_order_account1_idx` (`account_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `sessionID_UNIQUE` (`sessionID` ASC),
  CONSTRAINT `fk_order_account1`
    FOREIGN KEY (`account_id`)
    REFERENCES `felinae`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `felinae`.`order_item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`order_item` ;

CREATE TABLE IF NOT EXISTS `felinae`.`order_item` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'The ID field.',
  `quantity` INT NOT NULL COMMENT 'The field that contains the quantity of an item.',
  `sum` FLOAT NOT NULL COMMENT 'The sum of the items.',
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'The date and time at which the item was added.',
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() COMMENT 'The date and time at which the order item was updated.',
  `product_id` INT NOT NULL COMMENT 'The field that contains the ID of relevent product.',
  `order_id` INT NOT NULL COMMENT 'The ID of order.',
  PRIMARY KEY (`id`),
  INDEX `fk_order_item_product1_idx` (`product_id` ASC),
  INDEX `fk_order_item_order1_idx` (`order_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_order_item_product1`
    FOREIGN KEY (`product_id`)
    REFERENCES `felinae`.`product` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_order_item_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `felinae`.`order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `felinae`.`transaction`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`transaction` ;

CREATE TABLE IF NOT EXISTS `felinae`.`transaction` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT 'The unique id to indetify transaction.',
  `code` TEXT NOT NULL COMMENT 'The paymant id provided by the paymant gateway.',
  `status` SMALLINT(6) NOT NULL DEFAULT 0 COMMENT 'The status of the order transactrion can be New, cancelled, Failed, Pending, Declined, Rejected and Success.',
  `type` SMALLINT(6) NOT NULL DEFAULT 0 COMMENT 'The type of order transaction. (Credit, debit).',
  `mode` SMALLINT(6) NOT NULL DEFAULT 0 COMMENT 'The mode of the order transaction can be Offline, Cash on Delivery, Cheque, Draft, Wired or Online.',
  `createdAt` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'The date and tima at which the transaction is created.',
  `updatedAt` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP() COMMENT 'The date and time at which the transaction is updated.',
  `account_id` INT NOT NULL COMMENT 'The ID to identefiy the user associated with the transaction.',
  `order_id` INT NOT NULL COMMENT 'The ID to identefiy the order associated with the transaction.',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  INDEX `fk_transaction_account1_idx` (`account_id` ASC),
  INDEX `fk_transaction_order1_idx` (`order_id` ASC),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  CONSTRAINT `fk_transaction_account1`
    FOREIGN KEY (`account_id`)
    REFERENCES `felinae`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaction_order1`
    FOREIGN KEY (`order_id`)
    REFERENCES `felinae`.`order` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `felinae`.`menu`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `felinae`.`menu` ;

CREATE TABLE IF NOT EXISTS `felinae`.`menu` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `menu` VARCHAR(100) NOT NULL,
  `url` VARCHAR(500) NOT NULL,
  `parent_id` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  INDEX `fk_menu_menu1_idx` (`parent_id` ASC),
  UNIQUE INDEX `url_UNIQUE` (`url` ASC),
  CONSTRAINT `fk_menu_menu1`
    FOREIGN KEY (`parent_id`)
    REFERENCES `felinae`.`menu` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
