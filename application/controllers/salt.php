<?php
/** 
 * chainbg.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
class Salt extends Controller {
	function Salt(){
		parent::Controller();
		
		// Set the security of this page
		if (!$this->user->Secure(array('type' => 'Admin')))
		{
			$this->session->set_flashdata('flashError', 'You must be logged in as admin to access this page');
			redirect('login');	
		}

		// Load the the chainbg model - autloaded
    	$this->load->model('m_salts');
		// CR 29JUL2011: Tags functionality
		$this->load->model('tags');
		// CR 29JUL2011: End
		
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
		// try to find a salt for the given name
		$salt = $this->m_salts->ReadSalts(array('name' => $this->input->post('name')));
		
		// If a chain/bg already exists, we do not allow another one to be created
		if($salt){
			// Set the error message and fail
			$this->form_validation->set_message('_check_name', "A salt with the name '".$this->input->post('name')."' already exists.");
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
		if(!$edit)
			$this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]|callback__check_name');

		// CR 29JUL2011: Tags functionality 
		$this->form_validation->set_rules('tags', 'tags', 'trim|normaliseTags');
		// CR 29JUL2011: End 
	}
	
	// CRUD methods
	/**
	 * Function to create new salt
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
			$saltId = $this->m_salts->CreateSalt($_POST);
			
			// Check for success
			if ($saltId)
			{
				$this->session->set_flashdata('flashConfirm', "A new salt with Id($saltId) has been created");
				// CR 29JUL2011: Tags functionality
				// Also update the tag information
				$this->tags->updateFrequency('',$_POST['tags']);
				// CR 29JUL2011: End
			}
			else
			{
				$this->session->set_flashdata('flashError', "Error: Salt could not be created because of DB error. Please contact your administrator");
			}
			
			// Redirect to user index
			redirect('salt/index');
		}
		$data['title'] = "Add Salt";
		$data['heading'] = "Add Salt";
		
		// Load the view
		$this->load->view('dashboard/salt/add', $data);
	}
	
	/**
	 * Function to retrieve all salts
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
		$pag_config['base_url'] = base_url(). 'salt/index/'; 
		$pag_config['total_rows'] =  $this->m_salts->ReadSalts(array('count' => true));
		$pag_config['per_page'] = $per_page; 
		$pag_config['uri_segment'] = 3; 
		
		// Get all users (not deleted)
		$data['salts'] = $this->m_salts->ReadSalts(array('limit' => $per_page, 'offset' => $offset, 'sortBy' => 'name', 'sortDirection' => 'ASC'));
    $data['tot_count'] = $pag_config['total_rows']; 
		
		// Initialise the pagination
		$this->pagination->initialize($pag_config);
		
		// create the links
		$data['pagination'] = $this->pagination->create_links(); 
		
		// Set the page data
		$data['title'] = "All Salts";
		$data['heading'] = "All Salts";
		
		// Load the view with this data
		$this->load->view('dashboard/salt/index', $data);
	}
	
	/**
	 * Function to edit the details of the specified salt
	 * 
	 * @param $id: The id of the salt to update
	 * Nov 29, 2010
	 */
	function edit($id)
	{
		// Get the data for this user
		$data['salt'] = $this->m_salts->ReadSalts(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['salt'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This salt does not exist');
			redirect('salt/index');
		}
		
		// CR 29JUL2011: Tags functionality
		// Find the old tags and set it
		$oldTags = $data['salt']->tags;
		// CR 29JUL2011: End

		// Set the validations 
		$this->_form_validations(true);

		// Run the validations
		if($this->form_validation->run())
		{
			// Validations successful - update database
			$_POST['id'] = $id;

			// Check for success
			if ($this->m_salts->UpdateSalts($_POST))
			{
				$this->session->set_flashdata('flashConfirm', 'Salt has been updated');
				// CR 29JUL2011: Tags functionality
				// Also update the tag information
				$this->tags->updateFrequency($oldTags,$_POST['tags']);
				// CR 29JUL2011: End
			}
			else
			{
				$this->session->set_flashdata('flashWarning', 'Database not updated! This is possible because no changes were made before saving.');
			}
			
			// Redirect to user index
			redirect('salt/edit/'.$id);
		}
		
		$data['title'] = "Edit Salt";
		$data['heading'] = "Edit Salt";
		
		// Load the view
		$this->load->view('dashboard/salt/edit', $data);
	}
		
	/**
	 * Deletes the salt specified
	 * 
	 * @param $id: the id of the salt to delete
	 * Nov 29, 2010
	 */
	function delete($id)
	{
		// Get the data for this user
		$data['salt'] = $this->m_salts->ReadSalts(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['salt'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This salt does not exist');
			redirect('salt/index');
		}
		
		// Delete the user
		$this->m_salts->DeleteSalt($id);
		
		// set the flashdata
		$this->session->set_flashdata('flashConfirm', "Salt ( id = $id ) has been deleted");
		// CR 29JUL2011: Tags functionality
		// Also update the tag information
		$this->tags->updateFrequency($data['salt']->tags, '');
		// CR 29JUL2011: End
	
		// Redirect to user index
		redirect('salt/index');
	}
   /**
   * Used for calling ajax queries
   * 
   * @param $id: the keyword of the store to search
   * Dec 15, 2010
   */
  function ajaxquery($keyword){
    //headers are sent to prevent browsers from caching
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT' ); 
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT'); 
    header('Cache-Control: no-cache, must-revalidate'); 
    header('Pragma: no-cache');
    header('Content-Type: text/xml');

    // send the results to the client
    $output = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
    $output .= '<response>';    

    // Check if type was specified
    $res = $this->m_salts->ajaxGetSalts(array('name' => $keyword));
    
    foreach ($res as $row) {
      $output .= '<name>'.$row->name.'</name>';
    }

//    $output .= '<name>name = '.$keyword.'</name>';
    $output .= '</response>';   
    
    // Print the output
    echo $output; 
  } 
}