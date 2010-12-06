<?php
/** 
 * dashboard.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 6, 2010
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<link type="text/css" href="<?php echo base_url(); ?>common/css/admin/style.css" media="screen" rel="stylesheet"/>
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>common/scripts/jquery/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>common/scripts/jquery/jquery.corner.js"></script>
	<title>Admin Home</title>
</head>
<body>
	<div id="content">
		<div id="header">
			<img style="border: solid 1px black" src="<?php echo base_url(); ?>/common/css/admin/images/header.png" alt="Pharmaseek Admin"/>

			<div id="topmenu">
					<div class="mm">
						<a href="#"><span class="main">Link 1<span class="sub">Subtext 1</span></span></a>
					</div>
					<div class="mm">
						<a href="#"><span class="main">Link 2<span class="sub">Subtext 2</span></span></a>
					</div>
					<div class="mm">
						<a href="#"><span class="main">Link 3<span class="sub">Subtext 3</span></span></a>
					</div>
					<div class="mm">
						<a href="#"><span class="main">Link 4<span class="sub">Subtext 4</span></span></a>
					</div>
					<div class="mm">
						<a href="#"><span class="main">Link 5<span class="sub">Subtext 5</span></span></a>
					</div>
					<div class="mm">
						<a href="#"><span class="main">Link 6<span class="sub">Subtext 6</span></span></a>
					</div>
			</div>
		</div>

		<div id="mainmenu">
			<div id="breadcrumb">
					<ul>
						<li><a href="#">Admin Home</a></li>
					</ul>
					<div class="admin_user">
						<ul>
							<li>Hello <em>	<?= $this->session->userdata('firstname')." ".$this->session->userdata('lastname') ?></em></li>
							<li><?php echo anchor('logout','Logout'); ?></li>
							<li><a href="#">Change password</a></li>
						</ul>
					</div>
			</div>

			<div id="colCenter">
				<script type="text/javascript">
					$('h1 span.text').corner("round 20px tr");
				</script>
					<h1><span class="text">Welcome to Admin Dashboard</span></h1>
<!-- 
<ul>
	<?= "<li>id : ".$this->session->userdata('id')."</li>" ?>					
	<?= "<li>username : ".$this->session->userdata('username')."</li>" ?>					
	<?= "<li>email : ".$this->session->userdata('email')."</li>" ?>					
	<?= "<li>firstname : ".$this->session->userdata('firstname')."</li>" ?>					
	<?= "<li>lastname : ".$this->session->userdata('lastname')."</li>" ?>					
	<?= "<li>type : ".$this->session->userdata('type')."</li>" ?>					
</ul>
 -->					
					<table style="width:100%">
						<tr>
							<th style="width:33%">Stores</th>
							<th style="width:33%">Prices</th>
							<th>Medicines</th>
						</tr>
						<tr>
							<td>
								<ul>
									<li><a href="<?php echo base_url()?>whchain">Create/Remove/Update/Delete Warehouses</a></li>
									<li>Add New Store Details</li>
									<li>Edit Current Store Details</li>
									<li>Add Store to Chain</li>
									<li>Add New to Banner Group</li>
									<li>Cancel/Remove Store</li>
									<li>Create Store Account</li>
									<li>List of Store Page</li>
									<li>Search for Stores</li>
								</ul>
							</td>
							<td>
								<em>Phase 1 - part 3</em>
							</td>
							<td>
								<em>Phase 1 - part 2</em>
							</td>
						</tr>
					</table>
			</div>
		</div>
		<div id="footer">
			<p><strong><a href="#">Pharmaseek Home</a> | 
			<a href="#">Admin Home</a>
			</strong>
			</p><br/>
			<p>&copy; 2010 Pharmaseek.com.au | Web Design by <a href="http://www.harmandhillon.com">HarmanDhillon</a></p>
		</div>
	</div>
</body>
</html>