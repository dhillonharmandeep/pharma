<?php
/** 
 * dashboard.php
 * Description	: The Admin Homepage after loging in
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 6, 2010
 */
class dashboard extends Controller {
	public function index(){
		$this->load->view('admin/index.php');
	}
}