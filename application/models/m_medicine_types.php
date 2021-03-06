<?php
/** 
 * m_medicine_types.php
 * Description	: CRUD and other operations for medicine_types
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
class M_medicine_types extends Model 
{
	// CRUD methods
	/**
	 * 
	 * To insert users into database...
	 * @param $options array with info
	 *  name
	 *  value
	 *  @return the insert id
	 */
	function CreateMedicine_type($options = array())
	{
		// Check for mandatory columns
		if(!_required(array('name'), $options)) return false;
		
		// Default columns
		$options = _default(array('value' => $options['name'], 'status' => 'Active', 'created_at' => date('Y-m-d h:i:s')), $options);

		// Run the insert query
		$this->db->insert('medicine_types', $options);
		
		// Return the generated id
		return $this->db->insert_id();
	}
	
	/**
	 * Reads the users provided the details
	 * @param $options (array)
	 * 	id			: Select by this id
	 *  name
	 *  value
	 *  status		: Select by this status
	 *  limit		: Limit these namy results
	 *  offset		: Start showing results from this offset onwards
	 *  sortBy		: Sort by this column name
	 *  sortDirection	:	Asc/desc
	 * 
	 * @return The object of the retrieved result(s)
	 */
	function ReadMedicine_types($options = array())
	{
		// Set all where clauses (if given)
		if(isset($options['id']))
			$this->db->where('id', $options['id']);

		if(isset($options['name']))
			$this->db->where('name', $options['name']);

		if(isset($options['value']))
			$this->db->where('value', $options['value']);
			
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
		$query = $this->db->get("medicine_types");
		
		// Check if only the count is required
		if(isset($options['count']) && $options['count']) return $query->num_rows(); 	
		
		// Return - first the unique column results
		if(isset($options['id']))
			return $query->row(0);
		
		return $query->result();
	}

	/**
	 * Updates a medicine_types
	 * @param $options
	 * 	id			:	The id of the medicine_types to update
	 *  name
	 *  value
	 *  status
	 *  
	 * @return	The number of rows affected.
	 */
	function UpdateMedicine_types($options = array())
	{
		// Check for required columns
		if(!_required(array('id'), $options)) return false;

		// Set the where condition
		$this->db->where('id', $options['id']);
		
		// Update the fields
		if(isset($options['name']))
		{
			$this->db->set('name', $options['name']);
			$this->db->set('value', $options['name']);
		}

		if(isset($options['value']))
			$this->db->set('value', $options['value']);

		// CR 29JUL2011: Tags functionality
		if(isset($options['tags']))
			$this->db->set('tags', $options['tags']);
		// CR 29JUL2011: Ends
			
		if(isset($options['status']))
			$this->db->set('status', $options['status']);
			
		// Update the database
		$this->db->update('medicine_types');
		
		//return
		return $this->db->affected_rows();
	}
	
	/**
	 * Deletes a Medicine_type
	 * @param $id			:	The id of the medicine_types to update
	 *  
	 * @return	The number of rows affected.
	 */
	function DeleteMedicine_type($id)
	{
		return($this->UpdateMedicine_types(array('id' => $id, 'status' => 'Deleted')));
	}

  /**
   * Queries the database base on the AJAX param
   * @param $name     : The (partial) name of the medicine type entered in the input box
   *  
   * @return  The possible matches
   */
  function ajaxGetMedicineTypes($options = array()){
    // Set all where clauses (if given)
    $this->db->where('name like', $options['name'].'%');
    $this->db->where('status !=', 'Deleted');
    
    // Run the query
    $query = $this->db->get("medicine_types");
    
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
  function FindMedicine_types($options = array())
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
    $query = $this->db->get("medicine_types");
    
    // Check if only the count is required
    if(isset($options['count']) && $options['count']) return $query->num_rows();  
    
    return $query->result();
  }
}