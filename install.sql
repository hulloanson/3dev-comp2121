DROP DATABASE IF EXISTS `snacks`;
CREATE DATABASE IF NOT EXISTS `snacks`;
USE `snacks`;

CREATE TABLE IF NOT EXISTS `user` (
  `id`       INT UNIQUE PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `password` VARCHAR(255)                          NOT NULL,
  `email`    VARCHAR(255)                          NOT NULL
)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `user_meta` (
  `user_id` INT                                                             NOT NULL,
  `key`     VARCHAR(50)                                                     NOT NULL,
  `value`   VARCHAR(255)                                                    NOT NULL,
  `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP                             NOT NULL,
  `updated` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,

  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `products` (
  `id`    INT PRIMARY KEY UNIQUE AUTO_INCREMENT NOT NULL,
  `name`  VARCHAR(255)    NOT NULL,
  `cost`  DECIMAL(18, 8)  NOT NULL,
  `price` DECIMAL(18, 8)  NOT NULL,
  `desc`  TEXT,
  `deleted` TINYINT default 0 not null
)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `user_id`    INT NOT NULL,
  `product_id` INT NOT NULL,
  `qty` INT NOT NULL,
  
  PRIMARY KEY (`user_id`, `product_id`),
  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)
  ENGINE = InnoDB;

