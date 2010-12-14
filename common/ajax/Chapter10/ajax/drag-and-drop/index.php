<?php
  require_once ('taskslist.class.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AJAX Drag and Drop Sortable List</title>
    <link href="drag-and-drop.css" rel="stylesheet" type="text/css" />
    <script src="drag-and-drop.js" type="text/javascript"></script>
    <script src="scriptaculous/lib/prototype.js" type="text/javascript">
    </script>
    <script src="scriptaculous/src/scriptaculous.js" type="text/javascript">
    </script>
  </head>
  <body onload="startup()">
    <h1>Task Management</h1>
    <h2>Add a new task</h2>
    <div>
      <input type="text" id="txtNewTask" name="txtNewTask" 
             size="30" maxlength="100" onkeydown="handleKey(event)"/>
      <input type="button" name="submit" value="Add this task" 
             onclick="process('txtNewTask', 'addNewTask')" />
    </div>
    <br />
    <h2>All tasks</h2>
    <ul id="tasksList" class="sortableList" 
        onmouseup="process('tasksList', 'updateList')">
      <?php 
        $myTasksList = new TasksList(); 
        echo $myTasksList->BuildTasksList();
      ?> 
    </ul>
    <br /><br />
    <div id="trash">
      DROP HERE TO DELETE
      <br /><br />
    </div>
  </body>
</html>
