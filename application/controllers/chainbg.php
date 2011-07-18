<?php
/** 
 * chainbg.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
class Chainbg extends Controller {
	function Chainbg(){
		parent::Controller();
		
		// Set the security of this page
		if (!$this->user->Secure(array('type' => 'Admin')))
		{
			$this->session->set_flashdata('flashError', 'You must be logged in as admin to access this page');
			redirect('login');	
		}

		// Load the the chainbg model - autloaded
    	$this->load->model('m_chainbgs');
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
	function _check_chainname()
	{
		if ($this->input->post('type')){
			// try to find a chain/bg for the given name and type
			$chainbg = $this->m_chainbgs->ReadChainbgs(array('name' => $this->input->post('name'), 
																	 'type' => $this->input->post('type')));
			if($this->input->post('type') == 'Chain') $chaintype = "chain";
			else $chaintype  = "banner group";
			
			// If a chain/bg already exists, we do not allow another one to be created
			if($chainbg){
				// Set the error message and fail
				$this->form_validation->set_message('_check_chainname', "A $chaintype with the name '".$this->input->post('name')."' already exists.");
				return false;
			}
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
			$this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]|callback__check_chainname');
		else 
			$this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]');
		
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		$this->form_validation->set_rules('street', 'street', 'trim|max_length[512]');
		$this->form_validation->set_rules('street2', 'street2', 'trim|max_length[512]');
		$this->form_validation->set_rules('suburb', 'suburb', 'trim|max_length[100]');
		$this->form_validation->set_rules('city', 'city', 'trim|max_length[512]');
		$this->form_validation->set_rules('postcode', 'postcode', 'trim|numeric|exact_length[4]');
		$this->form_validation->set_rules('state', 'state', 'trim');
		$this->form_validation->set_rules('website', 'website', 'trim|valid_url');
		$this->form_validation->set_rules('email1', 'email1', 'trim|valid_email');
		$this->form_validation->set_rules('email2', 'email2', 'trim|valid_email');
		$this->form_validation->set_rules('email3', 'email3', 'trim|valid_email');
		$this->form_validation->set_rules('tel1', 'tel1', 'trim|valid_phone');
		$this->form_validation->set_rules('tel2', 'tel2', 'trim|valid_phone');
		$this->form_validation->set_rules('tel3', 'tel3', 'trim|valid_phone');
		$this->form_validation->set_rules('fax1', 'fax1', 'trim|valid_fax');
		$this->form_validation->set_rules('fax2', 'fax2', 'trim|valid_fax');
		$this->form_validation->set_rules('fax3', 'fax3', 'trim|valid_fax');
		// CR 29JUL2011: Tags functionality 
		$this->form_validation->set_rules('tags', 'tags', 'trim|normaliseTags');
		// CR 29JUL2011: End 
	}
	
	// CRUD methods
	/**
	 * Function to create new chains/banner groups
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
			$chainbgId = $this->m_chainbgs->CreateChainbg($_POST);
			
			// Check for success
			if ($chainbgId)
			{
				$this->session->set_flashdata('flashConfirm', "A new chain/banner group with Id($chainbgId) has been created");
				// CR 29JUL2011: Tags functionality
				// Also update the tag information
				$this->tags->updateFrequency('',$_POST['tags']);
				// CR 29JUL2011: End
			}
			else
			{
				$this->session->set_flashdata('flashError', "Error: Warehouse chain could not be created because of DB error. Please contact your administrator");
			}
			
			// Redirect to user index
			redirect('chainbg/index');
		}
		$data['title'] = "Add Chain/Banner Group";
		$data['heading'] = "Add Chain/Banner Group";
		
		// Load the view
		$this->load->view('dashboard/chainbg/add', $data);
	}
	
	/**
	 * Function to retrieve all chains/banner groups
	 * 
	 * @param $offset: The offset for pagination
	 * @param $per_page: The number of recors to be shown per page (pagination)
	 * Nov 29, 2010
	 */
	function index($offset = 0, $per_page = 10)
	{
		// Laod the pagination
		$this->load->library('pagination');
		
		// Prepare the pagination config
		$pag_config['base_url'] = base_url(). 'chainbg/index/'; 
		$pag_config['total_rows'] =  $this->m_chainbgs->ReadChainbgs(array('count' => true));
		$pag_config['per_page'] = $per_page; 
		$pag_config['uri_segment'] = 3; 
		
		// Get all users (not deleted)
		$data['chainbgs'] = $this->m_chainbgs->ReadChainbgs(array('limit' => $per_page, 'offset' => $offset, 'sortBy' => 'name', 'sortDirection' => 'ASC'));
    $data['tot_count'] = $pag_config['total_rows']; 
		
		// Initialise the pagination
		$this->pagination->initialize($pag_config);
		
		// create the links
		$data['pagination'] = $this->pagination->create_links(); 
		
		// Set the page data
		$data['title'] = "All Chains/Banner Groups";
		$data['heading'] = "All Chains/Banner Groups";
		
		// Load the view with this data
		$this->load->view('dashboard/chainbg/index', $data);
	}

	/**
	 * Function to edit the details of the specified chain/banner group
	 * 
	 * @param $id: The id of the chain/bg to update
	 * Nov 29, 2010
	 */
	function edit($id)
	{
		// Get the data for this user
		$data['chainbg'] = $this->m_chainbgs->ReadChainbgs(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['chainbg'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This chain/banner group does not exist');
			redirect('chainbg/index');
		}

		// CR 29JUL2011: Tags functionality
		// Find the old tags and set it
		$oldTags = $data['chainbg']->tags;
		// CR 29JUL2011: End

		// BUG: the postcode by default is 0 which causes validation error on submit
		if($data['chainbg']->postcode ==  0) $data['chainbg']->postcode = ''; 		

		// TODO: Set the validations (argument true if both the chain name and state are not changed)
		$this->_form_validations(true);

		// Run the validations
		if($this->form_validation->run())
		{
			// Validations successful - update database
			$_POST['id'] = $id;

			// Check for success
			if ($this->m_chainbgs->UpdateChainbgs($_POST))
			{
				$this->session->set_flashdata('flashConfirm', 'Chain/Banner Group ( '.$_POST['name'].' ) has been updated');
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
			redirect('chainbg/edit/'.$id);
		}
		
		$data['title'] = "Edit Chain/Banner Group";
		$data['heading'] = "Edit Chain/Banner Group";
		
		// Load the view
		$this->load->view('dashboard/chainbg/edit', $data);
	}
	
	/**
	 * Shows the details of the chain/banner group
	 * 
	 * @param $id: The id of the chain/bg to show
	 */
	function view($id)
	{
		// Get the data for this user
		$data['chainbg'] = $this->m_chainbgs->ReadChainbgs(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['chainbg'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This chain\banner group does not exist');
			redirect('chainbg/index');
		}
		
		$data['title'] = "Chain/Banner Group Details";
		$data['heading'] = "Chain/Banner Group Details";
		
		// Load the view
		$this->load->view('dashboard/chainbg/view', $data);
	}	
	
	/**
	 * Deletes the chain/banner group specified
	 * 
	 * @param $id: the id of the chain/banner group to delete
	 * Nov 29, 2010
	 */
	function delete($id)
	{
		// Get the data for this user
		$data['chainbg'] = $this->m_chainbgs->ReadChainbgs(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['chainbg'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This chain/banner group does not exist');
			redirect('chainbg/index');
		}
		
		// Delete the user
		$this->m_chainbgs->DeleteChainbg($id);
		// CR 29JUL2011: Tags functionality
		// Also update the tag information
		$this->tags->updateFrequency($data['chainbg']->tags, '');
		// CR 29JUL2011: End
		
		// set the flashdata
		$this->session->set_flashdata('flashConfirm', "Chain/Banner Group ( id = $id ) has been deleted");
	
		// Redirect to user index
		redirect('chainbg/index');
	}

	 /**
   * Used for calling ajax queries
   * 
   * @param $id: the keyword of the store to search
   * Dec 15, 2010
   */
  function ajaxquery($keyword, $type = 'Both'){
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
    if($type == 'Both')
      $res = $this->m_chainbgs->ajaxGetChainbgs(array('name' => $keyword));
    else
      $res = $this->m_chainbgs->ajaxGetChainbgs(array('name' => $keyword, 'type' => $type));

    foreach ($res as $row) {
      $output .= '<name>'.$name=$row->name.'['.$row->type.'-'.$row->state.']</name>';
    }

//    $output .= '<name>name = '.$keyword.'</name>';
//    $output .= '<name>type = '.$type.'</name>';
    $output .= '</response>';   
    
    // Print the output
    echo $output; 
  }	
}