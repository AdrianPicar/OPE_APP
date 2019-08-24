</head>
<body>
<h1>Enter Details</h1>
<?php 
$this->load->helper('form');
echo form_open("applicant/confirm_details");?>

<table>

<tr><td colspan="2"><label><u>Unique Key</u>*</label></td></tr>
<tr>
<td><input size=30 name=unique_key value="<?php echo set_value('unique_key');?>"></td>
<td><?php echo form_error("unique_key");?></td>
</tr>

<tr><td colspan="2"><label><u>Email Address</u>*</label></td></tr>
<tr>
<td><input size=30 name=email_address value="<?php echo set_value('email_address');?>"></td>
<td><?php echo form_error("email_address");?></td>
</tr>

<tr><td colspan="2"><label><u>Password</u>*</label></td></tr>
<tr>
<td><input size=30 type=password name=password></td>
<td><?php echo form_error("password");?></td>
</tr>

<tr><td colspan="2"><label><u>Confirm Password</u>*</label></td></tr>
<tr>
<td><input size=30 type=password name=cpassword></td>
<td><?php echo form_error("cpassword");?></td>
</tr>

<tr><td colspan="2"><label><u>First Name</u>*</label></td></tr>
<tr>
<td><input size=30 name=first_name value="<?php echo set_value('first_name');?>"></td>
<td><?php echo form_error("first_name");?></td>
</tr>

<tr><td colspan="2"><label><u>Middle Name</u></label></td></tr>
<tr>
<td><input size=30 name=middle_name value="<?php echo set_value('middle_name');?>"></td>
<td><?php echo form_error("middle_name");?></td>
</tr>

<tr><td colspan="2"><label><u>Last Name</u>*</label></td></tr>
<tr>
<td><input size=30 name=last_name value="<?php echo set_value('last_name');?>"></td>
<td><?php echo form_error("last_name");?></td>
</tr>

<tr><td colspan="2"><label><u>Address</u>*</label></td></tr>
<tr>
<td><textarea style="width:300px; height:80px; resize:none;" name=home_address value="<?php echo set_value('home_address');?>"></textarea></td>
<td><?php echo form_error("home_address");?></td>
</tr>

<tr><td colspan="2"><label><u>Birthdate</u>*</label></td></tr>
<tr>
<td>
<select id=month name=month>
	<option value=1>January</option>
	<option value=2>February</option>
	<option value=3>March</option>
	<option value=4>April</option>
	<option value=5>May</option>
	<option value=6>June</option>
	<option value=7>July</option>
	<option value=8>August</option>
	<option value=9>September</option>
	<option value=10>October</option>
	<option value=11>November</option>
	<option value=12>December</option>
</select>
<select id=day name=day>
<?php for($i=1; $i<=31; $i++){?>
	<option id=<?php echo $i;?> value=<?php echo $i;?>><?php echo $i;?></option>
<?php }?>
</select>
<select id=year name=year>
<?php for($i=intval(date("Y")); $i>=1901; $i--){?>
	<option value=<?php echo $i;?>><?php echo $i;?></option>
<?php }?>
</select>
</td>
</tr>

<tr><td colspan="2"><label><u>Course</u>*</label></td></tr>
<tr>
<td><input size=30 name=course value="<?php echo set_value('course');?>"></td>
<td><?php echo form_error("course");?></td>
</tr>

<tr><td colspan="2"><label><u>School</u>*</label></td></tr>
<tr>
<td><input size=30 name=school value="<?php echo set_value('school');?>"></td>
<td><?php echo form_error("school");?></td>
</tr>

<tr><td colspan="2"><label><u>Position Applying For</u>*</label></td></tr>
<tr>
<td><input size=30 name=position value="<?php echo set_value('position');?>"></td>
<td><?php echo form_error("position");?></td>
</tr>

<tr><td colspan="2"><label><u>Contact Number</u></label></td></tr>
<tr>
<td><input size=30 name=contact_no value="<?php echo set_value('contact_no');?>"></td>
<td><?php echo form_error("contact_no");?></td>
</tr>

</table>
<p>* - required</p>
<br>
<input class=button type=submit value="Submit">
<input class=button type="reset" name="cancel" value="Back" onclick="window.location = '<?php echo base_url();?>'" />

</form>

<script src=<?php echo base_url()."public/js/jquery-1.9.1.min.js";?>></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#month').bind('click change focus', function(event){
		switch($(this).val()){
			case "2":
				if(($("#year").val()%4) != 0) 
					$("#29").hide();
				$("#30").hide();
				$("#31").hide();
				break;
			case "4":
				$("#29").show();
				$("#30").show();
				$("#31").hide();
				break;
			case "6":
				$("#29").show();
				$("#30").show();
				$("#31").hide();
				break;
			case "9":
				$("#29").show();
				$("#30").show();
				$("#31").hide();
				break;
			case "11":
				$("#29").show();
				$("#30").show();
				$("#31").hide();
				break;
			default:
				$("#29").show();
				$("#30").show();
				$("#31").show();
				break;
		}
		$("#day")[0].selectedIndex = 0;
	})

	$('#year').bind('click change focus', function(event){
		if($("#month").val() == 2){
			if(($(this).val()%4) == 0)
				$("#29").show();
			else
				$("#29").hide();
		}
	})
});
</script>