<?php
/** 
 * m_stores.php
 * Description	: CRUD and other operations for a stores
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
class M_stores extends Model 
{
	// CRUD methods
	/**
	 * 
	 * To insert users into database...
	 * @param $options array with info
	 *  name
	 *  type
	 *  chainbg_id
	 *  street
	 *  street2
	 *  suburb
	 *  city
	 *  postcode
	 *  state
	 *  lat
	 *  lng
	 *  website
	 *  email1
	 *  email2
	 *  email3
	 *  tel1
	 *  tel2
	 *  tel3
	 *  fax1
	 *  fax2
	 *  fax3
	 *  @return the insert id
	 */
	function CreateStore($options = array())
	{
		// Check for mandatory columns
		if(!_required(array('type'), $options)) return false;
		
		// Default columns
		$options = _default(array('status' => 'Active', 'created_at' => date('Y-m-d h:i:s')), $options);
		
		// Calculate and set the 'lat' & 'lng' columns using google maps
		//$coords = _calculateLatLng($options['street'].", ".$options['suburb'].", ".$options['postcode'].", ". $options['state']);
		$coords = _calcLatLngOfAdd($options);

		// If something was returned without error, add it to the options
		if($coords['lat'] != "error" && $coords['lng'] != "error")
			$options = array_merge($coords, $options);
		
		// Run the insert query
		$this->db->insert('stores', $options);
		
		// Return the generated id
		return $this->db->insert_id();
	}
	
	/**
	 * Reads the users provided the details
	 * @param $options (array)
	 * 	id			: Select by this id
	 *  name
	 *  type
	 *  chainbg_id
	 *  street 		: searches street, street2 columns
	 *  suburb
	 *  city
	 *  postcode
	 *  state
	 *  lat
	 *  lng
	 *  website
	 *  email 		: searches email1, email2, email3 columns
	 *  tel 		: searches tel1, tel2, tel3 columns
	 *  fax			: searches fax1, fax2, fax3
	 *  status		: Select by this status
	 *  limit		: Limit these namy results
	 *  offset		: Start showing results from this offset onwards
	 *  sortBy		: Sort by this column name
	 *  sortDirection	:	Asc/desc
	 * 
	 * @return The object of the retrieved result(s)
	 */
	function ReadStores($options = array())
	{
		// Set all where clauses (if given)
		if(isset($options['id']))
			$this->db->where('id', $options['id']);

		if(isset($options['name']))
			$this->db->where('name', $options['name']);

		if(isset($options['type']))
			$this->db->where('type', $options['type']);

		if(isset($options['chainbg_id']))
			$this->db->where('chainbg_id', $options['chainbg_id']);

		if(isset($options['street']))
		{
			$this->db->where('street', $options['street']);
			$this->db->or_where('street2', $options['street']);
		}
			
		if(isset($options['suburb']))
			$this->db->where('suburb', $options['suburb']);
	
		if(isset($options['city']))
			$this->db->where('city', $options['city']);
	
		if(isset($options['postcode']))
			$this->db->where('postcode', $options['postcode']);
	
		if(isset($options['state']) && !empty($options['state']))
			$this->db->where('state', $options['state']);
		
		if(isset($options['lat']))
			$this->db->where('lat', $options['lat']);
			
		if(isset($options['lng']))
			$this->db->where('lng', $options['lng']);
			
		if(isset($options['website']))
			$this->db->where('website', $options['website']);

		if(isset($options['email']))
		{
			$this->db->where('email1', $options['email']);
			$this->db->or_where('email2', $options['email']);
			$this->db->or_where('email3', $options['email']);
		}
			
		if(isset($options['tel']))
		{
			$this->db->where('tel1', $options['tel']);
			$this->db->or_where('tel2', $options['tel']);
			$this->db->or_where('tel3', $options['tel']);
		}
		
		if(isset($options['fax']))
		{
			$this->db->where('fax1', $options['fax']);
			$this->db->or_where('fax2', $options['fax']);
			$this->db->or_where('fax3', $options['fax']);
		}
		
		if(isset($options['status']))
			$this->db->where('status', $options['status']);
		else 
			$this->db->where('status !=', 'Deleted');

		// Set the limits
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'], $options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);
			
		// Sorting
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'], $options['sortDirection']);
			
		// Run the query
		$query = $this->db->get("stores");
		
		// Check if only the count is required
		if(isset($options['count']) && $options['count']) return $query->num_rows(); 	
		
		// Return - first the unique column results
		if(isset($options['id']))
			return $query->row(0);
		
		return $query->result();
	}

	/**
	 * Updates a stores
	 * @param $options
	 * 	id			:	The id of the stores to update
	 *  name
	 *  type
	 *  chainbg_id
	 *  street		: 	Modifying this will update lat lng
	 *  street2		: 	Modifying this will update lat lng
	 *  suburb		: 	Modifying this will update lat lng
	 *  city		: 	Modifying this will update lat lng
	 *  postcode	: 	Modifying this will update lat lng
	 *  state		: 	Modifying this will update lat lng
	 *  website
	 *  email1
	 *  email2
	 *  email3
	 *  tel1
	 *  tel2
	 *  tel3
	 *  fax1
	 *  fax2
	 *  fax3
	 *  status
	 *  
	 * @return	The number of rows affected.
	 */
	function UpdateStores($options = array())
	{
		$flagAddressChanged = false;
		 
		// Check for required columns
		if(!_required(array('id'), $options)) return false;
		
		// Set the where condition
		$this->db->where('id', $options['id']);
		
		// Update the fields
		if(isset($options['name']))
			$this->db->set('name', $options['name']);

		if(isset($options['type']))
			$this->db->set('type', $options['type']);

		if(isset($options['chainbg_id']))
			$this->db->set('chainbg_id', $options['chainbg_id']);
			
		if(isset($options['street']))
		{
			$this->db->set('street', $options['street']);
			$flagAddressChanged = true;
		}

		if(isset($options['clean_address']))
		{
			$this->db->set('clean_address', $options['clean_address']);
			$flagAddressChanged = true;
		}

		if(isset($options['street2']))
		{
			$this->db->set('street2', $options['street2']);
			$flagAddressChanged = true;
		}
		
		if(isset($options['suburb']))
		{
			$this->db->set('suburb', $options['suburb']);
			$flagAddressChanged = true;
		}
		
		if(isset($options['city']))
		{
			$this->db->set('city', $options['city']);
			$flagAddressChanged = true;
		}
		
		if(isset($options['postcode']) && $options['postcode'] != 0)
		{
			$this->db->set('postcode', $options['postcode']);
			$flagAddressChanged = true;
		}

		if(isset($options['state']))
		{
			$this->db->set('state', $options['state']);
			$flagAddressChanged = true;
		}

		if($flagAddressChanged)
		{
			// Address is changes, re-calculate the lat/lng of new address
//			$coords = _calculateLatLng($options['street'].", ".$options['suburb'].", ".$options['postcode'].", ". $options['state']);
			$coords = _calcLatLngOfAdd($options);
	
			// If something was returned without error, add it to the options
			if($coords['lat'] != "error" && $coords['lng'] != "error")
			{
				$this->db->set('lat', $coords['lat']);
				$this->db->set('lng', $coords['lng']);
			}
		}		

		// 12 July 2011: Code added to allow direclty updating lat lng
		if(isset($options['lat']))
			$this->db->set('lat', $options['lat']);

		if(isset($options['lng']))
			$this->db->set('lng', $options['lng']);
		// 12 July 2011: End of code addition
				
		if(isset($options['website']))
			$this->db->set('website', $options['website']);

		if(isset($options['email1']))
			$this->db->set('email1', $options['email1']);
		if(isset($options['email2']))
			$this->db->set('email2', $options['email2']);
		if(isset($options['email3']))
			$this->db->set('email3', $options['email3']);

		if(isset($options['tel1']))
			$this->db->set('tel1', $options['tel1']);
		if(isset($options['tel2']))
			$this->db->set('tel2', $options['tel2']);
		if(isset($options['tel3']))
			$this->db->set('tel3', $options['tel3']);
			
		if(isset($options['fax1']))
			$this->db->set('fax1', $options['fax1']);
		if(isset($options['fax2']))
			$this->db->set('fax2', $options['fax2']);
		if(isset($options['fax3']))
			$this->db->set('fax3', $options['fax3']);
			
		// CR 29JUL2011: Tags functionality
		if(isset($options['tags']))
			$this->db->set('tags', $options['tags']);
		// CR 29JUL2011: Ends

		if(isset($options['status']))
			$this->db->set('status', $options['status']);
			
		// Update the database
		$this->db->update('stores');
		
		//return
		return $this->db->affected_rows();
	}
	
	/**
	 * Deletes a Store
	 * @param $id			:	The id of the stores to update
	 *  
	 * @return	The number of rows affected.
	 */
	function DeleteStore($id)
	{
		return($this->UpdateStores(array('id' => $id, 'status' => 'Deleted')));
	}
  /**
   * Finds possible name matches 
   * @param $options
   *  term      : The string to match with
   *  status    : The status of rows (default: all records where status != 'Deleted')
   *  limit     : Limit these namy results
   *  offset    : Start showing results from this offset onwards
   *  sortBy    : Sort by this column name
   *  sortDirection : Asc/desc
   *  
   * @return  The rows of possible matches
   */
  function FindStores($options = array())
  {
    // Set all where clauses (if given)
    $this->db->where('name like', "%".$options['term']."%");

    // Dont show deleted
    if(isset($options['status']))
      $this->db->where('status', $options['status']);
    else 
      $this->db->where('status !=', 'Deleted');
        
    // Set the limits
    if(isset($options['limit']) && isset($options['offset']))
      $this->db->limit($options['limit'], $options['offset']);
    else if(isset($options['limit']))
      $this->db->limit($options['limit']);
      
    // Sorting
    if(isset($options['sortBy']) && isset($options['sortDirection']))
      $this->db->order_by($options['sortBy'], $options['sortDirection']);
      
    // Run the query
    $query = $this->db->get("stores");
    
    // Check if only the count is required
    if(isset($options['count']) && $options['count']) return $query->num_rows();  
    
    return $query->result();
  }
}