-- create and select the database
DROP DATABASE IF EXISTS students_manager;
CREATE DATABASE students_manager;
USE students_manager;  -- MySQL command

-- create the tables
CREATE TABLE majors (
  majorID       INT(11)        NOT NULL   AUTO_INCREMENT,
  majorName     VARCHAR(255)   NOT NULL,
  PRIMARY KEY (majorID)
);

CREATE TABLE students (
  studentID        INT(11)        NOT NULL   AUTO_INCREMENT,
  majorID          INT(11)        NOT NULL,
  studentCode      VARCHAR(10)    NOT NULL   UNIQUE,
  studentName      VARCHAR(255)   NOT NULL,
  birthDay         INT (4),
  PRIMARY KEY (studentID),
  FOREIGN KEY (majorID) REFERENCES majors(majorID)
);

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- insert data into the database
INSERT INTO majors VALUES
(1, 'Computer Engineering'),
(2, 'Computer Science'),
(3, 'Software Engineering');

INSERT INTO students VALUES
(1, 1, 'CE001', 'Nguyễn Trung Được', '1996'),
(2, 1, 'CE002', 'Lê Trung Tín', '1986'),
(3, 1, 'CE003', 'Nguyễn Nhật Hưng', '1985'),
(4, 1, 'CE004', 'Nguyễn Hoàng Nhật', '2002'),
(5, 1, 'CE005', 'Trần Minh Quân', '2000'),
(6, 1, 'CE006', 'Nguyễn Viết Hoàng', '2002'),
(7, 2, 'CS001', 'Trần Duy Thư', '2001'),
(8, 2, 'CS002', 'Lê Anh Quân', '1996'),
(9, 3, 'SE001', 'Mạch Mãnh Cường', '2000'),
(10, 3, 'SE002', 'Nguyễn Thái Bình', '1997');

-- create the users and grant priveleges to those users

CREATE USER 'mgs_use'@'localhost' IDENTIFIED BY 'pa55word';
GRANT SELECT, INSERT, DELETE, UPDATE
ON students_manager.*
TO mgs_use@localhost;

CREATE USER 'mgs_test'@'localhost' IDENTIFIED BY 'pa55word';
GRANT SELECT
ON students
TO mgs_test@localhost;
