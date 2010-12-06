<?php
/**
 * dash.php
 * Description	:
 *
 *
 * Created by	: Harman Dhillon
 * Created on 	: Nov 4, 2010
 */
$this->load->view('dashboard/_header', $title);
?>
<div id="main">
	<div id="content">
		<div class="jquery_tab">
			<div class="content_block">
				<h2 class="jquery_tab_title"><?php echo $heading?></h2>

				<a class="dashboard_button button1" href="<?php echo base_url()?>whchain">
					<span class="dashboard_button_heading">Chains</span>
					<span>Create Remove Update Delete chains</span>
				</a><!--end dashboard_button-->

				<a class="dashboard_button button2" href="#">
					<span class="dashboard_button_heading">Settings</span>
					<span>Edit various advanced settings and Options</span>
				</a><!--end dashboard_button-->
				
				<a class="dashboard_button button5" href="#">
					<span class="dashboard_button_heading">Search</span>
					<span>Basic and advanced search area</span>
				</a><!--end dashboard_button-->

				<a class="dashboard_button button10" href="#">
					<span class="dashboard_button_heading two_lines">User Manager</span>
					<span>Add and edit user settings</span>
				</a><!--end dashboard_button-->
				
				<a class="dashboard_button button12" href="#">
					<span class="dashboard_button_heading">Help</span>
					<span>Tutorial on how to use out scripts</span>
				</a><!--end dashboard_button-->


				<h2>Latest Informations</h2>
				<div class="content-box box-grey">
					<h4>Welcome to Admin Interface</h4>
					<p>This will be our admin interface.</p>
					<h4>Latest Comments from developer</h4>
					<p>Please check if this stylesheets are good. If you like them, 
					we will have to <a href="http://themeforest.net/item/flexy-liquid-admin-skin-7-in-1/46398">
					buy these stylesheets for $15</a></p>
				</div>

				<div class="content-box box2">
					<h4>Last Five Updates?</h4>
					<ul style="margin-left: 20px">
						<li>Lat-Lng values now calculates, stored and used</li>
						<li>Google Maps support added</li>
						<li>CSS for admin section added (for preview only)</li>
						<li>Chain Update Suburb bug fixed</li>
						<li>Changed name for warehouse to chain</li>
						<li>Warehouse CRUD added</li>
					</ul>
				</div>
			</div><!--end content_block-->
		</div><!-- end jquery_tab -->
	</div><!--end content-->
</div><!--end main-->
<?php
$this->load->view('dashboard/_leftmenu', array('dashboard' => false));
$this->load->view('dashboard/_footer');
