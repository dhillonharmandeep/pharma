<?php
/** 
 * medicine_price.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
class Price extends Controller {
	function Price(){
		parent::Controller();
		
		// Set the security of this page
		if (!$this->user->Secure(array('type' => 'Admin')))
		{
			$this->session->set_flashdata('flashError', 'You must be logged in as admin to access this page');
			redirect('login');	
		}

		// Load the the medicine_price model - autloaded
    $this->load->model('m_medicine_prices');
	}

	// Helper methods
	/**
	 * Checks if the the (medicine + store) OR (medicine + chainbg) combination already exists or not 
	 * 		(name, type) should be unique
	 * 
	 * Nov 29, 2010
	 */
	function _check_medicine_listing()
	{
		if ($this->input->post('store_id')){
			// try to find a medicine_id + store_id combination in the database
			$medicine_price = $this->m_medicine_prices->ReadMedicine_prices(array('medicine_id' => $this->input->post('medicine_id'), 
																	 			  'store_id' => $this->input->post('store_id')));
			//print_r($medicine_price);
			// If a such a combination already exists, we do not allow another one to be created
			if($medicine_price){
				// Set the error message and fail
				$this->form_validation->set_message('_check_medicine_listing', 
													"A price entry for '".$this->input->post('medicine_name').
													"' already exists for store '".$this->input->post('store_name').
													"'. Kindly <a href=\"/price/edit/".$medicine_price[0]->id.
													"\">edit the price here</a>");
				return false;
			}
		}

		if ($this->input->post('chainbg_id')){
			// try to find a medicine_id + chainbg_id combination in the database
			$medicine_price = $this->m_medicine_prices->ReadMedicine_prices(array('medicine_id' => $this->input->post('medicine_id'), 
																	 			  'chainbg_id' => $this->input->post('chainbg_id')));

			// If a such a combination already exists, we do not allow another one to be created
			if($medicine_price){
				// Set the error message and fail
				$this->form_validation->set_message('_check_medicine_listing', 
													"A price entry for '".$this->input->post('medicine_name').
													"' already exists for chain/banner group '".$this->input->post('chainbg_name').
													"'. Kindly <a href=\"price/edit/".$medicine_price->id.
													"\">edit the price here</a>");
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
			$this->form_validation->set_rules('medicine_id', 'medicine', 'trim|required|callback__check_medicine_listing');
		else 
			$this->form_validation->set_rules('medicine_id', 'medicine', 'trim|required');
		
		// Either a store or a chainbg must have been selected
		if (!$this->input->post('chainbg_id'))	
			$this->form_validation->set_rules('store_id', 'store/chain/banner group', 'trim|required');
		elseif (!$this->input->post('store_id'))	
			$this->form_validation->set_rules('chainbg_id', 'store/chain/banner group', 'trim|required');

		$this->form_validation->set_rules('medicine', 'medicine', 'trim|required');	
		$this->form_validation->set_rules('store', 'store', 'trim|required');
			
		$this->form_validation->set_rules('price', 'price', 'trim|required|numeric');
	}
	
	// CRUD methods
	/**
	 * Function to create new medicine price listing 
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
			// Remove unwanted columns
			unset($_POST['medicine']);
			unset($_POST['store']);
			if(!$this->input->post('chainbg_id') && empty($_POST['chainbg_id']))unset($_POST['chainbg_id']);
			if(!$this->input->post('store_id') && empty($_POST['store_id']))unset($_POST['store_id']);
			
			// Validations successful - insert into database
			$medicine_priceId = $this->m_medicine_prices->CreateMedicine_price($_POST);
			
			// Check for success
			if ($medicine_priceId)
			{
				$this->session->set_flashdata('flashConfirm', "A new medicine price listing with Id($medicine_priceId) has been created");
			}
			else
			{
				$this->session->set_flashdata('flashError', "Error: medicine price listing could not be created because of DB error. Please contact your administrator");
			}
			
			// Redirect to user index
			redirect('price/index');
		}
		$data['title'] = "Add Medicine Price";
		$data['heading'] = "Add Medicine Price";
		
		// Load the view
		$this->load->view('dashboard/price/add', $data);
	}
	
	/**
	 * Function to retrieve all medicine price listing
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
		$pag_config['base_url'] = base_url(). 'price/index/'; 
		$pag_config['total_rows'] =  $this->m_medicine_prices->ReadAllPrices(array('count' => true));
		$pag_config['per_page'] = $per_page; 
		$pag_config['uri_segment'] = 3; 
		
		// Get all users (not deleted)
		$data['prices'] = $this->m_medicine_prices->ReadAllPrices();
    	$data['tot_count'] = $pag_config['total_rows']; 
		
		// Initialise the pagination
		$this->pagination->initialize($pag_config);
		
		// create the links
		$data['pagination'] = $this->pagination->create_links(); 
		
		// Set the page data
		$data['title'] = "All medicine price listings";
		$data['heading'] = "All medicine price listings";
		
		// Load the view with this data
		$this->load->view('dashboard/price/index', $data);
	}

	/**
	 * Function to edit the details of the specified medicine price listing
	 * 
	 * @param $id: The id of the medicine price listing to update
	 * Nov 29, 2010
	 */
	function edit($id)
	{
		// Get the data for this user
		$data['price'] = $this->m_medicine_prices->ReadMedicine_prices(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['price'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This medicine price listing does not exist');
			redirect('price/index');
		}
		
		$this->_form_validations(true);

		// Run the validations
		if($this->form_validation->run())
		{
			// Validations successful - update database
			$_POST['id'] = $id;

			// Check for success
			if ($this->m_medicine_prices->UpdateMedicine_prices($_POST))
			{
				$this->session->set_flashdata('flashConfirm', 'Medicine Price has been updated');
			}
			else
			{
				$this->session->set_flashdata('flashWarning', 'Database not updated! This is possible because no changes were made before saving.');
			}
			
			// Redirect to user index
			redirect('price/edit/'.$id);
		}
		
		$data['title'] = "Edit Medicine Price";
		$data['heading'] = "Edit Medicine Price";
		
		// Load the view
		$this->load->view('dashboard/price/edit', $data);
	}
	
	/**
	 * Shows the details of the medicine price listing
	 * 
	 * @param $id: The id of the medicine price listing to show
	 */
	function view($id)
	{
		// Get the data for this user
		$data['price'] = $this->m_medicine_prices->ReadMedicine_prices(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['price'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This medicine price listing does not exist');
			redirect('price/index');
		}
		
		$data['title'] = "Medicine Price Details";
		$data['heading'] = "Medicine Price Details";
		
		// Load the view
		$this->load->view('dashboard/price/view', $data);
	}	
	
	/**
	 * Deletes the medicine price listing specified
	 * 
	 * @param $id: the id of the medicine price listing to delete
	 * Nov 29, 2010
	 */
	function delete($id)
	{
		// Get the data for this user
		$data['medicine_price'] = $this->m_medicine_prices->ReadMedicine_prices(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['medicine_price'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This medicine price listing does not exist');
			redirect('price/index');
		}
		
		// Delete the user
		$this->m_medicine_prices->DeleteMedicine_price($id);
		
		// set the flashdata
		$this->session->set_flashdata('flashConfirm', "Medicine price listing ( id = $id ) has been deleted");
	
		// Redirect to user index
		redirect('price/index');
	}
}