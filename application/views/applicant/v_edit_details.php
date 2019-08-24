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
<h1>Edit Applicant Details</h1>
<?php 
$this->load->helper('form');
echo form_open("applicant/update_applicant_details");?>

<table>

<tr><td colspan="2"><label><u>First Name</u>*</label></td></tr>
<tr>
<td><input size=30 name=first_name value="<?php echo $first_name;?>"></td>
<td><?php echo form_error("first_name");?></td>
</tr>

<tr><td colspan="2"><label><u>Middle Name</u></label></td></tr>
<tr>
<td><input size=30 name=middle_name value="<?php echo $middle_name;?>"></td>
<td><?php echo form_error("middle_name");?></td>
</tr>

<tr><td colspan="2"><label><u>Last Name</u>*</label></td></tr>
<tr>
<td><input size=30 name=last_name value="<?php echo $last_name;?>"></td>
<td><?php echo form_error("last_name");?></td>
</tr>

<tr><td colspan="2"><label><u>Address</u>*</label></td></tr>
<tr>
<td><textarea style="width:300px; height:80px; resize:none;" name=home_address><?php echo $home_address;?></textarea></td>
<td><?php echo form_error("home_address");?></td>
</tr>

<tr><td colspan="2"><label><u>Birthdate</u>*</label></td></tr>
<tr>
<td>
<select id=month name=month>
	<option <?php if($month == 1) echo "selected=true";?> value=1>January</option>
	<option <?php if($month == 2) echo "selected=true";?> value=2>February</option>
	<option <?php if($month == 3) echo "selected=true";?> value=3>March</option>
	<option <?php if($month == 4) echo "selected=true";?> value=4>April</option>
	<option <?php if($month == 5) echo "selected=true";?> value=5>May</option>
	<option <?php if($month == 6) echo "selected=true";?> value=6>June</option>
	<option <?php if($month == 7) echo "selected=true";?>  value=7>July</option>
	<option <?php if($month == 8) echo "selected=true";?> value=8>August</option>
	<option <?php if($month == 9) echo "selected=true";?> value=9>September</option>
	<option <?php if($month == 10) echo "selected=true";?> value=10>October</option>
	<option <?php if($month == 11) echo "selected=true";?> value=11>November</option>
	<option <?php if($month == 12) echo "selected=true";?> value=12>December</option>
</select>
<select id=day name=day>
<?php for($i=1; $i<=31; $i++){?>
	<option <?php if($i == $day) echo "selected=true";?> id=<?php echo $i;?> value=<?php echo $i;?>><?php echo $i;?></option>
<?php }?>
</select>
<select id=year name=year>
<?php for($i=intval(date("Y")); $i>=1901; $i--){?>
	<option <?php if($i == $year) echo "selected=true";?>  value=<?php echo $i;?>><?php echo $i;?></option>
<?php }?>
</select>
</td>
</tr>

<tr><td colspan="2"><label><u>Course</u>*</label></td></tr>
<tr>
<td><input size=30 name=course value="<?php echo $course;?>"></td>
<td><?php echo form_error("course");?></td>
</tr>

<tr><td colspan="2"><label><u>School</u>*</label></td></tr>
<tr>
<td><input size=30 name=school value="<?php echo $school;?>"></td>
<td><?php echo form_error("school");?></td>
</tr>

<tr><td colspan="2"><label><u>Position Applying For</u>*</label></td></tr>
<tr>
<td><input size=30 name=position value="<?php echo $position;?>"></td>
<td><?php echo form_error("position");?></td>
</tr>

<tr><td colspan="2"><label><u>Contact Number</u></label></td></tr>
<tr>
<td><input size=30 name=contact_no value="<?php echo $contact_no;?>"></td>
<td><?php echo form_error("contact_no");?></td>
</tr>

</table>
<p>* - required</p>
<br>
<input class=button type=submit value="Submit">
<input class=button type="reset" name="cancel" value="Cancel" onclick="window.location = '<?php echo base_url()."applicant/view_applicant_info";?>'" />
</form>
</div>

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