<?php
// load configuration file
require_once('error_handler.php');
require_once('mysql.class.php');
// we instantiate the whiteboard class
$my = new MySql();
$my->getNames();
?>
