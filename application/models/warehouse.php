<?php
/** 
 * warehouse.php
 * Description	: CRUD and other operations for a warehouse
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 20, 2010
 */
class Warehouse extends Model 
{
	// Utility methods
	/**
	 * 
	 * Checks for mandaory columns
	 * @param $required - array :the names of required columns
	 * @param $data - array : the actual data
	 * @return true if all required variables exist
	 */
	function _required($required, $data)
	{
		foreach ($required as $field)
			if(!isset($data[$field])) return false;
			
		return true;
	}
	
	/**
	 * Sets the default value for the given column
	 * @param $default associative array defining the column => default value
	 * @param $option associative array containing the actual data.
	 */
	function _default($default, $option)
	{
		return array_merge($default, $option);
	}

	function _calculateLatLng($address)
	{
		define("MAPS_HOST", "maps.google.com");
		define("KEY", "ABQIAAAADy2F1JZevUhmdpyOnYpvZhSQgF_ruoSu5-Aul0WSoybPltiq_xSyJz2q9ilFoYa9x1PK1Nl1egaTRA");

		// Initialize delay in geocode speed
		$delay = 0;
		$base_url = "http://" . MAPS_HOST . "/maps/geo?output=xml" . "&key=" . KEY;

		
		$geocode_pending = true;

		while ($geocode_pending) {
			$request_url = $base_url . "&q=" . urlencode($address. ", Australia");
			$xml = simplexml_load_file($request_url) or die("url not loading");

			$status = $xml->Response->Status->code;
			if (strcmp($status, "200") == 0) {
				// Successful geocode
				$geocode_pending = false;
				$coordinates = $xml->Response->Placemark->Point->coordinates;
				$coordinatesSplit = explode(",", $coordinates);
				// Format: Longitude, Latitude, Altitude
				$lat = $coordinatesSplit[1];
				$lng = $coordinatesSplit[0];

				return array('lat'=>$lat, 'lng' => $lng);
			} else if (strcmp($status, "620") == 0) {
				// sent geocodes too fast
				$delay += 100000;
			} else {
				// failure to geocode
				$geocode_pending = false;
			}
			usleep($delay);

		}

		return array('lat'=>'error', 'lng' => 'error');
	}

	// CRUD methods
	/**
	 * 
	 * To insert users into database...
	 * @param $options array with info
	 *  chain_name
	 *  address
	 *  suburb
	 *  postcode
	 *  state
	 *  status
	 *  
	 * @return the insert id
	 */
	function CreateWarehouse($options = array())
	{
		// Check for mandatory columns
		if(!$this->_required(array('chain_name'), $options)) return false;
		
		// Default columns
		$options = $this->_default(array('status' => 'Active', 'created_at' => date('Y-m-d h:i:s')), $options);
		
		// TODO: Calculate and set the 'state_iso' and 'state_id' columns
		// ....
		
		// Calculate and set the 'lat' & 'lng' columns using google maps
		$coords = $this->_calculateLatLng($options['address'].", ".$options['suburb'].", ".$options['postcode'].", ". $options['state']);

		// If something was returned without error, add it to the options
		if($coords['lat'] != "error" && $coords['lng'] != "error")
			$options = array_merge($coords, $options);
		
		// Run the insert query
		$this->db->insert('warehouses', $options);
		
		// Return the generated id
		return $this->db->insert_id();
	}
	
