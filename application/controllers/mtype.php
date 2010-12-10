<?php
/** 
 * chainbg.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
class Mtype extends Controller {
	function Mtype(){
		parent::Controller();
		
		// Set the security of this page
		if (!$this->user->Secure(array('type' => 'Admin')))
		{
			$this->session->set_flashdata('flashError', 'You must be logged in as admin to access this page');
			redirect('login');	
		}

		// Load the the chainbg model - autloaded
    $this->load->model('m_medicine_types');
	}

	// Helper methods
	/**
	 * Checks if the chain/bannergroup name entered is allowed using following checks:
	 * 		(name, type) should be unique
	 * 
	 * Nov 29, 2010
	 */
	function _check_name()
	{
		// try to find a mtype for the given name
		$mtype = $this->m_medicine_types->ReadMedicine_types(array('name' => $this->input->post('name')));
		
		// If a mtypes already exists, we do not allow another one to be created
		if($mtype){
			// Set the error message and fail
			$this->form_validation->set_message('_check_name', "A medicine type with the name '".$this->input->post('name')."' already exists.");
			return false;
		}
		
		// if we reached here, everything is ok
		return true;
	}
	
	/**
	 * Validates the input columns on insert/update
	 * 
	 * @param $edit : if it is edit mode or insert mode.
	 * Nov 29, 2010
	 */
	function _form_validations($edit = false)
	{
		// Set the validations
		$this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]|callback__check_name');
	}
	
	// CRUD methods
	/**
	 * Function to create new mtype
	 *
	 * Nov 29, 2010
	 */
	function add()
	{
		// Set the form validations
		$this->_form_validations();
		
		// Run the validations
		if($this->form_validation->run())
		{
			// Validations successful - insert into database
			$mtypeId = $this->m_medicine_types->CreateMedicine_type($_POST);
			
			// Check for success
			if ($mtypeId)
			{
				$this->session->set_flashdata('flashConfirm', "A new medicine type with Id($mtypeId) has been created");
			}
			else
			{
				$this->session->set_flashdata('flashError', "Error: Medicine type could not be created because of DB error. Please contact your administrator");
			}
			
			// Redirect to user index
			redirect('mtype/index');
		}
		$data['title'] = "Add Medicine type";
		$data['heading'] = "Add Medicine type";
		
		// Load the view
		$this->load->view('dashboard/mtype/add', $data);
	}
	
	/**
	 * Function to retrieve all medicine types
	 * 
	 * @param $offset: The offset for pagination
	 * @param $per_page: The number of records to be shown per page (pagination)
	 * Nov 29, 2010
	 */
	function index($offset = 0, $per_page = 10)
	{
		// Laod the pagination
		$this->load->library('pagination');
		
		// Prepare the pagination config
		$pag_config['base_url'] = base_url(). 'dashboard/mtype/index/'; 
		$pag_config['total_rows'] =  $this->m_medicine_types->ReadMedicine_types(array('count' => true));
		$pag_config['per_page'] = $per_page; 
		$pag_config['uri_segment'] = 3; 
		
		// Get all users (not deleted)
		$data['mtypes'] = $this->m_medicine_types->ReadMedicine_types(array('limit' => $per_page, 'offset' => $offset));
		
		// Initialise the pagination
		$this->pagination->initialize($pag_config);
		
		// create the links
		$data['pagination'] = $this->pagination->create_links(); 
		
		// Set the page data
		$data['title'] = "All Medicine types";
		$data['heading'] = "All Medicine types";
		
		// Load the view with this data
		$this->load->view('dashboard/mtype/index', $data);
	}
	
	/**
	 * Function to edit the details of the specified medicine type
	 * 
	 * @param $id: The id of the mtype to update
	 * Nov 29, 2010
	 */
	function edit($id)
	{
		// Get the data for this user
		$data['mtype'] = $this->m_medicine_types->ReadMedicine_types(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['mtype'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This medicine type does not exist');
			redirect('mtype/index');
		}
		
		// Set the validations 
		$this->_form_validations(true);

		// Run the validations
		if($this->form_validation->run())
		{
			// Validations successful - update database
			$_POST['id'] = $id;

			// Check for success
			if ($this->m_medicine_types->UpdateMedicine_types($_POST))
			{
				$this->session->set_flashdata('flashConfirm', 'Medicine type ( '.$_POST['name'].' ) has been updated');
			}
			else
			{
				$this->session->set_flashdata('flashWarning', 'Database not updated! This is possible because no changes were made before saving.');
			}
			
			// Redirect to user index
			redirect('mtype/edit/'.$id);
		}
		
		$data['title'] = "Edit Medicine type";
		$data['heading'] = "Edit Medicine type";
		
		// Load the view
		$this->load->view('dashboard/mtype/edit', $data);
	}
		
	/**
	 * Deletes the mtype specified
	 * 
	 * @param $id: the id of the mtype to delete
	 * Nov 29, 2010
	 */
	function delete($id)
	{
		// Get the data for this user
		$data['mtype'] = $this->m_medicine_types->ReadMedicine_types(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['mtype'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This medicine type does not exist');
			redirect('mtype/index');
		}
		
		// Delete the user
		$this->m_medicine_types->DeleteMedicine_type($id);
		
		// set the flashdata
		$this->session->set_flashdata('flashConfirm', "Medicine type ( id = $id ) has been deleted");
	
		// Redirect to user index
		redirect('mtype/index');
	}
}