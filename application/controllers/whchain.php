<?php
/** 
 * whchain.php
 * Description	: The controller for CRUD of warehouse model
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 22, 2010
 */

class Whchain extends Controller { 
	function Whchain(){
		parent::Controller();
		
		// Set the security of this page
		if (!$this->user->Secure(array('type' => 'Admin')))
		{
			$this->session->set_flashdata('flashError', 'You must be logged in as admin to access this page');
			redirect('login');	
		}
		
		// load the warehouse model
		$this->load->model('warehouse');
	}
	// TODO: Set the comments for this file
	// Helper methods
	function _check_chainname()
	{
//		// TODO: Check the condition for uniqueness with client
//		// For now it checks that there can be only 1 chain by a particular name in a state ( a state cannot have two chains with the same name)
//		if ($this->input->post('suburb') && $this->input->post('state')){
//			// try to find a wearehouse for the given chain_name and state
//			$warehouse = $this->warehouse->ReadWarehouses(array('chain_name' => $this->input->post('chain_name'), 
//																	'suburb' => $this->input->post('suburb'),
//																	 'state' => $this->input->post('state'),));
//			// If a warehouse already exists, we do not allow another one to be created
//			if($warehouse){
//				// Set the error message and fail
//				$this->form_validation->set_message('_check_chainname', "A chain with the name '".$this->input->post('chain_name')."' already exists in suburb ".$this->input->post('suburb')." (".$this->input->post('state')."). Same suburb in a state cannot have two chains with the same name.");
//				return false;
//			}
//		}

		// if we reached here, everything is ok
		return true;
	}
	
	function _form_validaitons($edit = false)
	{
		// Set the validations
		if(!$edit)
			$this->form_validation->set_rules('chain_name', 'chain_name', 'trim|required|max_length[256]|callback__check_chainname');
		else 
			$this->form_validation->set_rules('chain_name', 'chain_name', 'trim|required|max_length[256]');
		
		$this->form_validation->set_rules('address', 'address', 'trim|max_length[512]');
		$this->form_validation->set_rules('suburb', 'suburb', 'trim|max_length[100]');
		$this->form_validation->set_rules('postcode', 'postcode', 'trim|numeric|exact_length[4]');
		$this->form_validation->set_rules('state', 'state', 'trim|required');
	}
	
	// CRUD methods
	// Create
	function add()
	{
		// Set the form validations
		$this->_form_validaitons();
		
		// Run the validations
		if($this->form_validation->run())
		{
//		print_r($options);
//		die();
			// Validations successful - insert into database
			$warehouseId = $this->warehouse->CreateWarehouse($_POST);
			
			// Check for success
			if ($warehouseId)
			{
				$this->session->set_flashdata('flashConfirm', "A new warehouse chain with Id($warehouseId) has been created");
			}
			else
			{
				$this->session->set_flashdata('flashError', "Error: Warehouse chain could not be created because of DB error. Please contact your administrator");
			}
			
			// Redirect to user index
			redirect('whchain/index');
		}
		$data['title'] = "Add Chain";
		$data['heading'] = "Add Chain";
		
		// Load the view
		$this->load->view('whchain/add', $data);
	}
	
	// Retrieve
	function index($offset = 0)
	{
		// Laod the pagination
		$this->load->library('pagination');
		
		// define per page
		$per_page = 10;
		
		// Prepare the pagination config
		$pag_config['base_url'] = base_url(). 'whchain/index/'; 
		$pag_config['total_rows'] =  $this->warehouse->ReadWarehouses(array('count' => true));
		$pag_config['per_page'] = $per_page; 
		$pag_config['uri_segment'] = 3; 
		
		// Get all users (not deleted)
		$data['warehouses'] = $this->warehouse->ReadWarehouses(array('limit' => $per_page, 'offset' => $offset));
		
		// Initialise the pagination
		$this->pagination->initialize($pag_config);
		
		// create the links
		$data['pagination'] = $this->pagination->create_links(); 
		
		$data['title'] = "All Chains";
		$data['heading'] = "All Chains";
		// Load the view with this data
		$this->load->view('whchain/index', $data);
	}
	
	// Update
	function edit($id)
	{
		// Get the data for this user
		$data['warehouse'] = $this->warehouse->ReadWarehouses(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['warehouse'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This warehouse chain does not exist');
			redirect('whchain');
		}
		
		// TODO: Set the validations (argument true if both the chain name and state are not changed)
		$this->_form_validaitons(true);

		// Run the validations
		if($this->form_validation->run())
		{
			// Validations successful - update database
			$_POST['id'] = $id;

			// Check for success
			if ($this->warehouse->UpdateWarehouse($_POST))
			{
				$this->session->set_flashdata('flashConfirm', 'Warehouse chain ( '.$_POST['chain_name'].' - '.$_POST['state'].' ) has been updated');
			}
			else
			{
				$this->session->set_flashdata('flashWarning', 'Database not updated! This is possible because no changes were made before saving.');
			}
			
			// Redirect to user index
			redirect('whchain');
		}
		
		$data['title'] = "Edit Chain";
		$data['heading'] = "Edit Chain";
		
		// Load the view
		$this->load->view('whchain/edit', $data);
	}
	
	// View
	function view($id)
	{
		// Get the data for this user
		$data['warehouse'] = $this->warehouse->ReadWarehouses(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['warehouse'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This warehouse chain does not exist');
			redirect('whchain');
		}
		
		$data['title'] = "Chain Details";
		$data['heading'] = "Chain Details";
		
		// Load the view
		$this->load->view('whchain/view', $data);
	}	
	// Delete
	function delete($id)
	{
		// Get the data for this user
		$data['warehouse'] = $this->warehouse->ReadWarehouses(array('id' => $id));

		// Check if any data was retrieved
		if(!$data['warehouse'])
		{
			// Set the flash error
			$this->session->set_flashdata('flashError', 'This warehouse chain does not exist');
			redirect('whchain/index');
		}
		
		// Delete the user
		$this->warehouse->DeleteWarehouse($id);
		
		// set the flashdata
		$this->session->set_flashdata('flashConfirm', "Warehouse chain ( id = $id ) has been deleted");
	
		// Redirect to user index
		redirect('whchain');
	}
}