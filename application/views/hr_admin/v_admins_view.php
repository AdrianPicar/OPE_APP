</head>
<div id="main">
<h1>View Admins</h1>
<form id=form_delete method=post action=delete_admin>
<table border=0 cellpadding=0 cellspacing=10 table-layout=fixed width=100%>
<tr class='heading'>
<th align=center>Username</th>
<th align=center>Password</th>
<th align=center style="width:50%">Name</th>
<th></th>
</tr>
 	<?php 
 	foreach($result->result() as $row){
	?>
	<tr>
		<td align=center><?php echo $row->username;?></td>
		<td align=center><?php echo $row->password;?></td>
		<td align=center><?php echo $row->name;?></td>
		<td align=center><a href="<?php echo "edit_admin/".$row->username;?>">Edit</a>
		<td align=center><a id="<?php echo $row->username;?>" class=delete href=#>Delete</a>
	</tr>
	<?php }?>
</table>
<label><?php echo $this->session->flashdata("success");?></label>
<input id=username style=display:none value="" name=username>
</form>

<?php if($result->num_rows() < 3){?>
<h1>Add New Admin</h1>
<form method=post action="add_admin">
<table>
<tr><td colspan="2"><label><u>Username</u>*</label></td></tr>
<tr>
<td><input size=30 name=username value="<?php echo set_value('username');?>"></td>
<td><?php echo form_error("username");?></td>
</tr>

<tr><td colspan="2"><label><u>Password</u>*</label></td></tr>
<tr>
<td><input size=30 name=password value="<?php echo set_value('password');?>"></td>
<td><?php echo form_error("password");?></td>
</tr>

<tr><td colspan="2"><label><u>Name</u>*</label></td></tr>
<tr>
<td><input size=30 name=name value="<?php echo set_value('name');?>"></td>
<td><?php echo form_error("name");?></td>
</tr>
</table>
<p>* - required</p>
<br>
<input class=button type=submit value="Submit">
</form>
<?php }?>
</div>
<script src=<?php echo base_url()."public/js/jquery-1.9.1.min.js";?>></script>  
<script>
$(document).ready(function(){
	$(document).on('click','.delete',function(e){
		e.preventDefault();
		var result = confirm("Want to delete?");
		if (result==true){
			$('#username').val($(this).attr('id'));
			$("#form_delete").submit();
		}
	});
});
</script>