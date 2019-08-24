<html>
<title>Print Exam</title>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
	.container {
		margin-top: none;
	}
	.error {
		color: #B94A48;
	}
	.form-horizontal {
		margin-bottom: 0px;
	}
	.hide{display: none;}
</style>
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
</head>
    
<body>
<input type=button class=button id=print value="Print Page" onclick="printPage();">
<div class="container question">
	<div class="col-xs-12 col-sm-8 col-md-8 col-xs-offset-4 col-sm-offset-3 col-md-offset-3">
		<table>
		<tr>
			<td colspan=2><h3><u>Name:</u> <?php echo $full_name;?></h3></td>
			<td colspan=2><h3><u>Category: <?php echo $category;?></h3></td>
		</tr>
		<tr>
			<td colspan=2><h3><u>Course:</u> <?php echo $course;?></h3></td>
			<td colspan=2><h3><u>School:</u> <?php echo $school;?></h3></td>
		</tr>
		<tr>
			<td colspan=2><h3><u>Birthday:</u> <?php echo $birthdate;?></h3></td>
			<td colspan=2><h3><u>Position Applying For:</u> <?php echo $position;?></h3></td>
		</tr>
		<tr>
			<td colspan=2><h3><u>Contact Number:</u> <?php echo $contact_no;?></h3></td>
			<td colspan=2><h3><u>Address:</u> <?php echo $home_address;?></h3></td>
		</tr>
		<tr>
			<td colspan=2><h3><u>Date of Exam:</u> <?php echo $exam_date;?></h3></td>
		</tr>
		</table>
		
			<hr>
			<form class="form-horizontal" role="form" id='exam'>
			
			<?php
			$i=1;
			foreach($result->result() as $row){?>
            	<div id='question<?php echo $i;?>' class='cont'>
            		<table>        
					<tr>
						<td valign="top"><strong><?php echo $i.". ";?></strong></td>
						<td><strong><?php echo $row->question;?></strong></td>
					</tr>
					</table>
               	<?php if($row->type=="Fill in the Blanks"){?>
                		<?php $answers="";
                   		foreach($result2->result() as $row2){
							if($row->item_id == $row2->item_id)
								if($row2->is_answer == 1){
									echo $row2->option;
								if($row2->score > 0)
									echo "<img src='".base_url()."public/images/correct.png'>";
								}
                   			
                   			if($row->item_id == $row2->item_id){
                    			if($row2->score > 0)	
									$answers .= $row2->option.", ";?>
                  		<?php }}?>
                 		<p>Correct Answer/s: <?php echo substr($answers,0,-2);?></p>
                   	<?php }
                   	
                   	else{
                   		foreach($result2->result() as $row2){
							$answer_correct = false;
                   			if($row->item_id == $row2->item_id){?>
                    			<?php
                    			echo "<table>";
                    			echo "<tr>";
                    			if($row2->is_answer == 1)
                    				echo "<td style='border:solid 2px'>";
                    			else
                    				echo "<td>";
                    			echo $row2->option;
                    			echo "</td>";
                    			echo "<td>";
                    			if($row2->is_answer == 1){
                    				if($row2->score > 0){
                    					echo "<img src='".base_url()."public/images/correct.png'>";
                    					$answer_correct = true;
                    				}
                    				else
                    					echo "<img src='".base_url()."public/images/wrong.png'>";
                    			}
                    			if($row2->score > 0 && !$answer_correct)
                    				echo "<img src='".base_url()."public/images/correct.png'>";
	                    			
                    			echo "</td>";
                    			echo "</tr>";
                    			echo "</table>";
                    			?>
                  		<?php }
                   		}
                   		echo "<br>";
                  	}?>
               </div>
           <?php 
           $i++;        
			}?>
          	</form>
	</div>
</div>
</body>
</html>