<?php
/** 
 * index.php
 * Description	: The homepage controller
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 4, 2010
 */
class home extends Controller {
	public function index(){
		$this->load->view('index');
	}
}