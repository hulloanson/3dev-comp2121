drop database if exists `snacks`;
create database if not exists `snacks`;
use `snacks`;

create table if not exists `user` (
  `id` int unique primary key auto_increment not null,
  `password` varchar(255) not null,
  `email` varchar(255) not null
)ENGINE=InnoDB;

create table if not exists `user_meta` (
  `user_id` int not null,
  `key` varchar(50) not null,
  `value` varchar(255) not null,
  `created` timestamp default CURRENT_TIMESTAMP not null,
  `updated` timestamp default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP not null,
  
  foreign key (`user_id`) references `user` (`id`) on update cascade on delete cascade
)ENGINE=InnoDB;

create table if not exists `products` (
  `id` int primary key not null,
  `name` varchar(255) not null,
  `cost` decimal(18, 8) not null,
  `price` decimal(18, 8) not null,
  `desc` text
)ENGINE=InnoDB;

