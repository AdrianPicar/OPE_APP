<div id="main">
<form method="post" action="update_email_password">
<h1>Email Address and Password</h1>
<br>

<table>
<tr><td colspan="2"><label><u>Email Address</u></label></td></tr>
<tr>
<td><input size=30 name=email_address value="<?php echo $email_address;?>"></td>
<td><?php echo form_error("email_address");?></td>
</tr>

<tr><td colspan="2"><label><u>Password</u></label></td></tr>
<tr>
<td><input type=password size=30 name=email_password value=""></td>
<td><?php echo form_error("email_password");?></td>
</tr>

<tr><td colspan="2"><label><u>Confirm Password</u></label></td></tr>
<tr>
<td><input type=password size=30 name=email_cpassword value=""></td>
<td><?php echo form_error("email_cpassword");?></td>
</tr>
</table>

<div>
<label><?php echo $this->session->flashdata("success");?></label>
</div>

<input class=button type="submit" id=submit name="submit" value="Save" />

</div>
</form>