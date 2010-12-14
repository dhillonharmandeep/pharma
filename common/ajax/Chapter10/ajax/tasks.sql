CREATE TABLE tasks (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  order_no INT UNSIGNED NOT NULL default '0',
  description VARCHAR(100) NOT NULL default '',
  PRIMARY KEY (id)
);
