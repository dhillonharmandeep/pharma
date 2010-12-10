<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();	
		// Load the user model - autoloaded
	}
	
	function index()
	{
		$this->load->view('main/index');
	}
	
	function login()
	{
		$this->form_validation->set_rules('username', 'username', 'trim|required|callback__check_login');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		
		if($this->form_validation->run())
		{
			// Success - Login and set sessions
			if($this->user->Login(array('username' => $this->input->post('username'), 'password' => $this->input->post('password'))))
				redirect('dashboard');
			else 
				redirect('admin/login');
		}
		
		$this->load->view('admin/login_form');		
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
	
	function signup()
	{
		// Set the validations
		$this->form_validation->set_rules('username', 'username', 'trim|required|min_length[5]|max_length[10]|callback__check_username');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|callback__check_email');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('passconf', 'confirm password', 'required|matches[password]');		
		$this->form_validation->set_rules('firstname', 'firstname', 'trim|max_length[20]');
		$this->form_validation->set_rules('lastname', 'lastname', 'trim|max_length[20]');

		// Run the validations
		if($this->form_validation->run())
		{
			// unsset the passconf and submit variable
			unset($_POST['passconf']);
			
			// Validations successful - insert into database
			$userId = $this->user->RegisterUser($_POST);
			
			// Check for success
			if ($userId)
			{
				// TODO: sessions not working
				//$this->session->flashdata('flashConfirm', "An email has been sent to '".$_POST['email']." with a verification link. Please click on the verification link in the email to complete your registration.");
				$data['flashConfirm'] = "An email has been sent to '".$_POST['email']." with a verification link. Please click on the verification link in the email to complete your registration.";
			}
			else
			{
				//$this->session->flashdata('flashError', "Error: User could not be created because of DB error");
				$data['flashError'] = "Error: User could not be created because of DB error";
			}
			
			// Redirect to user index
			redirect('admin/result');
		}
		
		// Load the view
		$this->load->view('admin/signup_form');		
	}
	
	function verify()
	{
		$username = $this->uri->segment(3);
		$vcode = $this->uri->segment(4);

		if ($this->user->VerifyUser($username, $vcode))
		{
			echo "<h1>Registeration Completed!!</h1>";
			echo "You can now proceed to ". anchor('login','login') . "</a>";
		}
		else{
			echo "<h1>Registeration Failure!!</h1>";
			echo "Your registeration is invalid.";
		}				
	}
	
	function result()
	{
		echo "<h1>Results:</h1>";
		//echo "<div class=\"flashError\">Error: ".$this->session->flashdata('flashError')."</div>";
		//echo "<div class=\"flashConfirm\">Suceess: ".$this->session->flashdata('flashConfirm')."</div>";
		echo "<p>An email has been sent to you for verification. Please click on the verification link within the email to activate your account</p>";
		echo "<p>You can now proceed to ". anchor('login','login') . "</a></p>";
	}
	
	function _check_login()
	{
		// Check if password is also set
		if($this->input->post('password')){
			$user = $this->user->GetUsers(array('username'=> $this->input->post('username'), 'password' => $this->input->post('password')));
			
			// if not found check username with email
			if(!$user)
			{
				$user = $this->user->GetUsers(array('email'=> $this->input->post('username'), 'password' => $this->input->post('password')));
			}
			
			// If still not found return false
			if(!$user) {
        $user = $this->user->GetUsers(array('username'=> $this->input->post('username')));
        if(!$user) $user = $this->user->GetUsers(array('email'=> $this->input->post('username')));
        
				// set appropriate msg
				if (!$user) $this->form_validation->set_message('_check_login', 'Your username is not registered with us. Click <a href="'.base_url().'signup">here to register</a>');
				else $this->form_validation->set_message('_check_login', 'Invalid user/pass combination');
				return false;	
			}
			
			// If there is a user that exists, check more details
			if($user->status == 'Inactive')
			{
				// check if the status is inactive
				$this->form_validation->set_message('_check_login', 'Your username has not yet been activated! Please check your email and activate your membership.');
				return false;	
			}

			// if still not found - invalid login
			if($user) return true;
		}
		
		$this->form_validation->set_message('_check_login', 'Your username/password combination is invalid');
		return false;
	}
	
	function _check_email()
	{
		// Check if a user already exists by this email
		$user = $this->user->GetUsers(array('email'=> $this->input->post('email')));
			
		if($user)
		{
			$this->form_validation->set_message('_check_email', 'This email already registered!');
			return false;
		} 
		return true;
	}

	function _check_username()
	{
		// Check if a user already exists by this email
		$user = $this->user->GetUsers(array('username'=> $this->input->post('username')));
			
		if($user)
		{
			$this->form_validation->set_message('_check_username', 'This username already exists!');
			return false;
		} 
		return true;
			}
}
	