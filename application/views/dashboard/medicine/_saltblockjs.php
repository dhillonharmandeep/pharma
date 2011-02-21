<?php
/** 
 * _saltblockjs.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Dec 17, 2010
 */
?>
<script type="text/javascript">
//<![CDATA[
  function addSalt(){
    // Find the number of existing 
    var oSaltCount = window.document.getElementById('salt_count');
    newId = parseInt(oSaltCount.value) + 1;
    // Set the new id as the value 
    oSaltCount.value = newId;

    // Add the new HTML to the fieldset
    var oSaltField = window.document.getElementById('salts');    
    
    oSaltField.innerHTML = oSaltField.innerHTML + generateSaltHTML(newId); 
  }
  function deleteSalt(){
    // Find the number of existing 
    var oSaltCount = window.document.getElementById('salt_count');
    newId = parseInt(oSaltCount.value);
    
    // check if there is a salt to delete
    if (newId == 0){
      alert('There is no salt to delete');
    }
    else{
      // remove the DOM object
      var oToDelete = window.document.getElementById('salt_'+newId);
      oToDelete.parentNode.removeChild(oToDelete);       

      // Find the new id
      newId--;    
      // Set the new id as the value 
      oSaltCount.value = newId;
    }
  }
  function generateSaltHTML(id){
    var str = '';
    str += '<div id="salt_'+id+'">';
    str += '  <div class="formrowhalf">';
    str += '    <label class="formfield">Salt '+id+' Name <span class="required">*</span></label>';
    str += '    <input type="text" name="msalt_'+id+'name" value="" id="msalt_'+id+'name" class="fields" size="50" onfocus="init(this, \'/salt/ajaxquery/\');" onkeyup="handleKeyUp(event)"  />';                      
    str += '  </div>';
    str += '  <div class="formrowhalf">';
    str += '    <label class="formfield">Salt '+id+' Dosage <span class="required">*</span></label>';
    str += '    <input type="text" name="msalt_'+id+'dosage" value="" id="msalt_2dosage" class="fields"  />';                      
    str += '  </div>';
    str += '</div>';
    
    return str;
  }
// ]]>
</script>