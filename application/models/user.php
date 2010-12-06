<?php
class User extends Model 
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

	private function _mutate($pass)
	{
		return md5("$*cR@&".$pass);
	}
	
	// Authentication methods
	/**
	 * Sets the user information to the sessions
	 * @param $options
	 *  username
	 *  password
	 * @return bool
	 */
	function Login($options = array())
	{
		// Check of both the username and password are provided
		if(!$this->_required(array('username', 'password'), $options)) return false;
		
		// Get this user
		$user = $this->GetUsers(array('username' => $options['username'], 'password' => $options['password']));

		// check if any user was not returned - try for email as well
		if(!$user)
			$user = $this->GetUsers(array('email' => $options['username'], 'password' => $options['password']));

		// check if any user was not returned
		if(!$user) return false;
		
		// We have the user, so set the session variables
		$this->session->set_userdata('id', $user->id);
		$this->session->set_userdata('username', $user->username);
		$this->session->set_userdata('email', $user->email);
		$this->session->set_userdata('firstname', $user->firstname);
		$this->session->set_userdata('lastname', $user->lastname);
		$this->session->set_userdata('type', $user->type);
				
		// If this code is reached, everything was a succes
		return true;
	}
	
	function Secure($options = array())
	{
		// Check if the user type is given as argument
		if(!$this->_required(array('type'), $options)) return false;
		
		// Find the user type from the sessions
		$userType = $this->session->userdata('type');
		
		// Check if the session user type matches the user type(s) passed to this function
		if(is_array($options['type']))
		{
			// Multiple user type passed as argument - loop through the array
			foreach ($options['type'] as $optionUserType)
			{
				if ($userType == $optionUserType) return true;
			}
		}
		else
		{
			// Single user type passed as argument - direct comparison
			return ($userType == $options['type']);
		}
	}
	// User methods
	/**
	 * 
	 * To insert users into database...
	 * @param $options array with info
	 *  username
	 *  password
	 *  firstname
	 *  lastname
	 *  email
	 *  type
	 *  status
	 * @return the insert id
	 */
	function AddUser($options = array())
	{
//		print_r($options);
//		die();
		// Check for mandatory columns
		if(!$this->_required(array('email','password'), $options)) return false;
		
		// Mutate the password
		$options['password'] = $this->_mutate($options['password']);
		
		// Default columns
		$options = $this->_default(array('status' => 'Inactive', 'type' => 'Admin', 'created_at' => date('Y-m-d h:i:s')), $options);
		
		// Run the insert query
		$this->db->insert('users', $options);
		
		// Return the generated id
		return $this->db->insert_id();
	}
	
	/**
	 * 
	 * To insert register a user into database and send them verification email
	 * @param $options array with info
	 *  username
	 *  password
	 *  firstname
	 *  lastname
	 *  email
	 *  type
	 *  status
	 * @return the insert id
	 */
	function RegisterUser($options = array())
	{
		// generate a random 25 char string for varification purpose
		$vcode = substr(md5(uniqid(rand(), true)), 0, 25);

		// Add the vcode column using this string
		$options = $this->_default(array('vcode' => $vcode), $options);

		// use the AddUser function to add this user to the database
		$newid = $this->AddUser($options);
		
		// check for success
		if($newid){
			// generate the link
			$link = base_url()."admin/verify/".$options['username']."/".$vcode;
			
			// sucess - send the email
			$this->load->library('email');
			$config['mailtype'] = 'html';
			$this->email->initialize($config);
			
			// set email class parameters
			$this->email->from('do-not-reply@pharmaseek.com.au','Pharmaseek Automailer');
			$this->email->to($options['email']);
			$this->email->subject('Pharmaseek: Registration');
			$this->email->message('<h1>Registeration</h1><p>Click in this <a href="'.$link.'">link to verify</a> your email.</p>');
			if(!$this->email->send())echo "error sending email!";
			
			// Return the generated id
			return $newid;
		}
		else return false;
	}
	
	/**
	 * 
	 * To verify a newly registered user by comparing the userid and vcode fields
	 * @param $options array with info
	 * @return true if successfuly verified, false otherwise
	 */
	function VerifyUser($username, $vcode)
	{
		// Find if there is a user with the details provided
		if($user = $this->GetUsers(array('username' => $username, 'vcode' => $vcode)))
		{
			return ($this->UpdateUser(array('id' => $user->id,'username' => $username, 'status' => 'Active')) == 1 );
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * Updates a user
	 * @param $options
	 * 	id			:	The id of the user to update
	 *  username	: 	The new username
	 * 	email		:	The changed email
	 * 	password	:	The changed password
	 *  firstname	:	The changed firstname
	 *  lastname	:	The changed lastname
	 *  status		: 	The changed user status
	 *  
	 * @return	The number of rows affected.
	 */
	function UpdateUser($options = array())
	{
		// Check for required columns
		if(!$this->_required(array('id'), $options)) return false;
		
		// Set the where condition
		$this->db->where('id', $options['id']);
		
		// Update the fields
		if(isset($options['email']))
			$this->db->set('email', $options['email']);

		if(isset($options['username']))
			$this->db->set('username', $options['username']);
			
		if(isset($options['password']))
			$this->db->set('password', $this->_mutate($options['password']));
			
		if(isset($options['firstname']))
			$this->db->set('firstname', $options['firstname']);
	
		if(isset($options['lastname']))
			$this->db->set('lastname', $options['lastname']);

		if(isset($options['type']))
			$this->db->set('type', $options['type']);
			
		if(isset($options['status']))
			$this->db->set('status', $options['status']);
			
		// Update the database
		$this->db->update('users');
		
		//return
		return $this->db->affected_rows();
	}
	
	/**
	 * Gets the users provided the details
	 * @param $options (array)
	 * 	id			:	Select by this id
	 * 	email		:	Select by this email
	 *  firstname	:	Select by this firstname
	 *  lastname	: 	Select by this lastname
	 *  status		: 	Select by this status
	 *  limit		:	Limit these many results
	 *  offset		:	Start showing results from this offset onwards
	 *  sortBy		: 	Sort by this column name
	 *  sortDirection	:	Asc/desc
	 * 
	 * @return The object of the retrieved result(s)
	 */
	function GetUsers($options = array())
	{
		if(isset($options['id']))
			$this->db->where('id', $options['id']);

		if(isset($options['email']))
			$this->db->where('email', $options['email']);

		if(isset($options['password']))
			$this->db->where('password', $this->_mutate($options['password']));
			
		if(isset($options['username']))
			$this->db->where('username', $options['username']);
			
		if(isset($options['firstname']))
			$this->db->where('firstname', $options['firstname']);
	
		if(isset($options['lastname']))
			$this->db->where('lastname', $options['lastname']);
		
		if(isset($options['type']))
			$this->db->where('type', $options['type']);
			
		if(isset($options['vcode']))
			$this->db->where('vcode', $options['vcode']);
			
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
		$query = $this->db->get("users");

		// Check if only the count is required
		if(isset($options['count']) && $options['count']) return $query->num_rows(); 	
		
		// Return - first the unique column results
		if(isset($options['id']) || isset($options['email']) || isset($options['username']))
			return $query->row(0);
		
		return $query->result();
	}
}