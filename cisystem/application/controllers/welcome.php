<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('index');
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */