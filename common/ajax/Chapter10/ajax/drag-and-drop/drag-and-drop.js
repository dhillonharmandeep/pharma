// holds an instance of XMLHttpRequest
var xmlHttp = createXmlHttpRequestObject();
// when set to true, display detailed error messages
var showErrors = true;
// initialize the requests cache 
var cache = new Array();

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

// Scriptaculous-specific code to define a sortable list and a drop zone
function startup()
{
  // Transform an unordered list into a sortable list with draggable items
  Sortable.create("tasksList", {tag:"li"}); 

  // Define a drop zone used for deleting tasks
  Droppables.add("trash", 
  {
    onDrop: function(element) 
    {
      var deleteTask = 
                    confirm("Are you sure you want to delete this task?")
      if (deleteTask)
      {
        Element.hide(element);
        process(element.id, "delTask");
      }
    }
  });
}

// Serialize the id values of list items (<li>s)
function serialize(listID)
{
  // count the list's items
  var length = document.getElementById(listID).childNodes.length;
  var serialized = "";
  // loop through each element
  for (i = 0; i < length; i++)
  {
    // get current element
    var li = document.getElementById(listID).childNodes[i];
    // get current element's id without the text part
    var id = li.getAttribute("id");
    // append only the number to the ids array
    serialized += encodeURIComponent(id) + "_";
  }
  // return the array with the trailing '_' cut off
  return serialized.substring(0, serialized.length - 1);
}

// Send request to server
function process(content, action)
{
  // only continue if xmlHttp isn't void
  if (xmlHttp)
  {
    // initialize the request query string to empty string 
    params = "";
    // escape the values to be safely sent to the server 
    content = encodeURIComponent(content);
    // send different parameters depending on action
    if (action == "updateList")
      params = "?content=" + serialize(content) + "&action=updateList";
    else if (action == "addNewTask")
    {
      // prepare the task for sending to the server
      var newTask = 
        trim(encodeURIComponent(document.getElementById(content).value));
      // don't add void tasks
      if (newTask)
        params = "?content=" + newTask + "&action=addNewTask";
 
    }
    else if (action =="delTask")
      params = "?content=" + content + "&action=delTask";
    // don't add null params to cache            
    if (params) cache.push(params);

    // try to connect to the server
    try
    {
      // only continue if the connection is clear and cache is not empty
      if ((xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
           && cache.length>0)
      {
        // get next set of values from cache
        var cacheEntry = cache.shift();
        // initiate the request
        xmlHttp.open("GET", "drag-and-drop.php" + cacheEntry, true);
        xmlHttp.setRequestHeader("Content-Type", 
                                 "application/x-www-form-urlencoded");
        xmlHttp.onreadystatechange = handleRequestStateChange;
        xmlHttp.send(null);
      }
      else
      {
        setTimeout("process();", 1000);  
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
function handleRequestStateChange() 
{
  // when readyState is 4, we also read the server response
  if (xmlHttp.readyState == 4) 
  {
    // continue only if HTTP status is "OK"
    if (xmlHttp.status == 200) 
    {
      try
      {
        postUpdateProcess();
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
function postUpdateProcess()
{
  // read the response
  var response = xmlHttp.responseText;
  // server error?
 
  if (response.indexOf("ERRNO") >= 0 || response.indexOf("error") >= 0)
    alert(response);
  // update the tasks list  
  document.getElementById("tasksList").innerHTML = response;
  Sortable.create("tasksList");
  document.getElementById("txtNewTask").value = "";
  document.getElementById("txtNewTask").focus(); 
} 
/* handles keydown to detect when enter is pressed */
function handleKey(e) 
{
  // get the event
  e = (!e) ? window.event : e;
  // get the code of the character that has been pressed        
  code = (e.charCode) ? e.charCode :
         ((e.keyCode) ? e.keyCode :
         ((e.which) ? e.which : 0));
  // handle the keydown event       
  if (e.type == "keydown") 
  {
    // if enter (code 13) is pressed
    if(code == 13)
    {
      // send the current message  
      process("txtNewTask", "addNewTask");
    }
  }
}

/* removes leading and trailing spaces from the string */
function trim(s)
{
  return s.replace(/(^\s+)|(\s+$)/g, "")
}
