// holds an instance of XMLHttpRequest
var xmlHttp = createXmlHttpRequestObject();
// holds the remote server address and parameters
var serverAddress = "friendly.php";
var getNumberParams = "action=GetNumber" + // get a new random number
                      "&min=1" + // the min number to generate
                      "&max=100"; // the max number to generate
var checkAvailabilityParams = "action=CheckAvailability"; 
// variables used to check for server availability 
var requestsCounter = 0; // counts how many numbers have been retrieved
var checkInterval = 10; // counts interval for checking server availability
var updateInterval = 1; // how many seconds to wait to get a new number
var updateIntervalIfServerBusy = 10; // seconds to wait when server busy
var minServerBufferLevel = 50; // what buffer level is considered acceptable
var errorRetryInterval = 30; // seconds to wait after server error

// creates an XMLHttpRequest instance
function createXmlHttpRequestObject() 
{
  // will store the reference to the XMLHttpRequest object
  var xmlHttp;
  // this should work for all browsers except IE6 and older
  try
  {
    // try to create XMLHttpRequest object
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    // assume IE6 or older
    var XmlHttpVersions = new Array("MSXML2.XMLHTTP.6.0",
                                    "MSXML2.XMLHTTP.5.0",
                                    "MSXML2.XMLHTTP.4.0",
                                    "MSXML2.XMLHTTP.3.0",
                                    "MSXML2.XMLHTTP",
                                    "Microsoft.XMLHTTP");
    // try every prog id until one works
    for (var i=0; i<XmlHttpVersions.length && !xmlHttp; i++) 
    {
      try 
      { 
        // try to create XMLHttpRequest object
        xmlHttp = new ActiveXObject(XmlHttpVersions[i]);
      } 
      catch (e) {}
    }
  }
  // return the created object or display an error message
  if (!xmlHttp)
    alert("Error creating the XMLHttpRequest object.");
  else 
    return xmlHttp;
}

// call server asynchronously
function process()
{
  // only continue if xmlHttp isn't void
  if (xmlHttp)
  {
    // try to connect to the server
    try
    {
      // if just starting, or if we hit the specified number of requests,
      // check for server availability, otherwise ask for a new random number
      if (requestsCounter % checkInterval == 0) 
      {
        // check if server is available
        xmlHttp.open("GET", serverAddress + "?" + checkAvailabilityParams, true);
        xmlHttp.onreadystatechange = handleCheckingAvailability;
        xmlHttp.send(null);
      }
      else
      {
        // get new random number
        xmlHttp.open("GET", serverAddress + "?" + getNumberParams, true);
        xmlHttp.onreadystatechange = handleGettingNumber;
        xmlHttp.send(null);
      }
    }
    catch(e)
    {
      // display error message
      alert("Can't connect to server, will retry after " 
            + errorRetryInterval + "seconds." + e.toString());
      // restart sequence 
      setTimeout("process();", errorRetryInterval * 1000);
    }
  }
}

// function that displays a new message on the page
function display($message)
{
  // obtain a reference to the <div> element on the page
  myDiv = document.getElementById("myDivElement");
  // display message
  myDiv.innerHTML += $message + "<br/>";
}

// function called when the state of the HTTP request changes
function handleCheckingAvailability() 
{
  // when readyState is 4, we are ready to read the server response
  if (xmlHttp.readyState == 4) 
  {
    // continue only if HTTP status is "OK"
    if (xmlHttp.status == 200) 
    {
      try
      {
        // do something with the reponse from the server
        checkAvailability();
      }
      catch(e)
      {
        // display error message
        display("Error reading server availability [1], will retry after " +
                errorRetryInterval + "seconds." + e.toString());
        // restart sequence 
        setTimeout("process();", errorRetryInterval * 1000);
      }
    } 
    else
    {
      // display status message
      display("Error reading server availability [2], will retry after " + 
              errorRetryInterval + "seconds.");
      // restart sequence 
      setTimeout("process();", errorRetryInterval * 1000);            
    }
  }
}

// handles the response received from the server
function checkAvailability()
{
  // retrieve the server's response 
  var response = xmlHttp.responseText;
  // if the response is long enough, we assuwe we just received
  // a server-side error report
  if(response.length > 5)
    throw(response);
  // display the HTML output
  if (response >= minServerBufferLevel)
  {
    // display new message to user
    display("Server buffer level is at " + response + "%, " +
            "starting to retrieve new numbers.");
    // increases counter to start retrieving new numbers
    requestsCounter++;       
    // restart sequence 
    setTimeout("process();", updateInterval * 1000);            
  }
  else
  {
    // display new message to user
    display("Server buffer is too low (" + response + "%), " +
            "will check again in " + updateIntervalIfServerBusy  +
            " seconds.");
    // restart sequence 
    setTimeout("process();", updateIntervalIfServerBusy * 1000);            
  }

}

// function called when the state of the HTTP request changes
function handleGettingNumber() 
{
  // when readyState is 4, we are ready to read the server response
  if (xmlHttp.readyState == 4) 
  {
    // continue only if HTTP status is "OK"
    if (xmlHttp.status == 200) 
    {
      try
      {
        // do something with the reponse from the server
        getNumber();
      }
      catch(e)
      {
        // display error message
        display("Error retrieving new number [1], will retry after " + 
                errorRetryInterval + "seconds.");
        // restart sequence 
        setTimeout("process();", errorRetryInterval * 1000);
      }
    } 
    else
    {
      // display status message
      display("Error retrieving new number [2], will retry after " + 
              errorRetryInterval + "seconds.");
      // restart sequence 
      setTimeout("process();", errorRetryInterval * 1000);            
    }
  }
}

// handles the response received from the server
function getNumber()
{
  // retrieve the server's response 
  var response = xmlHttp.responseText;
  // if the response is long enough, we assuwe we just received
  // a server-side error report
  if(response.length > 5)
    throw(response);
  // display the new number
  display("New random number retrieved from server: " + response);
  // increase requests count
  requestsCounter++;
  // restart sequence
  setTimeout("process();", updateInterval * 1000);
}
