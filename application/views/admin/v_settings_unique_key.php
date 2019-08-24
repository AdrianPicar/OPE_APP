<div id="main">
<form method="post" action="create_unique_key">
<h1>Generate Unique Key</h1>
<br>

<table>
<tr><td colspan="2"><label><u>Email Address</u></label></td></tr>
<tr>
<td><input size=30 name=email_address value="<?php echo set_value('email_address');?>"></td>
<td><?php echo form_error("email_address");?></td>
</tr>

<tr><td colspan="2"><label><u>Exam Type</u></label></td></tr>
<tr>
<td>
<select name=exam_type>
<?php foreach($exam_types->result() as $row){?>
	<option value="<?php echo $row->type;?>"><?php echo $row->type;?></option>
<?php }?>
</select> 
</td>
</tr>

<tr><td colspan="2"><label><u>Unique Key</u></label></td></tr>
<tr>
<td><input size=30 id=unique_key name=unique_key readonly=true value=<?php echo $this->session->flashdata("unique_key");?>></td>
</tr>

</table>

<div>
<label><?php echo $this->session->flashdata("success");?></label>
</div>

<input class=button type="submit" id=submit name="submit" value="Send" />

</div>
</form>

<script src=<?php echo base_url()."public/js/jquery-1.9.1.min.js";?>></script>