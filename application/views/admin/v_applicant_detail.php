</head>
<body>
<h1>Applicant Detail</h1>
<?php 
$this->load->helper('form');
foreach($details->result() as $row){
$applicant_id = $row->applicant_id;
$exam_id = $row->exam_id;
$this->session->set_userdata("exam_id", $exam_id);?>

<form action="admin/view_applicants" method=post>
<table>
<col width="250">
<tr>
<td>
<label><u>First Name:</u> <?php echo $row->first_name;?></label>
</td>

<td>
<label><u>Course:</u> <?php echo $row->course;?></label>
</td>
</tr>

<tr>
<td>
<label><u>Middle Name:</u> <?php echo $row->middle_name;?></label>
</td>


<td>
<label><u>School:</u> <?php echo $row->school;?></label>
</td>
</tr>

<tr>
<td>
<label><u>Last Name:</u> <?php echo $row->last_name;?></label>
</td>

<td>
<label><u>Position Applying For:</u> <?php echo $row->position;?></label>
</td>
</tr>

<tr>
<td>
<label><u>Birthdate:</u> <?php echo $row->birthdate;?></label>
</td>

<td>
<label><u>Contact Number:</u> <?php echo $row->contact_no;?></label>
</td>
</tr>

<tr>
<td>
<label><u>Address:</u> <?php echo $row->home_address;?></label>
</td>
</tr>

<?php }
if($row->created_on != null){
?>
<tr>
<td>
<label><u>Exam Taken On:</u> </label>
<label><?php echo $row->created_on;?></label>
</td>
</tr>
<?php }?>
<tr>
<td>
<label><u>Email Address:</u> <?php echo $row->username;?></label>
</td>
<td>
<label><u>Password:</u> <?php echo $row->password;?></label>
</td>
</tr>
</table>
<br>

<table border=0 cellpadding=0 cellspacing=10 table-layout=fixed width=70%>
<tr class='heading'>
<th align=center>Category</th>
<th align=center>Score</th>
<th align=center>Percentage</th>
<th align=center>Classification</th>
<th></th>
</tr>
 	<?php 
 	foreach($result->result() as $row){
		switch($row->remark)
		{
			case "PASSED": $color="66FFFF";
			break;
			case "FAILED": $color="FFCCCC";
			break;
			default: $color="white";
			break;
		}?>
			
	<tr bgcolor="<?php echo $color;?>">
	<td><?php echo $row->category;?></td>
	<td align=center><?php echo ($row->score==null)? "N/A":$row->score;?></td>
	<td align=center><?php echo ($row->percentage==null)? "N/A":$row->percentage;?></td>
	<td align=center><?php echo ($row->classification==null)? "N/A":$row->classification;?></td>
	<?php if($row->score==null){?>
		<td align=center>N/A</td>
	<?php }else{?>
		<?php $link = base_url()."admin/view_applicant_exam/".$exam_id."/".$row->category;?>
		<td align=center><a href="<?php echo $link;?>">View Exam</a></td>
	<?php }?>
	</tr>
<?php	
	}?>
	<table>
	<tr colspan=2>
	<td><label>Legend:</label></td>
	</tr>
		
	<tr>
	<td><div style="background-color:#66FFFF;width:50px;height:20px;"></td>
	<td>- PASSED</td>
	</tr>
	
	<tr>
	<td><div style="background-color:#FFCCCC;width:50px;height:20px;"></td>
	<td>- FAILED</td>
	</tr>
	
	<tr>
	<td><div style="background-color:white;width:50px;height:20px;"></td>
	<td>- NOT TAKEN</td>
	</tr>
	</table>
</table>
<br/>
<label><?php echo $this->session->flashdata("success");?></label>
<input type=reset class=button value="Edit Details" onclick="window.location = '<?php echo base_url("admin/edit_applicant_details/".$applicant_id);?>'">
<input type=reset class=button value="Print Details" onclick="window.location = '<?php echo base_url("admin/print_applicant_details/".$exam_id);?>'">
<input type=reset class=button value=Back onclick="window.location = '<?php echo base_url("admin/view_applicants");?>'">
</form>