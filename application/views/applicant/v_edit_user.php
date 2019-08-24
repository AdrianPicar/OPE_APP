</head>
<body>
<div id=sidebar>
<h1>Edit Details</h1>
	<ul class="sidemenu">
		<li><a href="edit_applicant_details">Edit Applicant Details</a></li>
		<li><a href="edit_user_details">Edit Email Address and Password</a></li>
	</ul>	
</div>
<div id="main">
<h1>Edit Email Address and Password</h1>
<?php 
$this->load->helper('form');
echo form_open("applicant/update_user_details");?>

<table>

<tr><td colspan="2"><label><u>Email Address</u>*</label></td></tr>
<tr>
<td><input size=30 name=email_address value="<?php echo $email_address;?>"></td>
<td><?php echo form_error("email_address");?></td>
</tr>

<input style=display:none name=email_address_hidden value="<?php echo $email_address;?>">

<tr><td colspan="2"><label><u>Old Password</u>*</label></td></tr>
<tr>
<td><input size=30 type=password name=old_password ></td>
<td><?php echo form_error("old_password");?></td>
</tr>

<input style=display:none name=old_password_hidden value=<?php echo $password;?>>

<tr><td colspan="2"><label><u>New Password</u>*</label></td></tr>
<tr>
<td><input size=30 type=password name=password ></td>
<td><?php echo form_error("password");?></td>
</tr>

<tr><td colspan="2"><label><u>Confirm New Password</u>*</label></td></tr>
<tr>
<td><input size=30 type=password name=cpassword></td>
<td><?php echo form_error("cpassword");?></td>
</tr>

</table>
<p>* - required</p>
<br>
<input class=button type=submit value="Submit">
<input class=button type="reset" name="cancel" value="Cancel" onclick="window.location = '<?php echo base_url()."applicant/view_applicant_info";?>'" />
</form>
</div>