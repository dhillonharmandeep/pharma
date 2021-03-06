<?php
/** 
 * m_salts.php
 * Description	: CRUD and other operations for salts
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
class M_salts extends Model 
{
	// CRUD methods
	/**
	 * 
	 * To insert users into database...
	 * @param $options array with info
	 *  name
	 *  @return the insert id
	 */
	function CreateSalt($options = array())
	{
		// Check for mandatory columns
		if(!_required(array('name'), $options)) return false;
		
		// Default columns
		$options = _default(array('status' => 'Active', 'created_at' => date('Y-m-d h:i:s')), $options);
		
		// Run the insert query
		$this->db->insert('salts', $options);
		
		// Return the generated id
		return $this->db->insert_id();
	}
	
	/**
	 * Reads the users provided the details
	 * @param $options (array)
	 * 	id			: Select by this id
	 *  name
	 *  status		: Select by this status
	 *  limit		: Limit these namy results
	 *  offset		: Start showing results from this offset onwards
	 *  sortBy		: Sort by this column name
	 *  sortDirection	:	Asc/desc
	 * 
	 * @return The object of the retrieved result(s)
	 */
	function ReadSalts($options = array())
	{
		// Set all where clauses (if given)
		if(isset($options['id']))
			$this->db->where('id', $options['id']);

		if(isset($options['name']))
			$this->db->where('name', $options['name']);

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
		$query = $this->db->get("salts");
		
		// Check if only the count is required
		if(isset($options['count']) && $options['count']) return $query->num_rows(); 	
		
		// Return - first the unique column results
		if(isset($options['id']) || isset($options['name']))
			return $query->row(0);
		
		return $query->result();
	}

	/**
	 * Updates a salts
	 * @param $options
	 * 	id			:	The id of the salts to update
	 *  name
	 *  status
	 *  
	 * @return	The number of rows affected.
	 */
	function UpdateSalts($options = array())
	{
		$flagAddressChanged = false;
		 
		// Check for required columns
		if(!_required(array('id'), $options)) return false;
		
		// Set the where condition
		$this->db->where('id', $options['id']);
		
		// Update the fields
		if(isset($options['name']))
			$this->db->set('name', $options['name']);

		// CR 29JUL2011: Tags functionality
		if(isset($options['tags']))
			$this->db->set('tags', $options['tags']);
		// CR 29JUL2011: Ends

		if(isset($options['status']))
			$this->db->set('status', $options['status']);
			
		// Update the database
		$this->db->update('salts');
		
		//return
		return $this->db->affected_rows();
	}
	
	/**
	 * Deletes a Salt
	 * @param $id			:	The id of the salts to update
	 *  
	 * @return	The number of rows affected.
	 */
	function DeleteSalt($id)
	{
		return($this->UpdateSalts(array('id' => $id, 'status' => 'Deleted')));
	}

 /**
   * Queries the database base on the AJAX param
   * @param $name     : The (partial) name of the salt entered in the input box
   *  
   * @return  The possible matches
   */
  function ajaxGetSalts($options = array()){
    // Set all where clauses (if given)
    $this->db->where('name like', $options['name'].'%');
    $this->db->where('status !=', 'Deleted');
    
    // Run the query
    $query = $this->db->get("salts");
    
    return $query->result();
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
  function FindSalts($options = array())
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
    $query = $this->db->get("salts");
    
    // Check if only the count is required
    if(isset($options['count']) && $options['count']) return $query->num_rows();  
    
    return $query->result();
  }
  
 	function FindOrCreateSaltByName($name){
 		$salt = $this->ReadSalts(array('name'=>$name));
		
		// Find if salt exists, else create recors
		if($salt){
			$saltID = $salt->id;
		}
		else{
			$saltID = $this->CreateSalt(array('name'=>$name));
		}

		return $saltID;
 	}
}