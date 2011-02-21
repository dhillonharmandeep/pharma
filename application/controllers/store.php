<?php
/** 
 * store.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Dec 15, 2010
 */
class Store extends Controller {
	function Store(){
		parent::Controller();
		
		// Set the security of this page
		if (!$this->user->Secure(array('type' => 'Admin')))
		{
			$this->session->set_flashdata('flashError', 'You must be logged in as admin to access this page');
			redirect('login');	
		}

		// Load the the store model - autloaded
    $this->load->model('m_stores');
	}

	// Helper methods
	/**
	 * Checks if the store name entered is allowed using following checks:
	 * 		(name, type) should be unique
	 * 
	 * Dec 15, 2010
	 */
	function _check_name()
	{// TODO: do proper name validations
		if ($this->input->post('type')){
			// try to find a chain/bg for the given name and type
			$store = $this->m_stores->ReadStores(array('name' => $this->input->post('name'), 
																	 'type' => $this->input->post('type')));
			if($this->input->post('type') == 'Chain') $chaintype = "chain";
			else $chaintype  = "banner group";
			
			// If a chain/bg already exists, we do not allow another one to be created
			if($store){
				// Set the error message and fail
				$this->form_validation->set_message('_check_chainname', "A $chaintype with the name '".$this->input->post('name')."' already exists.");
				return false;
			}
		}
		
		// if we reached here, everything is ok
		return true;
	}
	
