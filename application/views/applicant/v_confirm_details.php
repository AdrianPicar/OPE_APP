</head>
<body>
<h1>Confirm Details</h1>
<?php 
$this->load->helper('form');
echo form_open("applicant/add_details");

$string = "";
for($i=0; $i<strlen($password); $i++)
	$string .= "*";
?>

<table>
<col width="250">

<tr>
<td>
<label><u>Email Address:</u> <?php echo $email_address;?></label>
</td>

<td>
<label><u>Password:</u> <?php echo $string;?></label>
</td>
</tr>

<tr>
<td>
<label><u>First Name:</u> <?php echo $first_name;?></label>
</td>

<td>
<label><u>Course:</u> <?php echo $course;?></label>
</td>
</tr>

<tr>
<td>
<label><u>Middle Name:</u> <?php echo $middle_name;?></label>
</td>


<td>
<label><u>School:</u> <?php echo $school;?></label>
</td>
</tr>

<tr>
<td>
<label><u>Last Name:</u> <?php echo $last_name;?></label>
</td>

<td>
<label><u>Position Applying For:</u> <?php echo $position;?></label>
</td>
</tr>

<tr>
<td>
<label><u>Birthdate:</u> <?php echo $birthdate;?></label>
</td>

<td>
<label><u>Contact Number:</u> <?php echo $contact_no;?></label>
</td>
</tr>

<tr>
<td>
<label><u>Address:</u> <?php echo $home_address;?></label>
</td>
</tr>

</table>
<br>

<input class=button type=submit value=Confirm>
<input class=button type=reset value=Cancel onclick="window.location = '<?php echo base_url()."applicant/enter_details";?>'">

<?php
$values=array(
		'email_address' => $email_address,
		'password' => $password,
		'first_name' => $first_name,
		'middle_name' => $middle_name,
		'last_name' => $last_name,
		'home_address' => $home_address,
		'birthdate' => $birthdate,
		'course' => $course,
		'school' => $school,
		'position' => $position,
		'contact_no' => $contact_no
);
echo form_hidden($values);
?>
</form>