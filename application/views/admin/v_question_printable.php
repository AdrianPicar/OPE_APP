<html>
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
		<h1><?php echo $category;?> Questions</h1>
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
                   	if($row->question_id == $row2->question_id){
						$points=($row2->score==1)? " pt.":" pts.";
                   		$answers .= $row2->option." - ".$row2->score.$points.", ";?>
                  	<?php }}?>
                 	<p>Correct Answer/s: <?php echo substr($answers,0,-2); echo "<img src='".base_url()."images/correct.png'>";?></p>
                   	<?php }
                   	else{
                   		foreach($result2->result() as $row2){
                   			if($row->question_id == $row2->question_id){?>
                   				<table>
                   				<tr>
                  				<td>
                    				<?php echo $row2->option;?>
                   				</td>
                   				<td>
                   					<?php
                   					$points=($row2->score==1)? " pt.":" pts.";
                   					echo " - ".$row2->score.$points;
                    				if($row2->score >= 1)
										echo "<img src='".base_url()."images/correct.png'>";
                    			?>
                   				</td>
                   				</tr>
                   				</table>
                  		<?php }
                   		}?>
                   		<br>
             <?php }?>
               </div>
           <?php 
           $i++;        
			}?>
          	</form>
	</div>
</div>
</body>
</html>