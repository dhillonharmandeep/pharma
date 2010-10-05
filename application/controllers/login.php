<?php
/** 
 * login.php
 * Description	: The login cotroller
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 6, 2010
 */
class login extends Controller {
	public function __construct() {
		parent::Controller();
	}

	public function index() {
		$this->load->view('admin/login_form');
	}

	public function submit() {

		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		}

		redirect('dashboard');
	}

	private function _submit_validate() {
		// username validation
		$this->form_validation->set_rules('username', 'Username', 'trim|required|callback_authenticate');
		
		// password validation
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		// Set the error messege
		$this->form_validation->set_message('authenticate', 'Invalid login. Please try again.');
		
		// Run and return results
		return $this->form_validation->run();
	}
	
	public function authenticate(){
		// use the current_user class for validation
		return Current_User::login($this->input->post('username'), $this->input->post('password'));
	}
}