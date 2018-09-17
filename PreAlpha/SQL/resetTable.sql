DROP TABLE book;

CREATE TABLE book (
book_id CHAR(10) PRIMARY KEY,
name VARCHAR(256) NOT NULL,
price FLOAT DEFAULT 0,
date_of_publication DATE NOT NULL
);

-- Date format is YYYY-MM-DD

DELETE FROM book; -- Delete any existing records

INSERT INTO book VALUES (1524267903, 'Fundamentals of Database Systems', 19.60, '1955-05-19');
INSERT INTO book VALUES (3745768546, 'The Pragmatic Programmer: From Journeyman to Master', 50, '1955-05-19'); -- Different Book Same Date
INSERT INTO book VALUES (6745845642, 'The Pragmatic Programmer: From Journeyman to Master', 25.90, '1955-05-19'); -- Same Book Different Price
INSERT INTO book VALUES (9744234657, 'Code Complete', 80.75, '1895-12-06');
INSERT INTO book VALUES (1557435754, 'Design Patterns: Elements of Reusable Object-Oriented Software', 80.75, '1964-01-11'); -- Same Price
INSERT INTO book VALUES (3465434768, 'The C Programming Language', 12.90, '2001-02-10');
INSERT INTO book VALUES (7424573686, 'JavaScript: The Good Parts', 11.50, '2010-08-19');
INSERT INTO book VALUES (2652527575, 'The Mythical Man-Month: Essays on Software Engineering', 22.60, '2003-09-18');
INSERT INTO book VALUES (5432462344, 'Structure and Interpretation of Computer Programs (MIT Electrical Engineering and Computer Science)', 100.80, '2011-07-15');
INSERT INTO book VALUES (6342341235, 'Head First Design Patterns', 77.20, '2003-01-18');