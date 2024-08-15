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
    is_archived BOOLEAN DEFAULT 0,
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

CREATE TABLE seance (
    id INT AUTO_INCREMENT NOT NULL,
    sequence_id INT NOT NULL,
    numero INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    is_archived BOOLEAN DEFAULT 0,
    INDEX IDX_DF7DFD0E98FB19AE (sequence_id),
    PRIMARY KEY(id),
    CONSTRAINT FK_DF7DFD0E98FB19AE FOREIGN KEY (sequence_id) REFERENCES sequence (id) ON DELETE CASCADE
) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;

CREATE TABLE document (
    id INT AUTO_INCREMENT NOT NULL,
    seance_id INT NOT NULL,
    type VARCHAR(255) NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description VARCHAR(255) DEFAULT NULL,
    path VARCHAR(255) NOT NULL,
    is_archived BOOLEAN DEFAULT 0,
    INDEX IDX_D8698A76E3797A94 (seance_id),
    PRIMARY KEY(id),
    CONSTRAINT FK_D8698A76E3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id) ON DELETE CASCADE
) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;


-- Insert data into `sequence` table
INSERT INTO sequence (numero, titre, description, image) VALUES
(1, 'Introduction to Programming', 'Basic concepts of programming with practical examples.', 'intro_programming.jpg'),
(2, 'Advanced Programming', 'In-depth study of advanced programming concepts and techniques.', 'advanced_programming.jpg'),
(3, 'Database Management', 'Understanding database management systems and SQL queries.', 'db_management.jpg');

-- Insert data into `seance` table
INSERT INTO seance (sequence_id, numero, titre, description, is_archived) VALUES
(1, 1, 'Introduction to Variables', 'Learn about variables and data types.', 0),
(1, 1000, 'Projet', 'Projet de fin de séquence.', 0),
(1, 1001, 'Grammaire', 'Points grammaticaux de la séquence.', 0),
(1, 2, 'Control Structures', 'Understanding loops and conditional statements.', 0),
(2, 1, 'Object-Oriented Programming', 'Explore the principles of OOP and its applications.', 0),
(2, 1000, 'Projet', 'Projet de fin de séquence.', 0),
(2, 1001, 'Grammaire', 'Points grammaticaux de la séquence.', 0),
(3, 1, 'Database Basics', 'Introduction to databases and SQL.', 0),
(3, 1000, 'Projet', 'Projet de fin de séquence.', 0),
(3, 1001, 'Grammaire', 'Points grammaticaux de la séquence.', 0);

-- Insert data into `document` table
INSERT INTO document (seance_id, type, titre, description, path) VALUES
(1, 'Lecture Notes', 'Variables and Data Types', 'Notes on variables and different data types used in programming.', '/uploads/documents/66bcd3baf2792.jpg'),
(1, 'Exercise', 'Basic Variables Exercise', 'Practical exercises on using variables and data types.', '/uploads/documents/66a27b4b9355d.pdf'),
(2, 'Lecture Notes', 'Control Structures Overview', 'Detailed notes on loops and conditional statements.', '/uploads/documents/66bcd3baf2792.jpg'),
(2, 'Quiz', 'Control Structures Quiz', 'Quiz to test knowledge on control structures.', '/uploads/documents/66a27b4b9355d.pdf'),
(3, 'Lecture Notes', 'Introduction to Databases', 'Notes on the basics of database management and SQL.', 'https://www.youtube.com/watch?v=EvWPhHVijI8&t=1s'),
(3, 'Exercise', 'SQL Queries Practice', 'Exercises for practicing SQL queries and database operations.', 'https://www.youtube.com/watch?v=EvWPhHVijI8&t=1s');

CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, pseudo VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (pseudo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;
INSERT INTO `user` (`id`, `roles`, `password`, `pseudo`, `lastname`, `firstname`) VALUES
(1, '[\"ROLE_USER\", \"ROLE_ADMIN\"]', '$2y$13$6zRpLJmnjT9EJ7SZlQp48epBZrBoUwrIG/qd4/thOLm3iIm3hD8Ua', 'a_pierrepont', 'Pierrepont', 'Adrien');