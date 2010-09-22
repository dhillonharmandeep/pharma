<?php
/*
 * Created on Sep 21, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class Blog extends Controller{
	// Constructor
	function Blog(){
		parent::Controller();	
	}

	function index(){
		$data['title'] = "My blog title";
		$data['heading'] = "My main heading!";
		$data['todo'] = array('Learn CI', 'Learn eclipse', 'Learn Google Maps API');
		
		$this->load->view('blog_view', $data);
	}
}
?>
