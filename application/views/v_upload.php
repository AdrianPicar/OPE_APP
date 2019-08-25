</head>
<body>
<?php 
if($table == null){?>
	<h1>Upload Questions</h1>
	<?php echo form_open_multipart('upload/initial_upload');?>
	<table>
	<tr>
	<td><input type="file" name="userfile" size="20" /></td>
	<td><?php echo $error;?></td>
	</tr>
	</table>
	<p>Guidelines:</p>
	<ul>
		<li>File must be in Microsoft Excel format (.xls/.xlsx)</li>
		<li>Column A - contains TEST QUESTIONS</li>
		<li>Column B - contains the CATEGORY (Intelligence, Aptitude, Personality, Engineering)</li>
		<li>Column C - contains the TYPE OF QUESTION (True or False, Multiple Choice, Fill in the Blanks, Multiple Answers)</li>
		<li>Succeeding Columns - OPTION and SCORE respectively </li>
		<li>Column D - Option 1, Column E - Score for Option 1, Column F - Option 2, Column G - Score for Option 2, and so on</li>
	</ul>
	<p>Example:</p>
	<img src='<?php echo base_url('images/sample.jpg')?>'>
	
	<label><?php echo $this->session->flashdata("success");?></label>
	<div>
	<input class=button type="submit" value="Upload" />	
	</div> 
<?php }?>

<?php 
if($table != null){?>
<div id=main_alt>
	<h1>Confirm Upload</h1>
	<?php echo form_open('upload/commit_upload');?> 
	<?php echo $error;?>

<?php 
	if($questions!=null){?>
	<table border=0 cellpadding=0 cellspacing=10 table-layout=fixed width=100%>
	<col width="250">
	<tr>
	<th>Question</th>
	<th>Category</th>
	<th>Type</th>
	<th>Options</th>
	</tr>
<?php 
	for($i=0; $i<count($questions); $i++){?>
		<tr>
		<td><?php echo $questions[$i]['question'];?></td>
		<td><?php echo $questions[$i]['category'];?></td>
		<td><?php echo $questions[$i]['type'];?></td>
		
<?php 
if(isset($questions[$i])){ 
	for($j=0; isset($questions[$i][$j]); $j+=2){
 		if($questions[$i][$j+1]>0){
			echo "<td><b>".$questions[$i][$j]."</b></td>";
			echo "<td><b>".$questions[$i][$j+1]."</b></td>";
		}	
 		else{
			echo "<td>".$questions[$i][$j]."</td>";
			echo "<td>".$questions[$i][$j+1]."</td>";
		}		
 	}
}?>
</tr>
<?php }?>
</table>

<?php if($error==""){?>
<input class=button type="submit" value="Confirm Upload" name="submit"/> 
<?php }?>
<input class=button type="submit" value="Cancel"  name="cancel"/>
<?php }}?>
</div>
