<?php
/** 
 * m_medicines.php
 * Description	: CRUD and other operations for medicines
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
class M_medicines extends Model 
{
	// CRUD methods
	/**
	 * 
	 * To insert users into database...
	 * @param $options array with info
	 *  name
	 *  quantity
	 *  medicine_type_id
	 *  company_name	 
	 * @return the insert id
	 */
	function CreateMedicine($options = array())
	{
		// Check for mandatory columns
		if(!_required(array('name', 'medicine_type_id'), $options)) return false;
		
		// Default columns
		$options = _default(array('status' => 'Active', 'created_at' => date('Y-m-d h:i:s')), $options);
		
		// Run the insert query
		$this->db->insert('medicines', $options);
		
		// Return the generated id
		return $this->db->insert_id();
	}
	
	/**
	 * Reads the users provided the details
	 * @param $options (array)
	 * 	id			: Select by this id
	 *  name
   *  quantity
   *  dosage
	 *  medicine_type_id
	 *  company_name	 
	 *  status		: Select by this status
	 *  limit		  : Limit these namy results
	 *  offset		: Start showing results from this offset onwards
	 *  sortBy		: Sort by this column name
	 *  sortDirection	:	Asc/desc
	 * 
	 * @return The object of the retrieved result(s)
	 */
	function ReadMedicines($options = array())
	{
		// Set all where clauses (if given)
		if(isset($options['id']))
			$this->db->where('id', $options['id']);

		if(isset($options['name']))
			$this->db->where('name', $options['name']);

		if(isset($options['quantity']))
			$this->db->where('quantity', $options['quantity']);

    if(isset($options['dosage']))
      $this->db->where('dosage', $options['dosage']);
			
    if(isset($options['medicine_type_id']))
			$this->db->where('medicine_type_id', $options['medicine_type_id']);
			
		if(isset($options['company_name']))
			$this->db->where('company_name', $options['company_name']);
			
    if(isset($options['notes']))
      $this->db->where('notes', $options['notes']);
			
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
		$query = $this->db->get("medicines");
		
		// Check if only the count is required
		if(isset($options['count']) && $options['count']) return $query->num_rows(); 	
		
		// Return - first the unique column results
		if(isset($options['id']))
			return $query->row(0);
		
		return $query->result();
	}

	/**
	 * Updates a medicines
	 * @param $options
	 * 	id			:	The id of the medicines to update
	 *  name
	 *  quantity
	 *  medicine_type_id
	 *  company_name	 
	 *  status
	 *  
	 * @return	The number of rows affected.
	 */
	function UpdateMedicines($options = array())
	{
		$flagAddressChanged = false;
		 
		// Check for required columns
		if(!_required(array('id'), $options)) return false;
		
		// Set the where condition
		$this->db->where('id', $options['id']);
		
		// Update the fields
		if(isset($options['name']))
			$this->db->set('name', $options['name']);

		if(isset($options['quantity']))
			$this->db->set('quantity', $options['quantity']);

    if(isset($options['dosage']))
      $this->db->set('dosage', $options['dosage']);
			
		if(isset($options['medicine_type_id']))
			$this->db->set('medicine_type_id', $options['medicine_type_id']);
			
		if(isset($options['company_name']))
			$this->db->set('company_name', $options['company_name']);

    if(isset($options['notes']))
      $this->db->set('notes', $options['notes']);
			
		// CR 29JUL2011: Tags functionality
		if(isset($options['tags']))
			$this->db->set('tags', $options['tags']);
		// CR 29JUL2011: Ends


		if(isset($options['status']))
			$this->db->set('status', $options['status']);
			
		// Update the database
		$this->db->update('medicines');
		
		//return
		return $this->db->affected_rows();
	}
	
	/**
	 * Deletes a Medicine
	 * @param $id			:	The id of the medicines to update
	 *  
	 * @return	The number of rows affected.
	 */
	function DeleteMedicine($id)
	{
		return($this->UpdateMedicines(array('id' => $id, 'status' => 'Deleted')));
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
	function FindMedicines($options = array())
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
		$query = $this->db->get("medicines");
		
		// Check if only the count is required
		if(isset($options['count']) && $options['count']) return $query->num_rows(); 	
		
		return $query->result();
	}
	
}