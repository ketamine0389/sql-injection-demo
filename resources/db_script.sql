DROP DATABASE IF EXISTS injectable;
CREATE DATABASE injectable;
USE injectable;

-- Create the passwords table
CREATE TABLE passwords (
  id INT AUTO_INCREMENT PRIMARY KEY,
  STR VARCHAR(128) NOT NULL,
  ENC VARCHAR(256) DEFAULT NULL
);

-- Create the users table
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  NAME VARCHAR(32) NOT NULL,
  P_ID INT NOT NULL,
  TOC DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (P_ID) REFERENCES passwords(id)
);

-- Create the posts table
CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  U_ID INT NOT NULL,
  STR VARCHAR(64) NOT NULL,
  TOC DATETIME NOT NULL,
  FOREIGN KEY (U_ID) REFERENCES users(id)
);

-- Populate the passwords table
INSERT INTO passwords (STR) 
SELECT CONCAT(
  SUBSTRING(MD5(RAND()), FLOOR(RAND() * 26) + 1, 5),
  FLOOR(100 + RAND() * 899),
  SUBSTRING(MD5(RAND()), FLOOR(RAND() * 26) + 1, 5),
  '%',
  FLOOR(100 + RAND() * 899)
)
FROM (
  SELECT 1 UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION
  SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION
  SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12 UNION
  SELECT 13 UNION SELECT 14 UNION SELECT 15 UNION SELECT 16
) AS dummy;

-- Populate the users table
INSERT INTO users (NAME, P_ID)
SELECT CONCAT('JohnDoe', id) AS NAME, id AS P_ID
FROM (
  SELECT 1 AS id UNION SELECT 2 UNION SELECT 3 UNION SELECT 4 UNION
  SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8 UNION
  SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12 UNION
  SELECT 13 UNION SELECT 14 UNION SELECT 15 UNION SELECT 16
) AS dummy;

-- Populate the posts table with random gibberish
INSERT INTO posts (U_ID, STR, TOC)
SELECT U_ID, CONCAT('Post text', id) AS STR, CURRENT_TIMESTAMP
FROM (
  SELECT 
    u.id AS U_ID,
    SUBSTRING(MD5(RAND()), FLOOR(RAND() * 26) + 1, 5) AS random_gibberish
  FROM users AS u
) AS posts_data
JOIN users AS u ON posts_data.U_ID = u.id;