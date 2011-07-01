<?php
/** 
 * Medicine.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
class Medicine extends Controller {
	function Medicine(){
		parent::Controller();
		
		// Set the security of this page
		if (!$this->user->Secure(array('type' => 'Admin')))
		{
			$this->session->set_flashdata('flashError', 'You must be logged in as admin to access this page');
			redirect('login');	
		}

		// Load the the chainbg model - autloaded
	    $this->load->model('m_medicines');
	    $this->load->model("m_medicine_types");
	    $this->load->model("m_medicine_salts");
		// CR 29JUL2011: Tags functionality
		$this->load->model('tags');
		// CR 29JUL2011: End
		
	}

	// Helper methods
	/**
	 * Checks if the medicine name entered is allowed using following checks:
	 * 		(name, type) should be unique
	 * 
	 * Nov 29, 2010
	 */
	function _check_name()
	{
		// try to find a medicine for the given name
		$medicine = $this->m_medicines->ReadMedicines(array('name' => $this->input->post('name')));
		
		// If a chain/bg already exists, we do not allow another one to be created
		if($medicine){
			// Set the error message and fail
			$this->form_validation->set_message('_check_name', "A medicine with the name '".$this->input->post('name')."' already exists.");
			return false;
		}
		
		// if we reached here, everything is ok
		return true;
	}
	
  /**
   * Given a medicine type name, this function finds the medicine type id.
   * If found it returns the id of that medicine type. Else it creates a new entry in the table
   * and returns the newly created record's id
   * 
   * @param $name: the name of the medicine type
   * Dec 16, 2010
   */
  function _findMTypeByName($name){   

//    echo "<script>alert('name = $name \\nstate = $state\\ntype = $type');</script>";
  	// Get the data for this user
  	$mtype = $this->m_medicine_types->ReadMedicine_types(array('name' => $name));

  	// Check if any data was retrieved
  	if(!$mtype)
  	{
  		// Insert the data and get the new id
  		$mtypeid = $this->m_medicine_types->CreateMedicine_type(array('name' => $name));
  	}
  	else{
  		// retrieve the id
  		$mtypeid = $mtype[0]->id;
  	}

//    echo "<script>alert('chainbg_id = $chainbg_id');</script>";
    
    // return the chainbg_id
    return $mtypeid;
  }

/**
   * Given the medicine type id, this function returns the name of the medicine type 
   * 
   * @param $id: the medicine type id
   * Dec 16, 2010
   */
  function _findMtypeById($id){
    // Get the data for this user
    $mtype = $this->m_medicine_types->ReadMedicine_types(array('id' => $id));
  	
    // Check if any data was retrieved
    if(!$mtype)
    {
      // Set an error
      $mtype_name = "Could not find the medicine type";
    }
    else{
      // generate the name
      $mtype_name = $mtype->name;
    }

    // return the $mtype_name
    return $mtype_name;
  }  	

  /**
   * Given a salt name, this function finds the salt id.
   * If found it returns the id of that salt. Else it creates a new entry in the table
   * and returns the newly created record's id
   * 
   * @param $name: the name of the salt
   * Dec 16, 2010
   */
  function _findSaltByName($name){   

//    echo "<script>alert('name = $name \\nstate = $state\\ntype = $type');</script>";
    // Load the chainbg model
    $this->load->model("m_salts");

    // Get the data for this user
    $salt = $this->m_salts->ReadSalts(array('name' => $name));

    // Check if any data was retrieved
    if(!$salt)
    {
      // Insert the data and get the new id
      $saltid = $this->m_salts->CreateSalt(array('name' => $name));
    }
    else{
      // retrieve the id
      $saltid = $salt[0]->id;
    }

//    echo "<script>alert('chainbg_id = $chainbg_id');</script>";
    
    // return the chainbg_id
    return $saltid;
  }

