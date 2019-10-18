CREATE DATABASE fotiBox;

USE fotiBox;

CREATE TABLE `image`
(
    `id`        int(11)      NOT NULL AUTO_INCREMENT,
    `path`      varchar(100) NOT NULL,
    `createdAt` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `filter`    BOOLEAN      NOT NULL,
    PRIMARY KEY (id)
);
