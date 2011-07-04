<?php
/** 
 * index.php
 * Description	: Lists all the scripts available
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Jul 1, 2011
 */
$this->load->view('dashboard/structure/_header', $title);
$this->load->view('dashboard/structure/_leftmenu', $heading);
?>
<?if(isset($error)):?>
	<div class="msgError">
		<?php echo $error;?>
	</div>
<?endif ?>

<?if(!isset($upload_data)):?>
  	<fieldset>
	    <legend>Medicine XML</legend>
	
		<?php echo form_open_multipart(base_url().'scripts/do_upload');?>
			<div class="formrow">
				<label class="formfield">Choose the XML data to upload:</label>
				<input name="userfile" size="40" type="file" />
			</div>

			<div class="formrow">
				<?=form_submit(array('name'=>'','class'=>'button', 'value'=> 'Submit'))?>
			</div>
		</form>
	</fieldset>
<?else:?>
	<pre>
		<?php print_r($results); ?>
	</pre>
<?endif?>
<?php
$this->load->view('dashboard/structure/_footer');
