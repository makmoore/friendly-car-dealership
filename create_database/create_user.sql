USE friendlycardealership;

CREATE USER 'user1'@'localhost' IDENTIFIED BY 'password123';
GRANT ALL PRIVILEGES ON friendlycardealership.* TO 'user1'@'localhost';
FLUSH PRIVILEGES;