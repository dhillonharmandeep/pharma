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
  function indexnew(){
    $this->load->view('dashboard/ajax/indexnew');
    
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
  
  function newquery($keyword){
    // reference the file containing the Suggest class
//    require_once('suggest.class.php');
    // create a new Suggest instance
    // $suggest = new Suggest();
    // retrieve the keyword passed as parameter
//    $keyword = $_GET['keyword'];
    // clear the output 
    // if(ob_get_length()) ob_clean();
    //headers are sent to prevent browsers from caching
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT' ); 
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT'); 
    header('Cache-Control: no-cache, must-revalidate'); 
    header('Pragma: no-cache');
    header('Content-Type: text/xml');
    // send the results to the client
    //echo $suggest->getSuggestions($keyword);
    $output = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
    $output .= '<response>';    

    $this->load->model('warehouse');
    $res = $this->warehouse->ajaxGetWH(array('name' => $keyword));
    foreach ($res as $row) {

      $output .= '<name>'.$name=$row->chain_name.'['.$row->state.']</name>';
    }

    $output .= '</response>';   
    
    echo $output; 
  }
}