<?php
// load error handler and database configuration
require_once ('error_handler.php');
require_once ('config.php');

// This class builds a tasks list and 
// performs add/delete/reorder actions on it
class TasksList
{
  // stored database connection
  private $mMysqli;
  
  // constructor opens database connection
  function __construct() 
  {   
    // connect to the database
    $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,
                                DB_DATABASE);      
  }

  // destructor closes database connection  
  public function __destruct() 
  {
    $this->mMysqli->close();
  }
  
  // Builds the tasks list
  public function BuildTasksList()
  {
    // initialize output
    $myList = '';
    // build query
    $result = $this->mMysqli->query('SELECT * FROM tasks ' . 
                                    'ORDER BY order_no ASC');
    // build task list as <li> elements
    while ($row = $result->fetch_assoc()) 
    { 
      $myList .= '<li id="' . htmlentities($row['id']) . '">' . 
                 htmlentities($row['description']) . '</li>';
    }
    // return the list
    return $myList;
  }

  // Handles the server-side data processing
  public function Process($content, $action)
  {
    // perform action requested by client
    switch($action)
    {
      // Reorder task list
      case 'updateList':
        // retrieve update details
        $new_order = explode('_', $content);
        // update list
 
        for ($i=0; $i < count($new_order); $i++)
        {
          // escape data received from client
          $new_order[$i] = 
                      $this->mMysqli->real_escape_string($new_order[$i]);
          // update task
          $result = $this->mMysqli->query('UPDATE tasks SET order_no="' . 
                             $i . '" WHERE id="' . $new_order[$i] . '"');
        }
        $updatedList = $this->BuildTasksList();
        return $updatedList;
        break;
     
      // Add a new task
      case 'addNewTask':
        // escape input data
        $task = trim($this->mMysqli->real_escape_string($content));
        // continue only if task name is not null
        if ($task)
        {
          // obtain the highest order_no
          $result = $this->mMysqli->query('SELECT (MAX(order_no) + 1) ' . 
                                          'AS order_no FROM tasks');
          $row = $result->fetch_assoc();
          // if the table is empty, order_no will be null
          $order = $row['order_no'];          
          if (!$order) $order = 1;
          // insert the new task as the bottom of the list
          $result = $this->mMysqli->query
                          ('INSERT INTO tasks (order_no, description) ' . 
                           'VALUES ("' . $order . '", "' . $task . '")');
          // return the updated tasks list
          $updatedList = $this->BuildTasksList();
          return $updatedList;
        }
        break;
      
      // Delete task
      case 'delTask':
        // escape input data
        $content = trim($this->mMysqli->real_escape_string($content));
        // delete the task
        $result = $this->mMysqli->query('DELETE FROM tasks WHERE id="' . 
                                        $content . '"');
        $updatedList = $this->BuildTasksList();
        return $updatedList;
        break;
    }
  }
}
?>
