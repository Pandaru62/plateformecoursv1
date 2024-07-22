-- Create the database
CREATE DATABASE `plateformecours`;

-- Use the database
USE plateformecours;

-- Create tables
CREATE TABLE sequence (
    id INT AUTO_INCREMENT NOT NULL,
    numero INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    image VARCHAR(255) DEFAULT NULL,
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

CREATE TABLE seance (
    id INT AUTO_INCREMENT NOT NULL,
    sequence_id INT NOT NULL,
    numero INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    INDEX IDX_DF7DFD0E98FB19AE (sequence_id),
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

CREATE TABLE document (
    id INT AUTO_INCREMENT NOT NULL,
    seance_id INT NOT NULL,
    type VARCHAR(255) NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    INDEX IDX_D8698A76E3797A94 (seance_id),
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

-- Add foreign key constraints
ALTER TABLE document ADD CONSTRAINT FK_D8698A76E3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id);
ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0E98FB19AE FOREIGN KEY (sequence_id) REFERENCES sequence (id);

-- Insert data into `sequence` table
INSERT INTO sequence (numero, titre, description, image) VALUES
(1, 'Introduction to Programming', 'Basic concepts of programming with practical examples.', 'intro_programming.jpg'),
(2, 'Advanced Programming', 'In-depth study of advanced programming concepts and techniques.', 'advanced_programming.jpg'),
(3, 'Database Management', 'Understanding database management systems and SQL queries.', 'db_management.jpg');

-- Insert data into `seance` table
INSERT INTO seance (sequence_id, numero, titre, description) VALUES
(1, 1, 'Introduction to Variables', 'Learn about variables and data types.'),
(1, 2, 'Control Structures', 'Understanding loops and conditional statements.'),
(2, 1, 'Object-Oriented Programming', 'Explore the principles of OOP and its applications.'),
(3, 1, 'Database Basics', 'Introduction to databases and SQL.');

-- Insert data into `document` table
INSERT INTO document (seance_id, type, titre, description) VALUES
(1, 'Lecture Notes', 'Variables and Data Types', 'Notes on variables and different data types used in programming.'),
(1, 'Exercise', 'Basic Variables Exercise', 'Practical exercises on using variables and data types.'),
(2, 'Lecture Notes', 'Control Structures Overview', 'Detailed notes on loops and conditional statements.'),
(2, 'Quiz', 'Control Structures Quiz', 'Quiz to test knowledge on control structures.'),
(3, 'Lecture Notes', 'Introduction to Databases', 'Notes on the basics of database management and SQL.'),
(3, 'Exercise', 'SQL Queries Practice', 'Exercises for practicing SQL queries and database operations.');
