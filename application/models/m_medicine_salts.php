<?php
/** 
 * m_medicine_salts.php
 * Description	: CRUD and other operations for medicine_salt
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
class M_medicine_salts extends Model 
{
	// CRUD methods
	/**
	 * 
	 * To insert date into database...
	 * @param $options array with info
	 *  medicine_id
	 *  salt_id
	 *  dosage
	 *  @return the insert id
	 */
	function CreateMedicine_salt($options = array())
	{
		// Check for mandatory columns
		if(!_required(array('medicine_id', 'salt_id', 'dosage'), $options)) return false;
		
		// Default columns
		$options = _default(array('status' => 'Active', 'created_at' => date('Y-m-d h:i:s')), $options);

		// Run the insert query
		$this->db->insert('medicine_salt', $options);
		
		// Return the generated id
		return $this->db->insert_id();
	}
	
	/**
	 * Reads the users provided the details
	 * @param $options (array)
	 * 	id			: Select by this id
	 *  medicine_id
	 *  salt_id
	 *  dosage
	 *  status		: Select by this status
	 *  limit		: Limit these namy results
	 *  offset		: Start showing results from this offset onwards
	 *  sortBy		: Sort by this column name
	 *  sortDirection	:	Asc/desc
	 * 
	 * @return The object of the retrieved result(s)
	 */
	function ReadMedicine_salts($options = array())
	{
		// Set all where clauses (if given)
		if(isset($options['id']))
			$this->db->where('id', $options['id']);

		if(isset($options['medicine_id']))
			$this->db->where('medicine_id', $options['medicine_id']);

		if(isset($options['salt_id']))
			$this->db->where('salt_id', $options['salt_id']);

    if(isset($options['dosage']))
      $this->db->where('dosage', $options['dosage']);
			
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
		$query = $this->db->get("medicine_salt");
		
		// Check if only the count is required
		if(isset($options['count']) && $options['count']) return $query->num_rows(); 	
		
		// Return - first the unique column results
		if(isset($options['id']))
			return $query->row(0);
		
		return $query->result();
	}

	/**
	 * Deletes a Medicine_type
	 * @param $id			:	The id of the medicine_salts to update
	 *  
	 * @return	The number of rows affected.
	 */
	function DeleteMedicine_salt($id)
	{
		$this->db->delete('medicine_salt', array('id' => $id));
		
/*		 
	    // Set the where condition
	    $this->db->where('id', $id);
	    
	    // Set the value
	    $this->db->set('status', 'Deleted');
	      
	    // Update the database
	    $this->db->update('medicine_salt');
*/	    
	    //return
	    return $this->db->affected_rows();

  	}

	/**
	 * Updates a medicines salt information
	 * @param $options
	 * 	id			:	The id of the medicines_salt record to update
	 *  dosage
	 *  
	 * @return	The number of rows affected.
	 */
	function UpdateMedicine_salt($options = array())
	{
		// Check for required columns
		if(!_required(array('id', 'dosage'), $options)) return false;
		
		// Set the where condition
		$this->db->where('id', $options['id']);
      	$this->db->set('dosage', $options['dosage']);
		
//$this->db->_compile_select();  	
		// Update the database
		$this->db->update('medicine_salt');
//echo " ".$this->db->last_query();  
		//return
		return $this->db->affected_rows();
	}
	
	function FindSaltsForMedicine($id){
		$query = $this->db->query( 'SELECT ms.id, ms.medicine_id, ms.salt_id, s.name AS salt_name, ms.dosage
																FROM medicine_salt ms, salts s
																WHERE ms.salt_id = s.id
																AND ms.status != \'Deleted\'
																AND medicine_id = '.$id);
		
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
  function FindMedicine_salts($options = array())
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
    $query = $this->db->get("medicine_salt");
    
    // Check if only the count is required
    if(isset($options['count']) && $options['count']) return $query->num_rows();  
    
    return $query->result();
  }
}