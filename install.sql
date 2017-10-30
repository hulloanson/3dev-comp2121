DROP DATABASE IF EXISTS `snacks`;
CREATE DATABASE IF NOT EXISTS `snacks`;
USE `snacks`;

CREATE TABLE IF NOT EXISTS `user` (
  `id`       INT UNIQUE PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `password` VARCHAR(255)                          NOT NULL,
  `email`    VARCHAR(191) UNIQUE                   NOT NULL
)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `session` (
  `id`      VARCHAR(128) UNIQUE PRIMARY KEY NOT NULL,
  `user_id` INT                             NOT NULL,
  `started` TIMESTAMP DEFAULT current_timestamp,

  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
  ON UPDATE CASCADE
  ON DELETE CASCADE

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

CREATE TABLE IF NOT EXISTS `product_tag` (
  `id`      INT PRIMARY KEY UNIQUE AUTO_INCREMENT NOT NULL,
  `product_id` int not null,
  `tag` VARCHAR(60) not null,
  FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
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

CREATE TABLE IF NOT EXISTS `sales` (
  `id`      INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `user_id` INT                            NOT NULL,
  `time`    TIMESTAMP DEFAULT current_timestamp,
  `total`   DECIMAL(18, 8)                 NOT NULL,
  `status`  INT                            NOT NULL, # not delivered - 1, delivered - 2, cancelled - 3

  FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)
  ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `sales_item` (
  `id`         INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `sales_id`   INT                            NOT NULL,
  `product_id` INT                            NOT NULL,
  `qty`        INT                            NOT NULL,

  FOREIGN KEY (`sales_id`) REFERENCES `sales` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE,
  FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
    ON UPDATE CASCADE
    ON DELETE CASCADE
)
  ENGINE = InnoDB;


