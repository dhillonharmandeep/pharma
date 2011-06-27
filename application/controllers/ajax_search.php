<?php

class Ajax_search extends Controller {

	function Ajax_search()
	{
		parent::Controller();	
	}
	function index(){
		$this->load->view('dashboard/test');
	}

  /**
   * UNIVERSAL SEARCH FUNCTIONALITY
   * The method which searches the possible matches in the database for all modules
   * It generates the json data which is used by ui dropdown.
   * 
   * Mar 8, 2011
   */
  function all(){
    $data['response'] = 'false'; //Set default response

    $data['message'] = array();
    $data['message'] = array_merge($data['message'], $this->chainbg(true));
    $data['message'] = array_merge($data['message'], $this->medicine(true));
    $data['message'] = array_merge($data['message'], $this->medicine_type(true));
    $data['message'] = array_merge($data['message'], $this->salt(true));
    $data['message'] = array_merge($data['message'], $this->store(true));
        
    if (count($data['message'])>0) $data['response'] = 'true'; //Set default response

/*    print_r($data);
    echo "<hr/>";
    print_r($this->chainbg(true));
    echo "<hr/>";
*/    //return the data
    echo json_encode($data);
  }     

  /**
   * The method which searches the possible matches in the database for: chainbg
   * It generates the json data which is used by ui dropdown.
   * 
   * Mar 8, 2011
   */
  function chainbg($onlydata = false){
    // process posted form data (the requested product)
    $keyword = $this->input->post('term');
    $data['response'] = 'false'; //Set default response
      
    // load the model
    $this->load->model('m_chainbgs');
  
    $query = $this->m_chainbgs->FindChainbgs(array('term' => $keyword, 'sortBy' => 'name', 'sortDirection' => 'ASC'));
    
      if( ! empty($query) )
    {
      $data['response'] = 'true'; //Set response
      $data['message'] = array(); //Create array
      foreach( $query as $row )
      {
        $data['message'][] = array( 'id'=> $row->id,
                      'label'=> $row->name, 
                      'value'=> $row->name,
                      'destination' => base_url().'chainbg/view/'.$row->id,
                      'icon' => 'chainbg.png');
      }
      if($onlydata) return $data['message']; 
    }
    elseif($onlydata) return array();
    
    //return the data
    echo json_encode($data);
  }     

  /**
   * The method which searches the possible matches in the database for: medicine_salts
   * It generates the json data which is used by ui dropdown.
   * 
   * Mar 8, 2011
   */
  function medicine_salt($onlydata = false){
    // process posted form data (the requested product)
    $keyword = $this->input->post('term');
    $data['response'] = 'false'; //Set default response
      
    // load the model
    $this->load->model('m_medicine_salts');
  
    $query = $this->m_medicine_salts->FindMedicine_salts(array('term' => $keyword, 'sortBy' => 'name', 'sortDirection' => 'ASC'));
    
      if( ! empty($query) )
    {
      $data['response'] = 'true'; //Set response
      $data['message'] = array(); //Create array
      foreach( $query as $row )
      {
        $data['message'][] = array( 'id'=>$row->id,
                      'label'=> $row->name, 
                      'value'=> $row->name,
                      'destination' => base_url().'salt/edit/'.$row->id,
                      'icon' => 'salt.png');
      }
      if($onlydata) return $data['message']; 
    }
    elseif($onlydata) return array();
    
    //return the data
    echo json_encode($data);
  }     

  /**
   * The method which searches the possible matches in the database for: medicine_types
   * It generates the json data which is used by ui dropdown.
   * 
   * Mar 8, 2011
   */
  function medicine_type($onlydata = false){
    // process posted form data (the requested product)
    $keyword = $this->input->post('term');
    $data['response'] = 'false'; //Set default response
      
    // load the model
    $this->load->model('m_medicine_types');
  
    $query = $this->m_medicine_types->FindMedicine_types(array('term' => $keyword, 'sortBy' => 'name', 'sortDirection' => 'ASC'));
    
      if( ! empty($query) )
    {
      $data['response'] = 'true'; //Set response
      $data['message'] = array(); //Create array
      foreach( $query as $row )
      {
        $data['message'][] = array( 'id'=>$row->id,
                      'label'=> $row->name, 
                      'value'=> $row->name,
                      'destination' => base_url().'mtype/edit/'.$row->id,
                      'icon' => 'mtype.png');
      }
      if($onlydata) return $data['message']; 
    }
    elseif($onlydata) return array();
    
    //return the data
    echo json_encode($data);
  }     
  
