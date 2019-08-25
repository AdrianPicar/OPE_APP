<!DOCTYPE html>
<html>
<head>
<!--  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<title><?php echo $title;?></title>
<link rel="stylesheet" type="text/css" media="screen" href=<?php echo base_url();?>styles/style.css />

<div id="wrap"><!-- wrap starts here -->
		
	<div id="header">
		<?php if ($this->session->userdata('is_logged_in') == true){?>
		<form class="search">
		<h1>Welcome <?php echo $this->session->userdata('name');?></h1>
		</form>
		<?php }?>	
								
		<!--  <h1 id="logo">OPE<span>APP</span></h1> -->
		<h1 id="logo"><img src='<?php echo base_url('images/logo.png')?>'>OPE<span>APP</span></h1>	
	</div>
		<?php  ?>
	<div id="menu">
		<ul>
		<?php 
		if ($this->session->userdata('is_logged_in') == true){
			if($this->session->userdata('type') == "applicant"){
				if(substr($title, -4, 4)!="Exam"){?>
					<li name="home" <?php if($title=="Home") echo "id=\"current\"";?>>
					<a href=<?php echo base_url()."applicant/home";?>>Home</a></li>
					<li name="details" <?php if($title=="Applicant Information") echo "id=\"current\"";?>>
					<a href="view_applicant_info">Applicant Information</a></li>
					<li name="exam" <?php if($title=="Instructions") echo "id=\"current\"";?>>
					<a href="view_instructions">Take Exam</a></li>
		<?php }}
			else {?>
				<li name="home" <?php if($title=="Home") echo "id=\"current\"";?>>
				<a href=<?php echo base_url()."admin/home";?>>Home</a></li>
				<li name="view_applicants" <?php if($title=="View Applicants") echo "id=\"current\"";?>>
				<a href=<?php echo base_url()."admin/view_applicants";?>>Applicants</a></li>	
				<li name="view_questions" <?php if($title=="View Questions") echo "id=\"current\"";?>>
				<a href=<?php echo base_url()."admin/view_questions";?>>Questions</a></li>
				<li name="edit_settings" <?php if($title=="Edit Settings") echo "id=\"current\"";?>>
				<a href=<?php echo base_url()."settings/edit_display_message";?>>Settings</a></li>
				<?php if($this->session->userdata('type') == "hr_admin"){?>
				<li name="view_admins" <?php if($title=="View Admins") echo "id=\"current\"";?>>
				<a href=<?php echo base_url()."hr_admin/view_admins";?>>Users</a></li>
		<?php }
		}?>
		</ul>		
		<ul id="logout">
		<li name="logout">
				<a href=<?php echo base_url().$this->session->userdata('type')."/logout";?>>Logout</a></li>			
		</ul>
		<?php }?>	
	</div>