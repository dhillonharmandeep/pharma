<?php

class Main extends Controller {

	function Main()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('main/index');
	}
	
	function login()
	{
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'trim|required');

		if($this->form_validation->run())
		{
			// Form has been successfully validated
		}
		$this->load->view('main/login.php');
	}
}

/* End of file main.php */
/* Location: ./system/application/controllers/main.php */