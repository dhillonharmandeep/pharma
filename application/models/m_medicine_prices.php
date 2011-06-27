<?php
/** 
 * m_medicine_prices.php
 * Description	: CRUD and other operations for a medicine_prices
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */
class M_medicine_prices extends Model 
{
	// CRUD methods
	/**
	 * 
	 * To insert users into database...
	 * @param $options array with info
	 *  medicine_id
	 *  store_id
	 *  chainbg_id
	 *  price
	 *  is_store_price
	 *  @return the insert id
	 */
	function CreateMedicine_price($options = array())
	{		
    	// Check for mandatory columns
		if(!_required(array('medicine_id', 'price'), $options)) return false;
		
		// One of store_id and chainbg_id need to be present
		if(!_required(array('store_id'), $options) && !_required(array('chainbg_id'), $options)) return false;
		
		// Default columns
		$options = _default(array('status' => 'Active', 'created_at' => date('Y-m-d h:i:s')), $options);

		// If the store _id is present, the efault value for is_store_price is Y 
		if (isset($options['store_id']))
			$options = _default(array('is_store_price' => 'Y'), $options);
		
		// Run the insert query
		$this->db->insert('medicine_prices', $options);
		
		// Return the generated id
		return $this->db->insert_id();
	}
	
	/**
	 * Reads the users provided the details
	 * @param $options (array)
	 * 	id			: Select by this id
	 *  medicine_id	: Select by this medicine_id
	 *  store_id	: Select by this store_id 
	 *  chainbg_id	: Select by this chainbg_id
	 *  price		: Select by this price
	 *  is_store_price 
	 *  status		: Select by this status
	 *  limit		: Limit these namy results
	 *  offset		: Start showing results from this offset onwards
	 *  sortBy		: Sort by this column name
	 *  sortDirection	:	Asc/desc
	 * 
	 * @return The object of the retrieved result(s)
	 */
	function ReadMedicine_prices($options = array())
	{
		// Set all where clauses (if given)
		if(isset($options['id']))
			$this->db->where('p.id', $options['id']);

		if(isset($options['medicine_id']))
			$this->db->where('p.medicine_id', $options['medicine_id']);

		if(isset($options['store_id']))
			$this->db->where('p.store_id', $options['store_id']);

		if(isset($options['chainbg_id']))
			$this->db->where('p.chainbg_id', $options['chainbg_id']);

		if(isset($options['price']))
			$this->db->where('p.price', $options['price']);

		if(isset($options['is_store_price']))
			$this->db->where('p.is_store_price', $options['is_store_price']);

		// TODO: status of all 3 tables?	
/*		if(isset($options['status']))
			$this->db->where('medicine_prices.status', $options['status']);
		else 
			$this->db->where('medicine_prices.status !=', 'Deleted');
*/
		// Set the limits
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'], $options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);
			
		// Sorting
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'], $options['sortDirection']);

		$this->db->select('p.*, m.name as medicine_name, s.name as store_name, c.name as chainbg_name');
    $this->db->from('medicine_prices p');
    $this->db->join('medicines m', 'm.id = p.medicine_id');
    $this->db->join('stores s', 's.id = p.store_id', 'left');
    $this->db->join('chainbgs c', 'c.id = p.chainbg_id', 'left');
    
		// Run the query
//		$query = $this->db->get("medicine_prices");
		$query = $this->db->get();
		
		// Check if only the count is required
		if(isset($options['count']) && $options['count']) return $query->num_rows(); 	
		
		// Return - first the unique column results
		if(isset($options['id']))
			return $query->row(0);
		
		return $query->result();
	}

  function ReadAllPrices($options = array())
  {
  	$sql = "select IF(p.is_store_price = 'Y', p.id, 'NA') as store_price_id, IF(p.is_store_price <> 'Y', p.id, p2.id) as chainbg_price_id, 
						p.medicine_id, m.name as medicine_name, p.is_store_price,
						IFNULL(s.name,'NA') as store_name, p.store_id, IF(p.is_store_price = 'Y', p.price, 'NA') as store_price,
						pc.name as chainbg_name, IF(p.is_store_price <> 'Y', p.chainbg_id, s.chainbg_id) as chainbg_id, IF(p.is_store_price <> 'Y', p.price, IFNULL(p2.price,'NA')) as chainbg_price
						from medicine_prices p
						left join stores s ON p.store_id = s.id
						left join medicines m on p.medicine_id = m.id
						left join chainbgs pc on s.chainbg_id = pc.id
						left join medicine_prices p2 on p.medicine_id = p2.medicine_id and p.is_store_price <> p2.is_store_price
						where p.status = 'ACTIVE'
						and p.is_store_price = 'Y'";
  	
  	$query = $this->db->query($sql);
    
    // Check if only the count is required
    if(isset($options['count']) && $options['count']) return $query->num_rows();  
    
    // Return - first the unique column results
    if(isset($options['id']))
      return $query->row(0);
    
    return $query->result();
  }
	/**
	 * Updates a medicine_prices
	 * @param $options
	 * 	id			:	The id of the medicine_prices to update
	 *  price
	 *  is_store_price 
	 *  status
	 *  
	 * @return	The number of rows affected.
	 */
	function UpdateMedicine_prices($options = array())
	{
		// Check for required columns
		if(!_required(array('id'), $options)) return false;
		
		// Set the where condition
		$this->db->where('id', $options['id']);
		
		// Update the fields
		if(isset($options['price']))
			$this->db->set('price', $options['price']);

		if(isset($options['is_store_price']))
			$this->db->set('is_store_price', $options['is_store_price']);
			
		if(isset($options['status']))
			$this->db->set('status', $options['status']);
			
		// Update the database
		$this->db->update('medicine_prices');
		
		//return
		return $this->db->affected_rows();
	}
	
	/**
	 * Deletes a Medicine_price
	 * @param $id			:	The id of the medicine_prices to update
	 *  
	 * @return	The number of rows affected.
	 */
	function DeleteMedicine_price($id)
	{
		return($this->UpdateMedicine_prices(array('id' => $id, 'status' => 'Deleted')));
	}

 }