<html>
<title>Print Applicant Details</title>
<head>
<script type="text/javascript">
function printPage() {
	//Get the print button and put it into a variable
	var printButton = document.getElementById("print");
	//Set the print button visibility to 'hidden' 
	printButton.style.visibility = 'hidden';
	//Print the page content
	window.print()
	//Set the print button to 'visible' again 
	//[Delete this line if you want it to stay hidden after printing]
	printButton.style.visibility = 'visible';
    }
</script>
<style>
@page { margin: 0; }
body { margin: 1.6cm; }
</style>
</head>
<body class=header>
<input type=button class=button id=print value="Print Page" onclick="printPage();">
<?php 
foreach($details->result() as $row){
$applicant_id = $row->applicant_id;
?>
<table>
<col width="300">
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
if($row->created_on!=null){
?>
<tr>
<td>
<label><u>Exam Taken On:</u> </label>
<label><?php echo $row->created_on;?></label>
</td>
</tr>
<?php }?>

</table>
<br>

<table border=1 table-layout=fixed width=100%>
<tr class='heading'>
<th align=center>Name of Exam</th>
<th align=center>Raw Score</th>
<th align=center>Percentage</th>
<th align=center>Classification</th>
</tr>
 	<?php 
 	foreach($result->result() as $row){
	?>
	<tr>
	<td style="padding:50px;" align=center><?php echo $row->category;?></td>
	<td align=center><?php echo ($row->score==null)? "N/A":$row->score;?></td>
	<td align=center><?php echo ($row->percentage==null)? "N/A":$row->percentage;?></td>
	<td align=center><?php echo ($row->classification==null)? "N/A":$row->classification;?></td>
	</tr>
<?php	
	}?>
</table>
<br/>
</body>
</html>