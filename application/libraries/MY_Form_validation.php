<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * My_Form_validation.php
 * Description	: Form Validation Library Extended to include doctrine validations.
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 4, 2010
 */
class MY_Form_validation extends CI_Form_validation {

	function unique($value, $params)
	{
		$CI =& get_instance();

		$CI->form_validation->set_message('unique', 
			'The %s is already being used.');

		list($model, $field) = explode(".", $params, 2);

		$find = "findOneBy".$field;
		
		if (Doctrine::getTable($model)->$find($value)) {
			return false;
		} else {
			return true;
		}

	}
}