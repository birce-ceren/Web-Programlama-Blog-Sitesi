CREATE TABLE users
(
    id       int PRIMARY KEY AUTO_INCREMENT,
    name     varchar(255),
    surname  varchar(255),
    password varchar(255),
    username varchar(255)
);

CREATE TABLE blogs
(
    id                int PRIMARY KEY AUTO_INCREMENT,
    owner             int,
    title             varchar(255),
    article           longtext,
    creation_time     DATETIME DEFAULT CURRENT_TIMESTAMP,
    modification_time DATETIME ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (owner) REFERENCES users(id)
);
