<?php
/** 
 * signup.php
 * Description	: Controller for signing up page
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 4, 2010
 */
class Signup extends Controller {
// Helper functions
	/**
	 * 
	 * The validation Helper function
	 * 
	 * Oct 5, 2010
	 */
	public function _submit_validate(){
		// validation rules - username
		$this->form_validation->set_rules('username', 'Username',
			'required|alpha_numeric|min_length[6]|max_length[12]|unique[User.username]');

		// validation rules - password
		$this->form_validation->set_rules('password', 'Password',
			'required|min_length[6]|max_length[12]');

		// validation rules - confirm password
		$this->form_validation->set_rules('passconf', 'Confirm Password',
			'required|matches[password]');
				
		// validation rules - email
		$this->form_validation->set_rules('email', 'E-mail',
			'required|valid_email|unique[User.email]');
		
		// Run and return the results
		return $this->form_validation->run();
	}
	
	// User functions
	public function __construct() {
		parent::Controller();
	}

	/**
	 * 
	 * Controller for the main signup page 
	 * 
	 * Oct 5, 2010
	 */
	public function index() {
		$this->load->view('admin/signup_form');
	}
	
	/**
	 * 
	 * Function for submitting the data
	 * 
	 * Oct 5, 2010
	 */
	public function submit(){
		// First validate the data
		if(!$this->_submit_validate()){
			// Invalid, return to the signup page
			$this->index();
			return;
		}

		// Sucess, insert data into the db table
		$u = new User();
		$u->username = $this->input->post('username');
		$u->password = $this->input->post('password');
		$u->email = $this->input->post('email');
		$u->save();

		
		$data['username'] = $this->input->post('username'); 
		
		// load the success page
		$this->load->view('admin/submit_success', $data);
	}
}
