<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/** 
 * MY_Form_validation.php
 * Description	: Extension to the existing form validation library
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Dec 10, 2010
 */
class MY_Form_validation extends CI_Form_validation {
  /**
   * Validate URL
   *
   * @access    public
   * @param    string
   * @return    string
   */
  function valid_url($url)
  {
    $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";;
    if (!preg_match($pattern, $url))
    {
      return FALSE;
    }
    return TRUE;
  } 
  
  function valid_phone($str){
    return (bool)preg_match( '/^[\-+ ]?[0-9\- ]*$/', $str);
  }

  function valid_fax($str){
    return (bool)preg_match( '/^[\-+ ]?[0-9\- ]*$/', $str);
  }
}