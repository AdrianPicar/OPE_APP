</head>
<body>
<div id="main">
<h1>Login</h1>
<?php
$this->load->helper('form');

echo form_open("login/login_validation");
?>
<table>
				
<tr colspan=2>
<td><label>Username/Email Address</label></td>
</tr>

<tr>
<td><input size=30 name=username id=username value="<?php echo set_value('username');?>"></td>
<td><?php echo form_error("username");?></td>
</tr>

<tr colspan=2>
<td><label>Password</label></td>
</tr>

<tr>
<td><input size=30 type=password name=password id=password></td>
<td><?php echo form_error("password");?></td>
</tr>
</table>
<br/>

<input class=button type=submit value="Login"/>
<br/>
<br/>
<label>New Applicant? <a href=<?php echo base_url()."applicant/enter_details";?>>Register</a></label>

</form>
</div>