<?php
/** 
 * add.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 22, 2010
 */
$this->load->view('dashboard/structure/_header', $title);
$this->load->view('dashboard/structure/_leftmenu', $heading);
?>
	<p class="back"><a href="<?= base_url()?>price">Back to all price listings</a></p>
	  
  <?= form_open(base_url().'price/add')?>
  <fieldset>
    <legend>Medicine price details</legend>
      <div class="formrow">
        <div class="ui-widget">
          <div style="float:left;margin-right:50px;width:180px">
            <strong class="formfield">Medicine *</strong>
            <?=form_input(array('id'=>'medicine', 'name'=>'medicine', 'class' => 'fields'), set_value('medicine') )?>
            <?=form_error('medicine_id', '<p class="msgForm msgError">', '</p>')?>
            <input type="hidden" id="medicine_id" name="medicine_id" value="<?php echo set_value('medicine_id'); ?>"/>
  
            <script type="text/javascript">
            $(function() {
              $( "#medicine" ).autocomplete({
                source: function(req, add)
                {
                  $.ajax({
                    url: '<?php echo site_url('ajax_search/medicine');?>',
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success:function(data)
                    {
                      if(data.response =='true')
                      {
                        add(data.message);
                      }
                    }
                  });
                },
                minLength: 1,
                select: function( event, ui ) 
                {
                  window.document.getElementById("medicine_id").value = ui.item.id;
                }
              });
             });
            </script>
          </div>
          
          <div style="float:left;margin-right:50px;width:180px">
            <strong class="formfield">Store *</strong>
            <?=form_input(array('id'=>'store', 'name'=>'store', 'class' => 'fields'), set_value('store') )?>
            <?=form_error('store_id', '<p class="msgForm msgError">', '</p>')?>
            <?=form_error('chainbg_id', '<p class="msgForm msgError">', '</p>')?>
            <input type="hidden" id="store_id" name="store_id" value="<?php echo set_value('store_id'); ?>"/>
            <input type="hidden" id="chainbg_id" name="chainbg_id" value="<?php echo set_value('chainbg_id'); ?>"/>
          </div>
          
          <div style="float:left;margin-right:50px;width:180px">
            <strong class="formfield">Price *</strong>
            <?=form_input(array('id'=>'price', 'name'=>'price', 'class' => 'fields'), set_value('price') )?>
            <?=form_error('price', '<p class="msgForm msgError">', '</p>')?>
          </div>
          
        </div>
      </div>

     
      <script type="text/javascript">
       $(function() {
        $( "#store" ).autocomplete({
          source: function(req, add)
          {
            $.ajax({
              url: '<?php echo site_url('ajax_search/store_chainbg');?>',
              dataType: 'json',
              type: 'POST',
              data: req,
              success:function(data)
              {
                if(data.response =='true')
                {
                  add(data.message);
                }
              }
            });
          },
          minLength: 1,
          select: function( event, ui ) 
          {
            if(ui.item.type == "Store"){
              window.document.getElementById("store_id").value = ui.item.id;              
            }
            else{
              window.document.getElementById("chainbg_id").value = ui.item.id;
            }
          }
        });
      });
      </script>

			<div class="formrow">
				<?=form_submit(array('name'=>'','class'=>'button', 'value'=> 'Submit'))?>
			</div>
	</fieldset>
	<?= form_close()?>
<?php
$this->load->view('dashboard/structure/_footer');