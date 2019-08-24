<h1>Edit Admin Details</h1>
<form method=post action="<?php echo base_url("hr_admin/update_admin");?>">
<table>
<tr><td colspan="2"><label><u>Username</u>*</label></td></tr>
<tr>
<td><input size=30 name=username value="<?php echo $username;?>"></td>
<td><?php echo form_error("username");?></td>
</tr>

<tr><td colspan="2"><label><u>Password</u>*</label></td></tr>
<tr>
<td><input size=30 name=password value="<?php echo $password;?>"></td>
<td><?php echo form_error("password");?></td>
</tr>

<tr><td colspan="2"><label><u>Name</u>*</label></td></tr>
<tr>
<td><input size=30 name=name value="<?php echo $name;?>"></td>
<td><?php echo form_error("name");?></td>
</tr>
</table>
<p>* - required</p>
<br>
<input style=display:none name=old_username value="<?php echo $username;?>">
<input class=button type=submit value="Submit">
<input class=button type="reset" name="cancel" value="Cancel" onclick="window.location = '<?php echo base_url("hr_admin/view_admins");?>'" />
</form>