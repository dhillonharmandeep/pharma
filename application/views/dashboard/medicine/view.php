<?php
/** 
 * view.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 5, 2010
 */
$this->load->view('dashboard/structure/_header', array('title' => $title));
$this->load->view('dashboard/structure/_leftmenu', array('heading' => $heading));
?>
	<p>
	<span class="back"><a href="<?= base_url()?>medicine">All medicine</a></span>
  	<span class="edit"><a href="<?= base_url()?>medicine/edit/<?=$medicine->id?>">Edit details</a></span>
  	<span class="delete"><a onclick="return confirm('Are you sure you wish to delete?');" href="<?= base_url()?>medicine/delete/<?=$medicine->id?>">Delete this medicine</a></span>
  	<span class="eye"><a href="<?= base_url()?>medicine/index/<?=$medicine->name?>">Same name medicines</a></span>
	</p>
	
	<div class="fieldset">
	  <h2><?php echo $medicine->name;?> details:</h2>
    <div>
       <span class="label">Name</span>
       <span class="value">
         <?= $medicine->name?>
       </span>
    </div>
    <div>
       <span class="label">Quantity</span>
       <span class="value">
         <?=$medicine->quantity?>
       </span>
    </div>
    <div>
       <span class="label">Dosage</span>
       <span class="value">
         <?php echo $medicine->dosage ; ?>
       </span>
    </div>
    <div>
       <span class="label">Medicine Type</span>
       <span class="value">
         <?php if(isset($medicine->medicine_type))echo $medicine->medicine_type ; ?>
       </span>
    </div>
    <div>
       <span class="label">Company Name</span>
       <span class="value">
         <?php echo $medicine->company_name; ?>
       </span>
    </div>
    <div>
       <span class="label">Tags</span>
       <span class="value">
         <?php echo $medicine->tags; ?>
       </span>
    </div>
    <div>
       <span class="label">Notes</span>
       <span class="value">
         <?php echo $medicine->notes; ?>
       </span>
    </div>    
      <table class="t_results">
      <caption>All salts in this medicine</caption>
      <tr>
        <th>Salt Name</th>
        <th>Dosage</th>
      </tr>
    <?if(isset($medicine_salts) && is_array($medicine_salts) && count($medicine_salts)>0):?>
      <?php $count = 1;?>
      <?foreach($medicine_salts as $salt):?>
      <?php
         if ($count%2 == 0) echo "<tr class=\"even\">";
         else echo "<tr class=\"odd\">"; 
         $count++;
      ?>
        
          <td><?=$salt->salt_name?></td>
          <td><?=$salt->dosage?></td>
        </tr>
      <?endforeach?>
    <?else:?>
      <tr>
        <td colspan="7">No medicine in the database</td>
      </tr>
    <?endif?>
    </table>
    
    </div>
  </div>


<?php
$this->load->view('dashboard/structure/_footer');