CREATE DATABASE definitivo;

use definitivo;

CREATE TABLE users(
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    name varchar(255) not null,
    surname varchar(255) not null
);

create table post(
    id INTEGER primary key AUTO_INCREMENT,
    Autore INTEGER ,
    title VARCHAR(150),
    content TEXT,
    FOREIGN KEY (Autore) REFERENCES users(id)
);