  /**
   * The method which searches the possible matches in the database for: medicines
   * It generates the json data which is used by ui dropdown.
   * 
   * Mar 8, 2011
   */
  function medicine($onlydata = false){
    // process posted form data (the requested product)
    $keyword = $this->input->post('term');
    $data['response'] = 'false'; //Set default response
      
    // load the model
    $this->load->model('m_medicines');
  
    $query = $this->m_medicines->FindMedicines(array('term' => $keyword, 'sortBy' => 'name', 'sortDirection' => 'ASC'));
    
    if( ! empty($query) )
    {
      $data['response'] = 'true'; //Set response
      $data['message'] = array(); //Create array
      foreach( $query as $row )
      {
        $data['message'][] = array( 'id'=>$row->id,
                      'label'=> $row->name, 
                      'value'=> $row->name,
                      'destination' => base_url().'medicine/view/'.$row->id,
                      'icon' => 'medicine.png');
      }
      if($onlydata) return $data['message']; 
    }
    elseif($onlydata) return array();
    
    //return the data
    echo json_encode($data);
  }   

  /**
   * The method which searches the possible matches in the database for: salts
   * It generates the json data which is used by ui dropdown.
   * 
   * Mar 8, 2011
   */
  function salt($onlydata = false){
    // process posted form data (the requested product)
    $keyword = $this->input->post('term');
    $data['response'] = 'false'; //Set default response
      
    // load the model
    $this->load->model('m_salts');
  
    $query = $this->m_salts->FindSalts(array('term' => $keyword, 'sortBy' => 'name', 'sortDirection' => 'ASC'));
    
      if( ! empty($query) )
    {
      $data['response'] = 'true'; //Set response
      $data['message'] = array(); //Create array
      foreach( $query as $row )
      {
        $data['message'][] = array( 'id'=>$row->id,
                      'label'=> $row->name, 
                      'value'=> $row->name,
                      'destination' => base_url().'salt/edit/'.$row->id,
                      'icon' => 'salt.png');
      }
      if($onlydata) return $data['message']; 
    }
    elseif($onlydata) return array();
    
    //return the data
    echo json_encode($data);
  }     

  /**
   * The method which searches the possible matches in the database for: stores
   * It generates the json data which is used by ui dropdown.
   * 
   * Mar 8, 2011
   */
  function store($onlydata = false){
    // process posted form data (the requested product)
    $keyword = $this->input->post('term');
    $data['response'] = 'false'; //Set default response
      
    // load the model
    $this->load->model('m_stores');
  
    $query = $this->m_stores->FindStores(array('term' => $keyword, 'sortBy' => 'name', 'sortDirection' => 'ASC'));
    
    if( ! empty($query) )
    {
      $data['response'] = 'true'; //Set response
      $data['message'] = array(); //Create array
      foreach( $query as $row )
      {
        $data['message'][] = array( 'id'=>$row->id,
                      'label'=> $row->name, 
                      'value'=> $row->name,
                      'destination' => base_url().'store/view/'.$row->id,
                      'icon' => 'store.png');
      }
      if($onlydata) return $data['message']; 
    }
    elseif($onlydata) return array();
    
    //return the data
    echo json_encode($data);
  }     

  /**
   * The method which searches the possible matches in the database for: stores or chains or banner groups
   * It generates the json data which is used by ui dropdown.
   * 
   * Mar 8, 2011
   */
  function store_chainbg(){
    // process posted form data (the requested product)
    $keyword = $this->input->post('term');
    $data['response'] = 'false'; //Set default response
    $data['message'] = array(); //Create array
    
    // load the model
    $this->load->model('m_stores');
    $query = $this->m_stores->FindStores(array('term' => $keyword));
    
    if( ! empty($query) )
    {
      $data['response'] = 'true'; //Set response
      foreach( $query as $row )
      {
        $data['message'][] = array( 'id'=>$row->id,
                      'label'=> $row->name." [Store - ".$row->state."]", 
                      'value'=> $row->name,
                      'type' => "Store",
                      'icon' => 'store.png');
      }
    }

    $keyword = $this->input->post('term');
    $data['response'] = 'false'; //Set default response
  	
    // load the model
    $this->load->model('m_chainbgs');
    $query = $this->m_chainbgs->FindChainbgs(array('term' => $keyword));
    
    if( ! empty($query) )
    {
      $data['response'] = 'true'; //Set response
      
      foreach( $query as $row )
      {
        $data['message'][] = array( 'id'=>$row->id,
                      'label'=> $row->name." [".$row->type." - ".$row->state."]", 
                      'value'=> $row->name,
                      'type' => $row->type,
                      'icon' => 'chainbg.png');
      }
    }

    //return the data
    echo json_encode($data);
  }   

  
}
	