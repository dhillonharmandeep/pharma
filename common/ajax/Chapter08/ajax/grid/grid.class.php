<?php
// load configuration file
require_once('config.php');
// start session
session_start();

// includes functionality to manipulate the products list 
class Grid 
{      
  // grid pages count
  public $mTotalPages;
  // grid items count
  public $mItemsCount;
  // index of page to be returned
  public $mReturnedPage;    
  // database handler
  private $mMysqli;
  // database handler
  private $grid;
  
  // class constructor
  function __construct() 
  {   
    // create the MySQL connection
    $this->mMysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,
                                DB_DATABASE);
    // call countAllRecords to get the number of grid records
    $this->mItemsCount = $this->countAllRecords();
  }

  // class destructor, closes database connection  
  function __destruct() 
  {
    $this->mMysqli->close();
  }
  // read a page of products and save it to $this->grid
  public function readPage($page)
  {
    // create the SQL query that returns a page of products
    $queryString = $this->createSubpageQuery('SELECT * FROM product', 
                                             $page);
 
    // execute the query
    if ($result = $this->mMysqli->query($queryString)) 
    {
      // fetch associative array 
      while ($row = $result->fetch_assoc()) 
      {
        // build the XML structure containing products
        $this->grid .= '<row>';
        foreach($row as $name=>$val)
          $this->grid .= '<' . $name . '>' . 
                         htmlentities($val) . 
                         '</' . $name . '>';
        $this->grid .= '</row>';   
      }
      // close the results stream                     
      $result->close();
    }       
  }

  // update a product
  public function updateRecord($id, $on_promotion, $price, $name)
  {
    // escape input data for safely using it in SQL statements
    $id = $this->mMysqli->real_escape_string($id);
    $on_promotion = $this->mMysqli->real_escape_string($on_promotion);
    $price = $this->mMysqli->real_escape_string($price);
    $name = $this->mMysqli->real_escape_string($name);
    // build the SQL query that updates a product record
    $queryString =  'UPDATE product SET name="' . $name . '", ' . 
                    'price=' . $price . ',' . 
                    'on_promotion=' . $on_promotion . 
                    ' WHERE product_id=' . $id;        
    // execute the SQL command      
    $this->mMysqli->query($queryString);  
  }

  // returns data about the current request (number of grid pages, etc)
  public function getParamsXML()
  { 
    // calculate the previous page number
    $previous_page = 
      ($this->mReturnedPage == 1) ? '' : $this->mReturnedPage-1;    
    // calculate the next page number
    $next_page = ($this->mTotalPages == $this->mReturnedPage) ? 
                 '' : $this->mReturnedPage + 1; 
    // return the parameters
    return '<params>' .
           '<returned_page>' . $this->mReturnedPage . '</returned_page>'.
           '<total_pages>' . $this->mTotalPages . '</total_pages>'.
           '<items_count>' . $this->mItemsCount . '</items_count>'.
           '<previous_page>' . $previous_page . '</previous_page>'.
           '<next_page>' . $next_page . '</next_page>' .
           '</params>';
  }

  // returns the current grid page in XML format
  public function getGridXML()
  {
    return '<grid>' . $this->grid . '</grid>';
  } 

  // returns the total number of records for the grid
  private function countAllRecords()
  {
    /* if the record count isn't already cached in the session, 
       read the value from the database */
 
    if (!isset($_SESSION['record_count'])) 
    {
      // the query that returns the record count
      $count_query = 'SELECT COUNT(*) FROM product';
      // execute the query and fetch the result 
      if ($result = $this->mMysqli->query($count_query)) 
      {
        // retrieve the first returned row
        $row = $result->fetch_row(); 
        /* retrieve the first column of the first row (it represents the 
           records count that we were looking for), and save its value in 
           the session */
        $_SESSION['record_count'] = $row[0];
        // close the database handle
        $result->close();
      }
    }    
    // read the record count from the session and return it
    return $_SESSION['record_count'];
  }         
  
  // receives a SELECT query that returns all products and modifies it
  // to return only a page of products
  private function createSubpageQuery($queryString, $pageNo) 
  {
    // if we have few products then we don't implement pagination  
    if ($this->mItemsCount <= ROWS_PER_VIEW) 
    {
      $pageNo = 1;
      $this->mTotalPages = 1;
    }
    // else we calculate number of pages and build new SELECT query
    else 
    {
      $this->mTotalPages = ceil($this->mItemsCount / ROWS_PER_VIEW);
      $start_page = ($pageNo - 1) * ROWS_PER_VIEW;   
      $queryString .= ' LIMIT ' . $start_page . ',' . ROWS_PER_VIEW;
    }
    // save the number of the returned page
    $this->mReturnedPage = $pageNo;
    // returns the new query string
    return $queryString;
  } 
// end class Grid
} 
?>
