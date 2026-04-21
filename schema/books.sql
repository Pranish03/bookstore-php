CREATE DATABASE IF NOT EXISTS bookstore_db;

USE bookstore_db;

CREATE TABLE IF NOT EXISTS books (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title           VARCHAR(255)    NOT NULL,
    author          VARCHAR(255)    NOT NULL,
    image           VARCHAR(255)    NOT NULL,
    discount        DECIMAL(5, 2)   DEFAULT 0.00 NOT NULL,
    price           DECIMAL(10, 2)  NOT NULL,
    description     TEXT,
    isbn            VARCHAR(20)     UNIQUE,
    published_on    DATE,
    published_by    VARCHAR(255),
    pages           SMALLINT UNSIGNED,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);