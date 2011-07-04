<?php
/** 
 * m_medicines_import.php
 * Description	: CRUD and other operations for medicines
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
class M_medicine_import extends Model 
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
		if(!_required(array('name'), $options)) return false;
		
		// Default columns
		$options = _default(array('status' => 'Active', 'source' => 'Auto Import', 'created_at' => date('Y-m-d h:i:s')), $options);
		
		// Run the insert query
		$this->db->insert('medicines', $options);
		
		// Return the generated id
		return $this->db->insert_id();
	}
		
}