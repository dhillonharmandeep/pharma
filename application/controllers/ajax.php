<?php
/** 
 * chainbg.php
 * Description  :
 * 
 * 
 * Created by : Harman Dhillon
 * Created on   : Nov 28, 2010
 */
class Ajax extends Controller {
  function Mtype(){
    parent::Controller();
    
    // Set the security of this page
    if (!$this->user->Secure(array('type' => 'Admin')))
    {
      $this->session->set_flashdata('flashError', 'You must be logged in as admin to access this page');
      redirect('login');  
    }
  }

  function index(){
    $this->load->view('dashboard/ajax/index');
    
  }
  
  function query(){
    echo "<h3>Some Text from the controller</h3>";
  }
  
  function query2(){
    $query = $_REQUEST['query'];
  
    $counter='0';
    echo "{";
    echo "query:'$query',";
    echo "suggestions:[";

    $this->load->model('warehouse');
    $res = $this->warehouse->ajaxGetWH(array('name' => $query));
    foreach ($res as $row) {
      $counter++;
      if ($counter > 1) {
        echo ",";
      }

      $name=$row->chain_name.'['.$row->state.']';
      echo "'$name'";
    }
    echo "],}";  
  }
}