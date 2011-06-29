<?php
/** 
 * tags.php
 * Description	: CRUD and other operations for a tag implementation
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Jun 29, 2011
 */
class Tags extends Model 
{
	// CRUD methods
	/**
	 * 
	 * To insert tags into database...
	 * @param $options array with info
	 *  name
	 *  frequency
	 *  @return the insert id
	 */
	function CreateTag($options = array())
	{		
    // Check for mandatory columns
		if(!_required(array('name'), $options)) return false;
		
		// Run the insert query
		$this->db->insert('tbl_tag', $options);
		
		// Return the generated id
		return $this->db->insert_id();
	}
	
	/**
	 * Reads the users provided the details
	 * @param $options (array)
	 * 	id			: Select by this id
	 *  name
	 *  limit		: Limit these namy results
	 *  offset		: Start showing results from this offset onwards
	 *  sortBy		: Sort by this column name
	 *  sortDirection	:	Asc/desc
	 * 
	 * @return The object of the retrieved result(s)
	 */
	function ReadTags($options = array())
	{
		// Set all where clauses (if given)
		if(isset($options['id']))
			$this->db->where('id', $options['id']);

		if(isset($options['name']))
			$this->db->where('name', $options['name']);

		// Set the limits
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'], $options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);
			
		// Sorting
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'], $options['sortDirection']);
			
		// Run the query
		$query = $this->db->get("tbl_tag");
		
		// Check if only the count is required
		if(isset($options['count']) && $options['count']) return $query->num_rows(); 	
		
		// Return - first the unique column results
		if(isset($options['id']))
			return $query->row(0);
		
		return $query->result();
	}

	/**
	 * Updates a tbl_tag
	 * @param $options
	 *  name		:	The name of the tbl_tag to update (name cannot be updated)
	 *  frequency
	 * @return	The number of rows affected.
	 */
	function UpdateTags($options = array())
	{
		// Check for required columns (will be the name)
		if(!_required(array('name'), $options)) return false;
		
		// Set the where condition
		$this->db->where('name', $options['name']);
		
		// Update the fields
		if(isset($options['frequency']))
			$this->db->set('frequency', $options['frequency']);

		// Update the database
		$this->db->update('tbl_tag');
		
		//return
		return $this->db->affected_rows();
	}
	
	/**
	 * Deletes a Tag
	 * @param $name			:	The name of the tbl_tag to update
	 *  
	 * @return	The number of rows affected.
	 */
	function DeleteTag($name)
	{
		// Set the where condition
		$this->db->where('name', $name);
		// Delete from the database
		$this->db->delete('tbl_tag');
		
		return $this->db->affected_rows();
		
		//return($this->UpdateTags(array('name' => $name, 'status' => 'Deleted')));
	}

	/**
	 * Deletes all empty tags ( with frequency <=0)
	 */
	function DeleteEmptyTags()
	{
		// Set the where condition
		$this->db->where('frequency <= 0');
		// Delete from the database
		$this->db->delete('tbl_tag');
		
		return $this->db->affected_rows();
	}




// USER SEPCIFIC FUNCTIONS	

  /**
   * Queries the database base on the AJAX param
   * @param $name     : The (partial) name of the chain/banner group entered in the input box
   *  
   * @return  The possible matches
   */
	function ajaxGetTags($options = array()){
	    // Set all where clauses (if given)
	    $this->db->where('name like', $options['name'].'%');
	    
	    // Run the query
	    $query = $this->db->get("tbl_tag");
	    
	    return $query->result();
	}
  
	
	/**
	 * Finds if the given tag exists in the system
	 */
	function TagExists($name){
		// Find if the tag exists
		return ($this->ReadTags(array('name'=>$name, 'count' => true)) == 1); 
	}
	
	/**
	 * Increments the counter of the given tag
	 */
	function IncrementFrequency($name){
		// UPDATE tbl_tag SET frequency=frequency+1 WHERE name='test' 
		// Set the where condition
		$this->db->where('name', $name);
		
		// Set condition
		$this->db->set('frequency', 'frequency+1', FALSE);

		// Update the database
		$this->db->update('tbl_tag');
		
		//return
		return $this->db->affected_rows();	
	}
	
	/**
	 * Decrements the counter of the given tag
	 */
	function DecrementFrequency($name){
		// UPDATE tbl_tag SET frequency=frequency-1 WHERE name='test' 
		// Set the where condition
		$this->db->where('name', $name);
		
		// Set condition
		$this->db->set('frequency', 'frequency-1', FALSE);

		// Update the database
		$this->db->update('tbl_tag');
		
		//return
		return $this->db->affected_rows();	
	}

	/**
	 * Updates the frequencies based on old and new tags
	 */
	function updateFrequency($oldTags,$newTags)
	{
		// Convert the old and new tags to arrays
		$oldTags = _string2array($oldTags);
		$newTags = _string2array($newTags);
		
		// Find the new tags which are added and call the addTags() to update their frequency
		// new tags added = $newTags-$oldTags
		$this->addTags(array_values(array_diff($newTags, $oldTags)));
		
		// Find the tags being deleted and call the removeTags() to decrement their frequency
		// Tags Deleted = ($oldTags - $newTags)
		$this->removeTags(array_values(array_diff($oldTags, $newTags)));
	} 
	
	/**
	 * This function updates the frequency of the tags provided (new tags). 
	 * If a tag name doesnt exists in the database, it is added with frequency of 1 
	 */
	function addTags($tags)
	{
		// Loop through all the tags one by one
		foreach($tags as $name)
		{
			if(!$this->TagExists($name))
			{
				// This is a new record, create it
				$this->CreateTag(array('name'=>$name));
			}
			else{
				// Just update the frequency
				$this->IncrementFrequency($name);
			}
		}
	}
	
	/**
	 * This function decrements the tag.frequency counter for the tags removed
	 * If the counter falls below 1 (<=0),. those records are deleted
	 */
	function removeTags($tags)
	{
		// Loop through all the tags one by one
		foreach($tags as $name)
		{
			// Just decrement the frequency
			$this->DecrementFrequency($name);
		}
		
		// All the records with zero or less frequency need to be deleted
		$this->DeleteEmptyTags();
		
	}  
 }