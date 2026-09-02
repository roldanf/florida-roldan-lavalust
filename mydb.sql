-- Part A - Create the Database
CREATE DATABASE mydb;
USE mydb;

-- Part B - Create the users Table
CREATE TABLE users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	firstname VARCHAR(100) NOT NULL,
	lastname VARCHAR(100) NOT NULL,
	email VARCHAR(150) NOT NULL,
	username VARCHAR(100) NOT NULL
);

-- Part C - Insert Sample Records
INSERT INTO users (firstname, lastname, email, username)
VALUES
('Juan', 'Dela Cruz', 'juan@example.com', 'juandelacruz'),
('Maria', 'Santos', 'maria@example.com', 'mariasantos'),
('Pedro', 'Garcia', 'pedro@example.com', 'pedrogarcia'),
('Ana', 'Reyes', 'ana@example.com', 'anareyes'),
('Jose', 'Mendoza', 'jose@example.com', 'josemendoza');

-- Verify
SELECT * FROM users;
