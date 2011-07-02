<?php
/** 
 * scripts.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Jul 1, 2011
 */
class Scripts extends Controller {
	function Scripts(){
		parent::Controller();
		
		// Set the security of this page
		if (!$this->user->Secure(array('type' => 'Admin')))
		{
			$this->session->set_flashdata('flashError', 'You must be logged in as admin to access this page');
			redirect('login');	
		}
	}
	
	/**
	 * Function to list all the scripts
	 * 
	 * Jul 1, 2011
	 */
	function index()
	{
		// Set the page data
		$data['title'] = "All Scripts";
		$data['heading'] = "All Scripts";
		$data['scripts'] = array(
							'upload_medicine' => 'Upload Medicines',
							);
		
		// Load the view with this data
		$this->load->view('dashboard/scripts/index', $data);
	}
}