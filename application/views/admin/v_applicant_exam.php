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
</head>
    
<body>
<div class="container question">
	<div class="col-xs-12 col-sm-8 col-md-8 col-xs-offset-4 col-sm-offset-3 col-md-offset-3">
		<h1><?php echo $full_name;?></h1>
			<hr>
			<form class="form-horizontal" role="form" id='exam' method="post" action="../../print_exam">
			<h1><?php echo $category;?> Exam</h1>
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
										echo "<img src='".base_url()."images/correct.png'>";
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
                    					echo "<img src='".base_url()."images/correct.png'>";
                    					$answer_correct = true;
                    				}
                    				else
                    					echo "<img src='".base_url()."images/wrong.png'>";
                    			}
                    			if($row2->score > 0 && !$answer_correct)
                    				echo "<img src='".base_url()."images/correct.png'>";
	                    			
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
			<br>
			<?php 
			$this->session->userdata("applicant_id");
			$this->session->set_userdata("category", $category);
			?>
			<input type=submit class=button value="View Printable Version">
			<input type=reset class=button value=Back onclick="window.location = '<?php echo base_url("admin/view_applicant_details/".$this->session->userdata("exam_id"));?>'">
          	</form>
	</div>
</div>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src=<?php echo base_url()."scripts/jquery-1.9.1.min.js";?>></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!--  <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>-->