<?php
/** 
 * my_model_helper.php
 * Description	: The helper utility functions written specially by me for use in the models
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * Checks for mandaory columns
 * @param $required - array :the names of required columns
 * @param $data - array : the actual data
 * @return true if all required variables exist
 */
if ( ! function_exists('_required'))
{

	function _required($required, $data)
	{
		foreach ($required as $field)
			if(!isset($data[$field])) return false;
			
		return true;
	}
}

/**
 * Sets the default value for the given column
 * @param $default associative array defining the column => default value
 * @param $option associative array containing the actual data.
 */
if ( ! function_exists('_default'))
{
	function _default($default, $option)
	{
		return array_merge($default, $option);
	}
}