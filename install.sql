DROP DATABASE IF EXISTS `snacks`;
CREATE DATABASE IF NOT EXISTS `snacks`;
USE `snacks`;

CREATE TABLE IF NOT EXISTS `user` (
  `id`       INT UNIQUE PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `password` VARCHAR(255)                          NOT NULL,
  `email`    VARCHAR(191) UNIQUE                   NOT NULL
)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `user_meta` (
  `id`      INT PRIMARY KEY AUTO_INCREMENT                                  NOT NULL,
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

CREATE TABLE IF NOT EXISTS `product` (
  `id`      INT PRIMARY KEY UNIQUE AUTO_INCREMENT NOT NULL,
  `code`    VARCHAR(20)                           NOT NULL,
  `name`    VARCHAR(255)                          NOT NULL,
  `cost`    DECIMAL(18, 8)                        NOT NULL,
  `price`   DECIMAL(18, 8)                        NOT NULL,
  `image`   VARCHAR(255),
  `desc`    TEXT,
  `deleted` TINYINT DEFAULT 0                     NOT NULL
)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `bundle` (
  `id`         INT PRIMARY KEY UNIQUE AUTO_INCREMENT NOT NULL,
  `price`      DECIMAL(18, 8)                        NOT NULL,
  `discounted` DECIMAL(18, 8)                        NOT NULL,
  `image`      VARCHAR(255),
  `deleted`    TINYINT DEFAULT 0                     NOT NULL
)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `bundle_item` (
  `id`         INT PRIMARY KEY UNIQUE AUTO_INCREMENT NOT NULL,
  `bundle_id`  INT                                   NOT NULL,
  `product_id` INT                                   NOT NULL,
  `qty`        INT                                   NOT NULL,

  FOREIGN KEY (`bundle_id`) REFERENCES `bundle` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `shopping_cart` (
  `id`         INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `user_id`    INT                            NOT NULL,
  `product_id` INT                            NOT NULL,
  `qty`        INT                            NOT NULL,

  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `wish_list` (
  `id`         INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `user_id`    INT                            NOT NULL,
  `product_id` INT                            NOT NULL,

  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)
  ENGINE = InnoDB;