/**
   * Given the salt id, this function returns the name of the Salt
   * 
   * @param $id: the salt id
   * Dec 16, 2010
   */
  function _findSaltById($id){
    // Load the salt model
    $this->load->model("m_salts");

    // Get the data for this user
    $salt = $this->m_salts->ReadSalts(array('id' => $id));
    
    // Check if any data was retrieved
    if(!$salt)
    {
      // Set an error
      $salt_name = "Could not find the salt";
    }
    else{
      // generate the name
      $salt_name = $salt->name;
    }

    // return the $salt_name
    return $salt_name;
  }   
  
  
	/**
	 * Validates the input columns on insert/update only for medicine data
	 * 
	 * @param $edit : if it is edit mode or insert mode.
	 * Nov 29, 2010
	 */
	function _form_validations($edit = false)
	{
		// Set the validations
			$this->form_validation->set_rules('name', 'name', 'trim|required|max_length[256]');
	    $this->form_validation->set_rules('quantity', 'quantity', 'trim');
      $this->form_validation->set_rules('dosage', 'dosage', 'trim');
      $this->form_validation->set_rules('company_name', 'company_name', 'trim');
      $this->form_validation->set_rules('notes', 'notes', 'trim');
      $this->form_validation->set_rules('medicine_type', 'medicine type', 'trim|required');
		// CR 29JUL2011: Tags functionality 
		$this->form_validation->set_rules('tags', 'tags', 'trim|normaliseTags');
		// CR 29JUL2011: End 
	}

  /**
   * Validates the input columns on insert/update only for 
   * 
   * @param $id : the id (if multiple salts are added).
   * @param $edit : if it is edit mode or insert mode.
   * Dec 17, 2010
   */
	function _form_validations_medicine_salt($id, $edit = false)
	{
		// Set the validations
		$this->form_validation->set_rules('msalt_'.$id.'name', 'salt name', 'trim|required');
		$this->form_validation->set_rules('msalt_'.$id.'dosage', 'salt dosage', 'trim|required');
  }	
	/**
	 * Extracts the data for the medicine table only from the posted data
	 * 
	 * @return: The data specific to medicine table
	 * Dec 17, 2010
	 */
	function _MedicineData(){
		$data = array();
		// Loop through all the posted data
		foreach($_POST as $key => $value) {
			if (strpos($key, 'msalt_')=== false && $key != 'medicine_type' && $key != 'salt_count'){
				$data[$key] = $value; 
			}
		}
		// return the data
		return $data;
	}

  /**
   * Extracts the data for the medicine_salt table only from the posted data
   * 
   * $id: if there is data for multiple salts, use this id  
   * @return: The data specific to medicine_salt table
   * Dec 17, 2010
   */
	function _MedicineSaltData($id = ''){
    $data = array();
    // Loop through all the posted data
    foreach($_POST as $key => $value) {
      if (strpos($key, "msalt_$id")!== false && $key != 'msalt_'.$id.'name'){
      	$str_key = explode('msalt_'.$id, $key); 
      	//split the name and extract the columns
        $data[$str_key[1]] = $value; 
      }
    }
//print_r($_POST);
//print_r($data); die();
    // return the data
    return $data;
  }
	
	// CRUD methods
	/**
	 * Function to create new medicine
	 *
	 * Nov 29, 2010
	 */
	function add()
	{
		//print_r($_POST); die();
		// medicine_type handling
    if(!empty($_POST['medicine_type'])){
      $_POST['medicine_type_id'] = $this->_findMTypeByName($_POST['medicine_type']);
    }

    // Set the form validations
		$this->_form_validations();
		
		if(isset($_POST['salt_count'])){
		  $salt_count = $_POST['salt_count'];
		}
		else{
			$salt_count = 2;
		}
		
		// Set the validation for all the medicine salts
		for($zz = 1;$zz <=$salt_count; $zz++){
       $this->_form_validations_medicine_salt($zz, false);
		}
		// end of for()
		
		// Run the validations
		if($this->form_validation->run())
		{
			// separate the data of the medicine and medicine_salt table
			// Validations successful - insert into database
			$medicineId = $this->m_medicines->CreateMedicine($this->_MedicineData());
			
			// Check for success
			if ($medicineId)
			{
		        // For loop ends here
		        $this->session->set_flashdata('flashConfirm', "A new medicine with Id($medicineId) has been created");

				// CR 29JUL2011: Tags functionality
				// Also update the tag information
				$this->tags->updateFrequency('',$_POST['tags']);
				// CR 29JUL2011: End
				
        // Now that the medicine has been added, we need to add the each of the medicine_salts data
				// For loop starts here
				for($kk = 1; $kk <=$salt_count; $kk++){	
          // Add the salt_id column
			    if(!empty($_POST['msalt_'.$kk.'name'])){
			      $_POST['msalt_'.$kk.'salt_id'] = $this->_findSaltByName($_POST['msalt_'.$kk.'name']);
			    }
			
			    // add the medicine_id column
			    $_POST['msalt_'.$kk.'medicine_id'] = $medicineId;
		     
			    // Insert the medicine_salt details 
          $medicine_salt_id = $this->m_medicine_salts->CreateMedicine_salt($this->_MedicineSaltData($kk));
          
          if(!$medicine_salt_id){
            $this->session->set_flashdata('flashError', "Error: Medicine Salts could not be linked because of DB error. Please contact your administrator");
          }
				}  
        // For loop ends here          
			}
			else
			{
				$this->session->set_flashdata('flashError', "Error: Medicine could not be created because of DB error. Please contact your administrator");
			}
			// Everything successful - Redirect to user index
			redirect('medicine/index');
		}

		$data['title'] = "Add Medicine";
		$data['heading'] = "Add Medicine";
		
		// Load the view
		$this->load->view('dashboard/medicine/add', $data);
	}
	
	/**
	 * Function to retrieve all medicines
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
		$pag_config['base_url'] = base_url(). 'medicine/index/'; 
		$pag_config['total_rows'] =  $this->m_medicines->ReadMedicines(array('count' => true));
		$pag_config['per_page'] = $per_page; 
		$pag_config['uri_segment'] = 3; 
		
		// Get all users (not deleted)
		$data['medicines'] = $this->m_medicines->ReadMedicines(array('limit' => $per_page, 'offset' => $offset, 'sortBy' => 'name', 'sortDirection' => 'ASC'));
    $data['tot_count'] = $pag_config['total_rows']; 
		
		// Add the medicine type for each record
		for ($ii=0; $ii< count($data['medicines']); $ii++){
			$data['medicines'][$ii]->medicine_type = $this->_findMtypeById($data['medicines'][$ii]->medicine_type_id);
		}
		
		// Initialise the pagination
		$this->pagination->initialize($pag_config);
		
		// create the links
		$data['pagination'] = $this->pagination->create_links(); 
		
		// Set the page data
		$data['title'] = "All Medicines";
		$data['heading'] = "All Medicines";
		
		// Load the view with this data
		$this->load->view('dashboard/medicine/index', $data);
	}
	
	/**
	 * Function to edit the details of the specified medicine
	 * 
	 * @param $id: The id of the medicine to update
	 * Nov 29, 2010
	 */
	function edit($id)
	{
		// Get the data for this user
		$data['medicine'] = $this->m_medicines->ReadMedicines(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['medicine'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This medicine does not exist');
			redirect('medicine/index');
		}

		// CR 29JUL2011: Tags functionality
		// Find the old tags and set it
		$oldTags = $data['medicine']->tags;
		// CR 29JUL2011: End

		// Find the medicine_salts
		$data['medicine_salts'] = $this->m_medicine_salts->FindSaltsForMedicine($id);

		// medicine_type handling
		$data['medicine']->medicine_type = $this->_findMtypeById($data['medicine']->medicine_type_id);

		// Reverse calculation when(if) data is submitted
		if(isset($_POST['medicine_type']))
		$_POST['medicine_type_id'] = $this->_findMTypeByName($_POST['medicine_type']);

		// Find the salt_count
		if(isset($_POST['salt_count'])){
			$salt_count = $_POST['salt_count'];
		}
		else{
			$salt_count = 2;
		}

		// Set the validation for all the medicine salts
		for($zz = 1;$zz <=$salt_count; $zz++){
			$this->_form_validations_medicine_salt($zz, false);
    }
    // end of for()      
      
		// Set the validations 
		$this->_form_validations(true);

		// Run the validations
		if($this->form_validation->run())
		{
			// Validations successful - update database
			$_POST['id'] = $id;

			// Check for success
			if ($this->m_medicines->UpdateMedicines($_POST))
			{
				$this->session->set_flashdata('flashConfirm', 'Medicine ( '.$_POST['name'].' ) has been updated');
				// CR 29JUL2011: Tags functionality
				// Also update the tag information
				$this->tags->updateFrequency($oldTags,$_POST['tags']);
				// CR 29JUL2011: End
			}

      // Now that the medicine has been updated, we need to add the each of the medicine_salts data
      // For loop starts here
      for($kk = 1; $kk <=$salt_count; $kk++){ 
        // Add the salt_id column
        if(!empty($_POST['msalt_'.$kk.'name'])){
          $_POST['msalt_'.$kk.'salt_id'] = $this->_findSaltByName($_POST['msalt_'.$kk.'name']);
        }
    
        // add the medicine_id column
        $_POST['msalt_'.$kk.'medicine_id'] = $id;
       
        // Insert the medicine_salt details 
        $medicine_salt_id = $this->m_medicine_salts->CreateMedicine_salt($this->_MedicineSaltData($kk));
        
        if(!$medicine_salt_id){
          $this->session->set_flashdata('flashError', "Error: Medicine Salts could not be linked because of DB error. Please contact your administrator");
        }
      }  
      // For loop ends here          
			
			// Redirect to user index
			redirect('medicine/edit/'.$id);
		}
		
		$data['title'] = "Edit Medicine";
		$data['heading'] = "Edit Medicine";
		
		// Load the view
		$this->load->view('dashboard/medicine/edit', $data);
	}

  /**
   * Shows the details of the medicine
   * 
   * @param $id: The id of the medicine to show
   */
  function view($id)
  {
    // Get the data for this medicine
    $data['medicine'] = $this->m_medicines->ReadMedicines(array('id' => $id));
    
    // Check if any data was retrieved
    if(!$data['medicine'])
    {
      // Set the flash error
      $this->session->set_flashdata('flashError', 'This medicine does not exist');
      redirect('medicine/index');
    }
    
    // Handle the chainbg_id
    // Manipulate the chainbg_id we get from the database
    $data['medicine']->medicine_type = $this->_findMtypeById($data['medicine']->medicine_type_id); 
    
    // Find the medicine_salts
    $data['medicine_salts'] = $this->m_medicine_salts->FindSaltsForMedicine($id);
    
    $data['title'] = "Medicine Details";
    $data['heading'] = "Medicine Details";
    
    // Load the view
    $this->load->view('dashboard/medicine/view', $data);
  }	
	
	/**
	 * Deletes the medicine specified
	 * 
	 * @param $id: the id of the medicine to delete
	 * Nov 29, 2010
	 */
	function delete($id)
	{
		// Get the data for this user
		$data['medicine'] = $this->m_medicines->ReadMedicines(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['medicine'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This medicine does not exist');
			redirect('medicine/index');
		}
		
		// Delete the user
		$this->m_medicines->DeleteMedicine($id);
		
		// set the flashdata
		$this->session->set_flashdata('flashConfirm', "Medicine ( id = $id ) has been deleted");
		// CR 29JUL2011: Tags functionality
		// Also update the tag information
		$this->tags->updateFrequency($data['medicine']->tags, '');
		// CR 29JUL2011: End
	
		// Redirect to user index
		redirect('medicine/index');
	}

	/**
   * Deletes the medicine specified
   * 
   * @param $id: the id of the medicine to delete
   * Nov 29, 2010
   */
  function delete_salt($saltid, $id)
  {
    // Get the data for this user
    $msalt = $this->m_medicine_salts->ReadMedicine_salts(array('id' => $saltid));

    // Check if any data was retrieved
    if(!$msalt)
    {
      // Set the flash error
      $this->session->set_flashdata('flashError', 'This salt does not exist for this medicine');
      redirect('medicine/edit/'.$id);
    }
    
    // Delete the medicine salt
    $this->m_medicine_salts->DeleteMedicine_salt($saltid);
        
    // set the flashdata
    $this->session->set_flashdata('flashConfirm', "Salt removed from the medicine");
  
    // Redirect to user index
    redirect('medicine/edit/'.$id);
  }
}