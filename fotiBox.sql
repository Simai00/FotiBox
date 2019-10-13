CREATE DATABASE fotiBox;

USE fotiBox;

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `path` varchar(100) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);