	/**
	 * Given a name in the format "name[State]", this function finds a chainbg of this config.
	 * If found it returns the id of that chainbg. Else it creates a new entry in the table
	 * and returns the newly created record's id
	 * 
	 * @param $name: the name of the chainbg to search in the format of "name[State]"
	 * Dec 16, 2010
	 */
	function _findChainbgByName($name){		
    // Split the name and state
		$preg = preg_split("/[\[\]-]/", $name);
    
		$name = $preg[0];
		
		// Check if a state was found
		if (count($preg)>2){
      $type = $preg[1];
      $state = $preg[2];
		}
		else{
			// Find the state from the post data
			$state = $this->input->post('state');
	    // Find if the user is trying to create a chain or a banner group 
	    $type = $this->input->post('type');  
		}

//		echo "<script>alert('name = $name \\nstate = $state\\ntype = $type');</script>";
		// Check if we have all the data to proceed
		if ($type == '' || $state == ''){
			$chainbg_id = -1; 
		}
		else{
			// Load the chainbg model  
			$this->load->model("m_chainbgs");

			// Get the data for this user
			$chainbg = $this->m_chainbgs->ReadChainbgs(array('name' => $name, 'state' => $state, 'type' => $type));
	      
	    // Check if any data was retrieved
	    if(!$chainbg)
	    {
	    	// Insert the data and get the new id
        $chainbg_id = $this->m_chainbgs->CreateChainbg(array('name' => $name, 'type' => $type,'state' => $state));
	    }
	    else{
	    	// retrieve the id
	    	$chainbg_id = $chainbg[0]->id;
	    }
		}    

//		echo "<script>alert('chainbg_id = $chainbg_id');</script>";
		
		// return the chainbg_id
    return $chainbg_id;
  }

/**
   * Given a name in the format "name[State]", this function finds a chainbg of this config.
   * If found it returns the id of that chainbg. Else it creates a new entry in the table
   * and returns the newly created record's id
   * 
   * @param $name: the name of the chainbg to search in the format of "name[State]"
   * Dec 16, 2010
   */
  function _findChainbgById($id){
  	// Load the chainbg model
  	$this->load->model("m_chainbgs");

  	// Get the data for this user
  	$chainbg = $this->m_chainbgs->ReadChainbgs(array('id' => $id));

  	// Check if any data was retrieved
  	if(!$chainbg)
  	{
  		// Set an error
  		$chainbg_name = "Could not find the Chain/Banner Group";
  	}
  	else{
  		// generate the name
      $chainbg_name = $chainbg->name."[".$chainbg->type."-".$chainbg->state."]";
    }

    // return the $chainbg_name
    return $chainbg_name;
  }  
	/**
	 * Validates the input columns on insert/update
	 * 
	 * @param $edit : if it is edit mode or insert mode.
	 * Dec 15, 2010
	 */
	function _form_validations($edit = false)
	{
		// Set the validations
		if(!$edit)
			$this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]|callback__check_name');
		else 
			$this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]');
		
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		
		// The chainbg is mandatory (and numeric) only if the type is either a Chain or BG
		if(($this->input->post('type') != '') && ($this->input->post('type') != 'Ind'))
		  $this->form_validation->set_rules('chainbg', 'Chain/Banner Group', 'trim|required');
		
		$this->form_validation->set_rules('street', 'street', 'trim|max_length[512]');
		$this->form_validation->set_rules('street2', 'street2', 'trim|max_length[512]');
		$this->form_validation->set_rules('suburb', 'suburb', 'trim|max_length[100]');
		$this->form_validation->set_rules('city', 'city', 'trim|max_length[512]');
		$this->form_validation->set_rules('postcode', 'postcode', 'trim|numeric|exact_length[4]');
		$this->form_validation->set_rules('state', 'state', 'trim|required');
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
	}
	
	// CRUD methods
	/**
	 * Function to create new stores
	 *
	 * Dec 15, 2010
	 */
	function add()
	{
		// the chainbg_id manipulation comes here
		if(isset($_POST['chainbg']))
		  $_POST['chainbg_id'] = $this->_findChainbgByName($_POST['chainbg']);
		
		// Set the form validations
		$this->_form_validations();
		
		// Run the validations
		if($this->form_validation->run())
		{
			// Validations successful 
			//remove the chainbg
			unset($_POST['chainbg']);
			
			// insert into database
			$storeId = $this->m_stores->CreateStore($_POST);
			
			// Check for success
			if ($storeId)
			{
				$this->session->set_flashdata('flashConfirm', "A new store with Id($storeId) has been created");
			}
			else
			{
				$this->session->set_flashdata('flashError', "Error: Store could not be created because of DB error. Please contact your administrator");
			}
			
			// Redirect to user index
			redirect('store/index');
		}
		$data['title'] = "Add Store";
		$data['heading'] = "Add Store";
		
		// Load the view
		$this->load->view('dashboard/store/add', $data);
	}
	
	/**
	 * Function to retrieve all stores
	 * 
	 * @param $offset: The offset for pagination
	 * @param $per_page: The number of recors to be shown per page (pagination)
	 * Dec 15, 2010
	 */
	function index($offset = 0, $per_page = 10)
	{
		// Laod the pagination
		$this->load->library('pagination');
		
		// Prepare the pagination config
		$pag_config['base_url'] = base_url(). 'store/index/'; 
		$pag_config['total_rows'] =  $this->m_stores->ReadStores(array('count' => true));
		$pag_config['per_page'] = $per_page; 
		$pag_config['uri_segment'] = 3; 
		
		// Get all users (not deleted)
		$data['stores'] = $this->m_stores->ReadStores(array('limit' => $per_page, 'offset' => $offset, 'sortBy' => 'name', 'sortDirection' => 'ASC'));
    $data['tot_count'] = $pag_config['total_rows']; 
		
		// Initialise the pagination
		$this->pagination->initialize($pag_config);
		
		// create the links
		$data['pagination'] = $this->pagination->create_links(); 
		
		// Set the page data
		$data['title'] = "All Stores";
		$data['heading'] = "All Stores";
		
		// Load the view with this data
		$this->load->view('dashboard/store/index', $data);
	}

  /**
   * Function to retrieve all stores for the chainbg_id provided
   * 
   * @param $chainbg_id: The id of the chainbg
   * Dec 16, 2010
   */	
	function chainbg($chainbg_id = -1)
  {
    // TODO: make pagination work with arguments
    
    // Get all users (not deleted)
    if($chainbg_id == -1){
      $data['stores'] = $this->m_stores->ReadStores(array('type' => 'Ind'));
      // Set the page data
      $data['title'] = "All independent Stores";
      $data['heading'] = "All independent Stores";
    }
    else{
      $data['stores'] = $this->m_stores->ReadStores(array('chainbg_id' => $chainbg_id));
      // Find the details of the chain/banner group
      $chainbg_name = $this->_findChainbgById($chainbg_id);  

      // Set the page data
      $data['title'] = "Stores for $chainbg_name";
      $data['heading'] = "Stores for $chainbg_name";
    } 
    
    // Load the view with this data
    $this->load->view('dashboard/store/index', $data);
  }
	
	
	/**
	 * Function to edit the details of the specified store
	 * 
	 * @param $id: The id of the store to update
	 * Dec 15, 2010
	 */
	function edit($id)
	{
		// Get the data for this user
		$data['store'] = $this->m_stores->ReadStores(array('id' => $id));
    
//		echo "<script>alert('".$data['store']->chainbg_id."')</script>";
		// Check if any data was retrieved
		if(!$data['store'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This store does not exist');
			redirect('store/index');
		}
		
    // Manipulate the chainbg_id we get from the database
    $data['store']->chainbg = $this->_findChainbgById($data['store']->chainbg_id); 
		
		// Set the validations (argument true if both the chain name and state are not changed)
		$this->_form_validations(true);

		// Run the validations
		if($this->form_validation->run())
		{
			// Validations successful - update database
			$_POST['id'] = $id;
      
//    echo "<script>alert('".$_POST['chainbg']."')</script>";
			// the chainbg_id manipulation comes here
	    //if(isset($_POST['chainbg']))
	      $_POST['chainbg_id'] = $this->_findChainbgByName($_POST['chainbg']);

//	    //remove the chainbg
//      unset($_POST['chainbg']);
      							
			// Check for success
			if ($this->m_stores->UpdateStores($_POST))
			{
				$this->session->set_flashdata('flashConfirm', 'Store ( '.$_POST['name'].' ) has been updated');
			}
			else
			{
				$this->session->set_flashdata('flashWarning', 'Database not updated! This is possible because no changes were made before saving.');
			}
			
			// Redirect to user index
			redirect('store/edit/'.$id);
		}
		
		$data['title'] = "Edit Store";
		$data['heading'] = "Edit Store";
		
		// Load the view
		$this->load->view('dashboard/store/edit', $data);
	}
	
	/**
	 * Shows the details of the store
	 * 
	 * @param $id: The id of the store to show
	 */
	function view($id)
	{
		// Get the data for this user
		$data['store'] = $this->m_stores->ReadStores(array('id' => $id));

		
		// Check if any data was retrieved
		if(!$data['store'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This store does not exist');
			redirect('store/index');
		}
		
    // Handle the chainbg_id
		// Manipulate the chainbg_id we get from the database
    $data['store']->chainbg = $this->_findChainbgById($data['store']->chainbg_id); 
		
    $data['title'] = "Store Details";
		$data['heading'] = "Store Details";
		
		// Load the view
		$this->load->view('dashboard/store/view', $data);
	}	
	
	/**
	 * Deletes the chain/banner group specified
	 * 
	 * @param $id: the id of the chain/banner group to delete
	 * Dec 15, 2010
	 */
	function delete($id)
	{
		// Get the data for this user
		$data['store'] = $this->m_stores->ReadStores(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['store'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This store does not exist');
			redirect('store/index');
		}
		
		// Delete the user
		$this->m_stores->DeleteStore($id);
		
		// set the flashdata
		$this->session->set_flashdata('flashConfirm', "Store ( id = $id ) has been deleted");
	
		// Redirect to user index
		redirect('store/index');
	}
}