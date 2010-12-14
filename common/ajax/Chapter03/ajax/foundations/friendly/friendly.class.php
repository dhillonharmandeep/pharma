<?php
// load error handling sequence
require_once ('error_handler.php');

// class stores Friendly web application functionality
class Friendly
{
  // stores the database connection
  private $mMysqli;
	
  // Constructor - creates database connection
  function __construct()
  {
    $this->mMysqli = new mysqli($GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD'], $GLOBALS['DB_DATABASE']);      
  }

  function __destruct()
  {
    $this->mMysqli->close();      
  }
    
  public function GetRandomNumber()
  {
    $num = 1; // value is hardcoded because client can't deal with more numbers
    $min = $_GET['min'];
    $max = $_GET['max'];
    // holds the remote server address and parameters
    $serverAddress = 'http://www.random.org/cgi-bin/randnum';
    $serverParams = 'num=' . $num . // how many random numbers to generate
                    '&min=' . $min . // the min number to generate
                    '&max=' . $max; // the max number to generate
    // retrieve the random number from foreign server
    $randomNumber = file_get_contents($serverAddress . '?' . $serverParams);
    // output the random number
    echo $randomNumber;                              
  }
    
  public function GenerateNewsLine()
  {
    // this will store the news line
    $news = 'No news for today.';
    // SQL that selects two random users from the database.
    $query = 'SELECT user_name FROM users ' +
             'ORDER BY RAND() ' +
             'LIMIT 1'; 
    // execute the query
    $result = $mysqli->query($query);  
    // retrieve the user rows
    $row1 = $result->fetch_array(MYSQLI_ASSOC);
    $row2 = $result->fetch_array(MYSQLI_ASSOC);
    // close the input stream
    $result->close();  
    // generate the news
    if (!row1 || !row2)
    {
      $news = 'The project needs more users!';
    }
    else
    {
      $name1 = $row1['user_name'];
      $name2 = $row2['user_name'];
      $news = 'User ' . $name1 . ' works with user ' . $name2;
    }
    // output the news line
    echo $news;
    
    
  }
    
    
  // AJAX validation when field looses focus
  public function ValidateAJAX($inputValue, $fieldID)
  {
    switch($fieldID)
    {
      // Check if username already exists in the database
      case 'txtUsername':
        if ($inputValue != null)
        {
          $inputValue = $this->mMysqli->real_escape_string($inputValue);
          $query = $this->mMysqli->query('SELECT username FROM users WHERE username="'.$inputValue.'"');
          if ($this->mMysqli->affected_rows > 0)
            return '1';
          else
            return '0';
        }
        else
        {
          return '1';
        }
        break;
        
      // Check if name field is empty
      case 'txtName':
        if ($inputValue == '')
          return '1';
        else
          return '0';
        break;
        
      // Check if a gender was selected
      case 'selGender':
        if ($inputValue == '0')
          return '1';
        else
          return '0';
        break;
        
      // Check if birth month is valid
      case 'selBthMonth':
        if ($inputValue == '0')
          return '1';
        else
          return '0';
        break;
        
      // Check if birth day is valid
      case 'txtBthDay':
        if ($inputValue == '' || $inputValue > 31 || $inputValue < 1)
          return '1';
        else
          return '0';
        break;
        
      // Check if birth year is valid
      case 'txtBthYear':
        if ($inputValue == '' || $inputValue > 2000 || $inputValue < 1900)
          return '1';
        else
          return '0';
        break;
        
      // Check if email is valid (allowed formats: *@*.*, *@*.*.*, *.*@*.*, *.*@*.*.*)
      case 'txtEmail':
        if (!eregi('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$', $inputValue))
          return '1';
        else
          return '0';
        break;
        
      // check if phone is valid (allowed format: ###-###-####)
      case 'txtPhone':
        if (!eregi('^[0-9]{3}-*[0-9]{3}-*[0-9]{4}$', $inputValue))
          return '1';
        else
          return '0';
        break;
		  
      // Check if "I have read the terms" checkbox has been checked
      case 'chkReadTerms':
        if ($inputValue == 'false')
          return '1';
        else
          return '0';
        break;
    }
  }
    
  // Classic validation on form submit
  public function ValidatePHP()
  {
    // An error flag. Becomes 1 when errors are found.
    $errorsExist = 0;
      
    if (isset($_SESSION['errors']))
      unset($_SESSION['errors']);
	  
    // Initialize data
    $_SESSION['errors']['txtUsername'] = 'hidden';
    $_SESSION['errors']['txtName'] = 'hidden';
    $_SESSION['errors']['selGender'] = 'hidden';
    $_SESSION['errors']['selBthMonth'] = 'hidden';
    $_SESSION['errors']['txtBthDay'] = 'hidden';
    $_SESSION['errors']['txtBthYear'] = 'hidden';
    $_SESSION['errors']['txtEmail'] = 'hidden';
    $_SESSION['errors']['txtPhone'] = 'hidden';
    $_SESSION['errors']['chkReadTerms'] = 'hidden';
  
    // Check if username already exists in the database
    if ($_POST['txtUsername'] != null)
    {
      $txtUsername = $this->mMysqli->real_escape_string($_POST['txtUsername']);
      $query = $this->mMysqli->query('SELECT username FROM users WHERE username="'.$txtUsername.'"');
      if ($this->mMysqli->affected_rows > 0)
      {
        $_SESSION['errors']['txtUsername'] = 'error';
        $errorsExist = 1;
      }
    }
    else
    {
      $_SESSION['errors']['txtUsername'] = 'error';
      $errorsExist = 1;
    }
    
    // Check if name field is empty
    if ($_POST['txtName'] == '')
    {
      $_SESSION['errors']['txtName'] = 'error';
      $errorsExist = 1;
    }
  
    // Check if a gender was selected
    if ($_POST['selGender'] == '0')
    {
      $_SESSION['errors']['selGender'] = 'error';
      $errorsExist = 1;
    }
    
    // Check if birth month is valid
    if ($_POST['selBthMonth'] == '0')
    {
      $_SESSION['errors']['selBthMonth'] = 'error';
      $errorsExist = 1;
    }
	  
    // Check if birth day is valid
    if ($_POST['txtBthDay'] == '' || $_POST['txtBthDay'] > 31 || $_POST['txtBthDay'] < 1)
    {
      $_SESSION['errors']['txtBthDay'] = 'error';
      $errorsExist = 1;
    }
	  
    // Check if birth year is valid	  
    if ($_POST['txtBthYear'] == '' || $_POST['txtBthYear'] > 2000 || $_POST['txtBthYear'] < 1900)
    {
      $_SESSION['errors']['txtBthYear'] = 'error';
      $errorsExist = 1;
    }
	  
    // Check if email is valid (allowed formats: *@*.*, *@*.*.*, *.*@*.*, *.*@*.*.*)
    if (!eregi('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$', $_POST['txtEmail']))
    {
      $_SESSION['errors']['txtEmail'] = 'error';
      $errorsExist = 1;
    }
  
    // check if phone is valid (allowed format: ###-###-####)
    if (!eregi('^[0-9]{3}-*[0-9]{3}-*[0-9]{4}$', $_POST['txtPhone']))
    {
      $_SESSION['errors']['txtPhone'] = 'error';
      $errorsExist = 1;
    }
	  
    // Check if "I have read the terms" checkbox has been checked
    if (!isset($_POST['chkReadTerms']))
    {
      $_SESSION['errors']['chkReadTerms'] = 'error';
      $_SESSION['values']['chkReadTerms'] = '';
      $errorsExist = 1;
    }

    // If no errors are found, point to a successful validation page
    if ($errorsExist == 0)
    {
      return 'allok.php';
    }
    else
    {
      // If errors are found, save current user input
      foreach ($_POST as $key => $value)
      {
        $_SESSION['values'][$key] = $_POST[$key];
      }
      return 'index.php';
    }
  }
}
?>
