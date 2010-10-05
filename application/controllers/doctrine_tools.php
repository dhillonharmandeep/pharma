<?php
/** 
 * doctrine_tools.php
 * Description	: File to create database using doctrine
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 4, 2010
 */
class Doctrine_Tools extends Controller {

	function create_tables() {
		echo 'Reminder: Make sure the tables do not exist already.<br />
		<form action="" method="POST">
		<input type="submit" name="action" value="Create Tables"><br /><br />';

		if ($this->input->post('action')) {
			Doctrine::createTablesFromModels();
			echo "Done!";
		}
	}

}