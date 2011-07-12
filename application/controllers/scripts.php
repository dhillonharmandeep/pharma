<?php
/** 
 * scripts.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Jul 1, 2011
 */
class Scripts extends Controller {
	function Scripts(){
		parent::Controller();
		
		// Set the security of this page
		if (!$this->user->Secure(array('type' => 'Admin')))
		{
			$this->session->set_flashdata('flashError', 'You must be logged in as admin to access this page');
			redirect('login');	
		}
	}
	
	/**
	 * Function to list all the scripts
	 * 
	 * Jul 1, 2011
	 */
	function index()
	{
		// Set the page data
		$data['title'] = "All Scripts";
		$data['heading'] = "All Scripts";
		$data['scripts'] = array(
							'upload_medicine' => 'Upload Medicines',
							'geocode_chainbg' => 'Geo-code All New Chainbgs',
							'geocode_stores' => 'Geo-code All New Stores',
							);
		
		// Load the view with this data
		$this->load->view('dashboard/scripts/index', $data);
	}
	
	/**
	 * To upload medicine details from xml file
	 */
	function upload_medicine(){
		// Set the page data
		$data['title'] = "Upload Medicines";
		$data['heading'] = "Upload Medicines";

		// Load the view with this data
		$this->load->view('dashboard/scripts/medicine', $data);
	}

	function do_upload()
	{
		// Set the page data
		$data['title'] = "Upload Medicines - Results";
		$data['heading'] = "Upload Medicines - Results";

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'xml|txt';
		$config['max_size']	= '10000';
		$config['overwrite'] = true;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			// An error has occurred. Nothing else to do but print it
			$data['error'] = $this->upload->display_errors();
		}
		else
		{
			// File has been uploaded - proceed to uploading the data
			$data['upload_data'] = $this->upload->data();
			
			$data['results'] = $this->med_XML2DB($data['upload_data']['full_path']);
		}

