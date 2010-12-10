<?php
/** 
 * dashboard.php
 * Description	: The Admin Homepage after loging in
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 6, 2010
 */
class Dashboard extends Controller {
	function Dashboard(){
		parent::Controller();
		
		// Load the the user model - autloaded
		
		// Set the security of this page
		if (!$this->user->Secure(array('type' => 'Admin')))
		{
			$this->session->set_flashdata('flashError', 'You must be logged in as admin to access this page');
			redirect('login');	
		}
	}
	public function index(){
		$data['title'] = "Admin Dashboard";
		$data['heading'] = "Welcome to Pharmaseek Admin Dashboard!";
		$this->load->view('dashboard/index.php', $data);
	}
}