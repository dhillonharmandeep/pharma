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

 
// read a file from the server
function process()
{
  // only continue if xmlHttp isn't void
  if (xmlHttp)
  {
    // try to connect to the server
    try
    {
      // get the two values entered by the user
      var firstNumber = document.getElementById("firstNumber").value; 
      var secondNumber = document.getElementById("secondNumber").value;
      // create the params string
      var params = "firstNumber=" + firstNumber + 
                   "&secondNumber=" + secondNumber;
      // initiate the asynchronous HTTP request
      xmlHttp.open("GET", "morephp.php?" + params, true);
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

// function called when the state of the HTTP request changes
function handleRequestStateChange() 
{
  // when readyState is 4, we are ready to read the server response
  if (xmlHttp.readyState == 4) 
  {
    // continue only if HTTP status is "OK"
    if (xmlHttp.status == 200) 
    {
      try
      {
        // do something with the response from the server
        handleServerResponse();
      }
      catch(e)
      {
        // display error message
        alert("Error reading the response: " + e.toString());
      }
    } 
    else
    {
      // display status message
      alert("There was a problem retrieving the data:\n" + 
            xmlHttp.statusText);
    }
  }
}

// handles the response received from the server
function handleServerResponse()
{
  // retrieve the server's response packaged as an XML DOM object
  var xmlResponse = xmlHttp.responseXML;
  // catching potential errors with IE and Opera
  if (!xmlResponse || !xmlResponse.documentElement)
    throw("Invalid XML structure:\n" + xmlHttp.responseText);
 
  // catching potential errors with Firefox
  var rootNodeName = xmlResponse.documentElement.nodeName;
  if (rootNodeName == "parsererror") 
    throw("Invalid XML structure:\n" + xmlHttp.responseText);
  // getting the root element (the document element)
  xmlRoot = xmlResponse.documentElement;
  // testing that we received the XML document we expect
  if (rootNodeName != "response" || !xmlRoot.firstChild)
    throw("Invalid XML structure:\n" + xmlHttp.responseText);
  // the value we need to display is the child of the root <response> element
  responseText = xmlRoot.firstChild.data;
  // display the user message
  myDiv = document.getElementById("myDivElement");
  myDiv.innerHTML = "Server says the answer is: " + responseText;
}