		$this->load->view('dashboard/scripts/medicine', $data);

	}

	function geocode_chainbg(){
		// This function will geocode all the chainbgs
		// Set the page data
		$data['title'] = "Scripts - Geocode New Chains/Banner Groups";
		$data['heading'] = "Scripts - Geocode New Chains/Banner Groups";
		$data['model'] = "Chain/Banner Groups";
		
		// Load the models
		$this->load->model('m_chainbgs');
		
		// Read all the chainbgs with lat,lng as 0,0
		$data['count_tot'] = $this->m_chainbgs->ReadChainbgs(array('count'=>true));
		$chainbgs = $this->m_chainbgs->ReadChainbgs(array('lat'=>0, 'lng' => 0));
		
		// Counters
		$count_all = 0;
		$count_upd = 0;
		
		// Loop through each of them and geocode them
		foreach ($chainbgs as $chainbg)
		{
			$count_all++;
			// Prepare the address
			$address = ""; 
			if (!empty($chainbg->street))
				$address .= $chainbg->street.", ";
				
			if (!empty($chainbg->suburb))
				$address .= $chainbg->suburb.", ";
			
			if (!empty($chainbg->postcode))
				$address .= $chainbg->postcode.", ";
			
			if (!empty($chainbg->state))
				$address .= $chainbg->state;
							
			// Try to Geocode
			$coords = _calculateLatLng($address);
		
			// If something was returned without error, update this record
			if($coords['lat'] != "error" && $coords['lng'] != "error")
			{
				$this->m_chainbgs->UpdateChainbgs(array('id'=>$chainbg->id, 'lat' => $coords['lat'], 'lng' => $coords['lng']));
				$count_upd++;
			}
		}
		
		$data['count_all']	= $count_all;
		$data['count_upd']	= $count_upd;
		$data['count_miss'] = ($count_all-$count_upd);
				
		$this->load->view('dashboard/scripts/geocode', $data);
	}

	function geocode_stores(){
		// This function will geocode all the chainbgs
		// Set the page data
		$data['title'] = "Scripts - Geocode New Store";
		$data['heading'] = "Scripts - Geocode New Stores";
		$data['model'] = "Stores";
		
		// Load the models
		$this->load->model('m_stores');
		
		// Read all the chainbgs with lat,lng as 0,0
		$data['count_tot'] = $this->m_stores->ReadStores(array('count'=>true));
		$stores = $this->m_stores->ReadStores(array('lat'=>0, 'lng' => 0));
		
		// Counters
		$count_all = 0;
		$count_upd = 0;
		
		// Loop through each of them and geocode them
		foreach ($stores as $store)
		{
			$count_all++;
			// Prepare the address
			$address = ""; 
			if (!empty($store->street))
				$address .= $store->street.", ";
				
			if (!empty($store->suburb))
				$address .= $store->suburb.", ";
			
			if (!empty($store->postcode))
				$address .= $store->postcode.", ";
			
			if (!empty($store->state))
				$address .= $store->state;
							
			// Try to Geocode
			$coords = _calculateLatLng($address);
		
			// If something was returned without error, update this record
			if($coords['lat'] != "error" && $coords['lng'] != "error")
			{
				$this->m_stores->UpdateStores(array('id'=>$store->id, 'lat' => $coords['lat'], 'lng' => $coords['lng']));
				$count_upd++;
			}
		}
		
		$data['count_all']	= $count_all;
		$data['count_upd']	= $count_upd;
		$data['count_miss'] = ($count_all-$count_upd);
				
		$this->load->view('dashboard/scripts/geocode', $data);
	}

	// The private function to upload the XML 
	private function med_XML2DB($filepath)
	{
		// Set the time limit to high to allow long imports
		set_time_limit(500);
		
		// Load the models
		$this->load->model('m_medicine_import');
		$this->load->model('m_salts');
		$this->load->model('m_medicine_salts');
		
		// Declrae the variables	
		$results = array();
		$results['filepath'] = $filepath;
		
		// get the root node
		$xml = simplexml_load_file($filepath);

		// Counters
		$count_tables = 0;
		$count_medicines = 0;
		$count_salts_new = 0;
		$count_salts_old = 0;
		$count_med_salts = 0;

		// Loop through all the tables
		foreach($xml->children() as $table)
  		{
  			$count_tables++;
  			// loop through each medicine
  			foreach($table->children() as $medicine){
//echo "<hr/>";
  				// ignore the thead
  				if($medicine->getName()!= 'thead'){
  					$count_medicines++;
					
					// Find all the medicine data to insert					
					$med['name'] = trim((string)$medicine->td[0]);

					// The links
					// reset counters
					$cmi = 1; $pi = 1;
					foreach($medicine->td[1]->children() as $link){
						$lbase = '';
						if($link == 'CMI'){
							$lbase = 'CMI'.$cmi.'_';
							$cmi++;
						}							
						else if($link == 'PI'){
							$lbase = 'PI'.$pi.'_';
							$pi++;
						}

						$med[$lbase.'link'] = trim($link->attributes()->href);
						$med[$lbase.'target'] = trim ($link->attributes()->target);
					}

					// insert into the medicine_import table
					$medID = $this->m_medicine_import->CreateMedicine($med);

					// Add all the salt information 
					$ingreds = $this->string2array(trim((string)$medicine->td[2]));
					foreach ($ingreds as $salt){
						$count_med_salts++;
						// Find the salt ID
						$s = $this->m_salts->ReadSalts(array('name'=>$salt));
						
						// Find if salt exists, else create recors
						if($s){
							$saltID = $s->id;
							$count_salts_old++;
						}
						else{
							$saltID = $this->m_salts->CreateSalt(array('name'=>$salt));
							$count_salts_new++;
						}

						// Insert this medicine-salt information
						$this->m_medicine_salts->CreateMedicine_salt(array(	'medicine_id' => $medID, 
																			'salt_id' => $saltID, 
																			'dosage' => 'UNKNOWN'));
					}
					
//if ($count_medicines==5)break;
  				}
  			}
//break;
		}
		
		$results['table_count'] = $count_tables;
		$results['medicine_count'] = $count_medicines;
		$results['med_salt_count'] = $count_med_salts;
		$results['new_salt_count'] = $count_salts_new;
		$results['old_salt_count'] = $count_salts_old;
//die();		
		return $results; 
	} 

 	private function string2array($tags)
	{
		return preg_split('/\s*;\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
	}

}