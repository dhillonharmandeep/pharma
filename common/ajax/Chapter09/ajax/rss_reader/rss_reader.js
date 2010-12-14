// holds an instance of XMLHttpRequest
var xmlHttp = createXmlHttpRequestObject();
// when set to true, display detailed error messages
var showErrors = true;

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
      catch (e) {} // ignore potential error
    }
  }
  // return the created object or display an error message
  if (!xmlHttp)
	  alert("Error creating the XMLHttpRequest object.");
  else 
 
    return xmlHttp;
}

// function that displays an error message
function displayError($message)
{
  // ignore errors if showErrors is false
  if (showErrors)
  {
    // turn error displaying Off
    showErrors = false;
    // display error message
    alert("Error encountered: \n" + $message);
  }
}

// Retrieve titles from a feed and display them
function getFeed(feedLink, feed)
{
  // only continue if xmlHttp isn't void
  if (xmlHttp)
  {
	// try to connect to the server
    try
    {
      if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
      {
        /* Get number of feeds and loop through each one of them to 
           change the class name of their container (<li>). */
        var numberOfFeeds = 
                   document.getElementById("feedList").childNodes.length;
        for (i = 0; i < numberOfFeeds; i++)
          document.getElementById("feedList").childNodes[i].className = "";
        // Change the class name for the clicked feed so it becomes 
        // highlighted
        feedLink.className = "active";
        // Display "Loading..." message while loading feed
        document.getElementById("loading").style.display = "block";
        // Call the server page to execute the server-side operation
        params = "feed=" + feed;
        xmlHttp.open("POST", "rss_reader.php", true);
        xmlHttp.setRequestHeader("Content-Type", 
                                 "application/x-www-form-urlencoded");
        xmlHttp.onreadystatechange = handleHttpGetFeeds;
        xmlHttp.send(params);
      }
      else
      {
        // if connection was busy, try again after 1 second
        setTimeout("getFeed('" + feedLink + "', '" + feed + "');", 1000);
      }
    }
    // display the error in case of failure
    catch (e)
    {
      displayError(e.toString());
    }
  }
}

// function that retrieves the HTTP response
function handleHttpGetFeeds() 
{
 
  // continue if the process is completed
  if (xmlHttp.readyState == 4) 
  {
   // continue only if HTTP status is "OK"
    if (xmlHttp.status == 200) 
    {
      try
      {
        displayFeed();
      }
      catch(e)
      {
        // display error message
        displayError(e.toString());
      }
    } 
    else 
    {
      displayError(xmlHttp.statusText);
    }
  }
}

// Processes server's response
function displayFeed()
{
  // read server response as text, to check for errors 
  var response = xmlHttp.responseText;
  // server error?
  if (response.indexOf("ERRNO") >= 0 
      || response.indexOf("error:") >= 0
      || response.length == 0)
    throw(response.length == 0 ? "Void server response." : response);
  // hide the "Loading..." message upon feed retrieval
  document.getElementById("loading").style.display = "none";
  // append XSLed XML content to existing DOM structure
  var titlesContainer = document.getElementById("feedContainer");
  titlesContainer.innerHTML = response;
  // make the feed container visible
  document.getElementById("feedContainer").style.display = "block";
  // clear home page text
  document.getElementById("home").innerHTML = "";
}
