// holds an instance of XMLHttpRequest
var xmlHttp = createXmlHttpRequestObject();

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
    try
    {
      xmlHttp = new ActiveXObject("MSXML2.XMLHTTP.6.0");
    }
    catch(e) { }
  }
  // return the created object or display an error message
  if (!xmlHttp)
    alert("Error creating the XMLHttpRequest object.");
  else 
    return xmlHttp;
}


// called to read a file from the server
function process()
{
  // only continue if xmlHttp isn't void
  if (xmlHttp)
  {
    // try to connect to the server
    try
    {
      // initiate reading the async.txt file from the server
      xmlHttp.open("GET", "async.txt", true);
      xmlHttp.onreadystatechange = handleRequestStateChange;
      xmlHttp.send(null);
    }
    // display the error in case of failure
    catch (e)
    {
      alert("Can't connect to server:\n" + e.toString());
    }
  }
}

// function that handles the http response
function handleRequestStateChange() 
{
  // obtain a reference to the <div> element on the page
  myDiv = document.getElementById('myDivElement');
  // display the status o the request 
  if (xmlHttp.readyState == 1)
  {
    myDiv.innerHTML += "Request status: 1 (loading) <br/>";
  }
  else if (xmlHttp.readyState == 2)
  {
    myDiv.innerHTML += "Request status: 2 (loaded) <br/>";
  }
  else if (xmlHttp.readyState == 3)
  {
    myDiv.innerHTML += "Request status: 3 (interactive) <br/>";
  }
  // whean readyState is 4, we also read the server response
  else if (xmlHttp.readyState == 4) 
  {
    // continue only if HTTP status is "OK"
    if (xmlHttp.status == 200) 
    {
      try
      {
        // read the message from the server
        response = xmlHttp.responseText;
        // display the message 
        myDiv.innerHTML += "Request status: 4 (complete). Server said: <br/>";
        myDiv.innerHTML += response;
      }
      catch(e)
      {
        // display error messages and stop updating the window
        alert("Error: " + e.toString());
      }
    } 
    else
    {
      // display status message
      alert("There was a problem retrieving the XML data:\n" + 
            xmlHttp.statusText);
    }
  }
}
