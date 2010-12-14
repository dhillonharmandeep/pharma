<?php
// load configuration file
require_once('config.php');
// class packages functionality for the MySql application
class MySql
{
  // database handler
  private $mMysqli;  
      
  // class constructor
  function __construct() 
  {   
    // connect to the database
    $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);   
  }
  
  // retrieve the user names from the database
  function getNames()
  {
    // what SQL query you want executed?
    $query = 'SELECT user_id, user_name FROM users'; 
    // execute the query
    $result = $this->mMysqli->query($query);  
    // loop through the results
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
      // extract user id and name
      $user_id = $row['user_id'];
      $user_name = $row['user_name'];
      // do something with the data (here we output it)
      echo 'Name of user #' . $user_id . ' is ' . $user_name . '<br/>';
    }
    // close the input stream
    $result->close();
  }
  
  // class destructor, closes database connection  
  public function __destruct() 
  {
    // close the database connection
    $this->mMysqli->close();
  }
}
?>
