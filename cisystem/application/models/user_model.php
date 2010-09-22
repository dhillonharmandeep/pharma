<?php
/**
 * User Model - Inserts, Updates, Selects from the User Model  
 * Created on Sep 21, 2010
 *
 * @package Users
 */
 class User_model extends Model
 {
 	/** Utililty Methods */
 	
 	/**
 	 * _required is a utility method which checks if the required argument have been provided
 	 * 
 	 * @param array $required - the name of the required variables
 	 * @param array $data - the data in which to check 
 	 * 
 	 * @return bool false if any of the required variables is empty
 	 */
 	function _required($required, $data)
 	{
 		foreach ($required as $field)
 			if(!isset($data[$field])) return false;
 			
 		return true;
 	}
 	
 	/**
 	 * _defaults checks if the value of a given variable is present, else adds the default value
 	 * 
 	 * @param array $defaults - the default key->value pairs
 	 * @param array $options - the actual data 
 	 * 
 	 * @return array the default value included if not present
 	 */
 	function _default($defaults, $options)
 	{
 		return array_merge($defaults, $options); 
 	} 
 	/** User Methods */
 	
 	/**
 	 * AddUser method creats a record in the user's table
 	 * 
 	 * Option: Values
 	 * --------------
 	 * name
 	 * email
 	 * password
 	 * status
 	 * 
 	 * @param array $options
 	 * @return int return_id()
 	 */
 	function AddUser($options = array())
 	{
 		// Check for all the required values
 		if(!$this->_required(array('name', 'email', 'password'), $options) )
 			return false;
 		
 		// Add the default value (if not provided) for status field
 		$options = $this->_default(array('status', 'active'), $options);
 		
 		// Insert into the database
 		$this->db->insert('users', $options);
 		
 		// return the id
 		return $this->db->insert_id();
 	}
 	
 	/**
 	 * UpdateUser - updates the user table for the id specified
 	 * 
 	 * Option: Values
 	 * --------------
 	 * id		required
 	 * name
 	 * email
 	 * password
 	 * 
 	 * @param array $options
 	 * @return int affected_rows()
 	 */	
 	function UpdateUser($options = array())
 	{
 		// Validate if the required entries are provided
 		if (! $this->_required(array('id'), $options))
 			return false;
 			
 		// Set the name, email password
 		if (isset($options['name']))
 			$this->db->set('name', $options['name']);
 		if (isset($options['email']))
 			$this->db->set('email', $options['email']);
 		if (isset($options['password']))
 			$this->db->set('password', md5($options['password']));
 		if (isset($options['status']))
 			$this->db->set('status', $options['status']);
 			
 		// update the database
 		$this->db->update('users', $options);
 		
 		// return the affected row count
 		return $this->db->affected_rows();
 	}
 	
 	/**
 	 * GetUsers - display the information for the user param provided (if any)
 	 * 
 	 * Options: Values
 	 * ---------------
 	 * id
 	 * name
 	 * email
 	 * password
 	 * limit			limit the returned records
 	 * offset			bypass this many records
 	 * sortBy			sort results by this field
 	 * sortDirection	asc/desc
 	 * 
 	 * Returned Object
 	 * ---------------
 	 * id
 	 * email
 	 * name
 	 * password
 	 * 
 	 * @param array $options
 	 * @return array $resultset
 	 */	
 	function GetUsers($options = array())
 	{
 		// Prepare the where clause
 		if(isset($options['id']))
 			$this->db->where('id', $options['id']);
 		if(isset($options['name']))
 			$this->db->where('name', $options['name']);
 		if(isset($options['email']))
 			$this->db->where('email', $options['email']);
 		if(isset($options['password']))
 			$this->db->where('password', $options['password']);
 		if (isset($options['status']))
 			$this->db->where('status', $options['status']);
 		
 		// Limit/offset
 		if(isset($options['limit']) && isset($options['offset']))
 			$this->db->limit($options['limit'], $options['offset']);
 		elseif(isset($options['limit']))
 			$this->db->limit($options['limit']);
 		
 		// sort
 		if (isset($options['sortBy']) && isset($options['sortDirection']))
 			$this->db->order_by($options['sortBy'], $options['sortDirection']);
 		
 		// Run the query
 		$query = $this->db->get('users');
 		
 		// return 1 row for unique columns
 		if(isset($options['id']) || isset($options['email']))
 			return $query->row(0);
 		
 		// else return the complete resultset
 		return $query->result();
 	}
 }
?>
