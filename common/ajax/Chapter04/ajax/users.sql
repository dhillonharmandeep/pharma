CREATE TABLE users
(
 user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 user_name VARCHAR(32) NOT NULL, 
 PRIMARY KEY (user_id)
);

INSERT INTO users (user_name) VALUES ('bogdan');
INSERT INTO users (user_name) VALUES ('filip');
INSERT INTO users (user_name) VALUES ('mihai');
INSERT INTO users (user_name) VALUES ('emilian');
INSERT INTO users (user_name) VALUES ('paula');
INSERT INTO users (user_name) VALUES ('cristian');
