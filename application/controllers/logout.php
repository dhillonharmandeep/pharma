<?php
/** 
 * logout.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 6, 2010
 */

class Logout extends Controller {

	public function index() {

		$this->session->sess_destroy();
		$this->load->view('admin/logout');
	}

}