	/**
	 * Reads the users provided the details
	 * @param $options (array)
	 * 	id			:	Select by this id
	 * 	chain_name	:	Select by this chain_name
	 *  address		:	Select by this address
	 *  postcode	: 	Select by this postcode
	 *  state		: 	Select by this state
	 *  state_iso	: 	Select by this state iso code
	 *  state_id	: 	Select by this state id
	 *  status		: 	Select by this status
	 *  limit		:	Limit these namy results
	 *  offset		:	Start showing results from this offset onwards
	 *  sortBy		: 	Sort by this column name
	 *  sortDirection	:	Asc/desc
	 * 
	 * @return The object of the retrieved result(s)
	 */
	function ReadWarehouses($options = array())
	{
		// Set all where clauses (if given)
		if(isset($options['id']))
			$this->db->where('id', $options['id']);

		if(isset($options['chain_name']))
			$this->db->where('chain_name', $options['chain_name']);

		if(isset($options['address']))
			$this->db->where('address', $options['address']);
			
		if(isset($options['postcode']))
			$this->db->where('postcode', $options['postcode']);
	
		if(isset($options['state']))
			$this->db->where('state', $options['state']);
		
		if(isset($options['state_iso']))
			$this->db->where('state_iso', $options['state_iso']);
			
		if(isset($options['state_id']))
			$this->db->where('state_id', $options['state_id']);
			
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
		$query = $this->db->get("warehouses");
		
		// Check if only the count is required
		if(isset($options['count']) && $options['count']) return $query->num_rows(); 	
		
		// Return - first the unique column results
		if(isset($options['id']))
			return $query->row(0);
		
		return $query->result();
	}

	/**
	 * Updates a warehouse
	 * @param $options
	 * 	id			:	The id of the warehouse to update
	 * 	chain_name	:	Select by this chain_name
	 *  address		:	Select by this address
	 *  postcode	: 	Select by this postcode
	 *  state		: 	Select by this state
	 *  state_iso	: 	Select by this state iso code
	 *  state_id	: 	Select by this state id
	 *  status		: 	The changed warehouse status
	 *  
	 * @return	The number of rows affected.
	 */
	function UpdateWarehouse($options = array())
	{
//		print_r($options);
//		die();
		$flagAddressChanged = false;
		 
		// Check for required columns
		if(!$this->_required(array('id'), $options)) return false;
		
		// Set the where condition
		$this->db->where('id', $options['id']);
		
		// Update the fields
		if(isset($options['chain_name']))
			$this->db->set('chain_name', $options['chain_name']);

		if(isset($options['address']))
		{
			$this->db->set('address', $options['address']);
			$flagAddressChanged = true;
		}

		if(isset($options['suburb']))
		{
			$this->db->set('suburb', $options['suburb']);
			$flagAddressChanged = true;
		}
		
		if(isset($options['postcode']))
		{
			$this->db->set('postcode', $options['postcode']);
			$flagAddressChanged = true;
		}

		if(isset($options['state']) || isset($options['state_iso']) || isset($options['state_id']))
		{
			// TODO: Recalculate each of the above three to make sure data is consistent
			$this->db->set('state', $options['state']);
			
		}
		
		if($flagAddressChanged)
		{
			// Address is changes, re-calculate the lat/lng of new address
			$coords = $this->_calculateLatLng($options['address'].", ".$options['suburb'].", ".$options['postcode'].", ". $options['state']);
	
			// If something was returned without error, add it to the options
			if($coords['lat'] != "error" && $coords['lng'] != "error")
			{
				$this->db->set('lat', $coords['lat']);
				$this->db->set('lng', $coords['lng']);
			}
		}
					
		if(isset($options['status']))
			$this->db->set('status', $options['status']);
			
		// Update the database
		$this->db->update('warehouses');
		
		//return
		return $this->db->affected_rows();
	}
	
	/**
	 * Deletes a warehouse
	 * @param $id			:	The id of the warehouse to update
	 *  
	 * @return	The number of rows affected.
	 */
	function DeleteWarehouse($id)
	{
		return($this->UpdateWarehouse(array('id' => $id, 'status' => 'Deleted')));
	}
  
  /**
   * Queries the database base on the AJAX param
   * @param $name     : The name of the warehouse entered in the input box
   *  
   * @return  The number of rows affected.
   */
  function ajaxGetWH($options = array())
  {
    // Set all where clauses (if given)
    $this->db->where('chain_name like', $options['name'].'%');

    // Run the query
    $query = $this->db->get("warehouses");
    
    return $query->result();
  }
  
}