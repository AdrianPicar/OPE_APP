<!---
Site : http:www.smarttutorials.net
Author :muni
--->
  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript">
var minutes = Math.floor((<?php echo $time_limit;?>)/60)
var seconds = (<?php echo $time_limit;?>)%60

function setCountDown(){
	seconds--;
		if (seconds < 0){
		    minutes--;
		    seconds = 59
		}
	var time;
	seconds < 10 ? time="0" : time="";
	document.getElementById("remain").innerHTML = minutes+":"+time+seconds;
	SD=window.setTimeout( "setCountDown()", 1000 );
	if (minutes == '00' && seconds == '00'){ 
		seconds = "00"; 
		window.clearTimeout(SD);
	 	setTimeout(function(){document.getElementById("exam").submit()}, 600);
	} 
}
</script>
        
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
	.time{
		margin-top: 10px;
		position:relative;
		left: 775px;
		font-size: 200%;
	}
	.hide{display: none;}
</style>
</head>
    
<body onload="setCountDown()">
<div class="time" id="remain"><?php echo "";?></div>
<div class="container question">
	<div class="col-xs-12 col-sm-8 col-md-8 col-xs-offset-4 col-sm-offset-3 col-md-offset-3">
		<h1><?php echo $category;?> Exam</h1>
			<hr>
			<form class="form-horizontal" role="form" id='exam' method="post" action="submit_answers">
			<?php
			$i=1;
			foreach($result->result() as $row){
				if($i==1){ $j=1;?>
					<div id='question<?php echo $i;?>' class='cont'>
					<table>        
					<tr>
						<td><?php echo $i.". ";?></td>
						<td><?php echo $row->question;?></td>
					</tr>
					</table>
					<?php if ($row->type=="Fill in the Blanks"){?>
                   		<input type=text id='radio1_<?php echo $row->question_id;?>' name='answer_<?php echo $i;?>'/>
                   		<?php $answers="";
                   		foreach($result2->result() as $row2){
                   			if($row->question_id == $row2->question_id){
                    			$answers .= $row2->option.", ";?>
                    			<input style=display:none name='option_<?php echo $i;?>_<?php echo $j;?>' value="<?php echo $row2->option;?>">
                   				<input style=display:none name='score_<?php echo $i;?>_<?php echo $j;?>' value="<?php echo $row2->score;?>">
                   				<?php $j++;?>
                  		<?php }}?>
                  		<label><?php echo $answers?></label>
                   		<br/>
                   	<?php }else{?>
                   		<table>
                   		<?php foreach($result2->result() as $row2){
                   			if($row->question_id == $row2->question_id){?>
                  				<tr>
                  				<td><?php echo $row2->score;?></td>
                  				<td>
                    			<?php if($row->type=="Multiple Answers"){?>
                  					<input type=checkbox value=<?php echo $row2->option_id;?> id='radio1_<?php echo $row->question_id;?>' name="answer_<?php echo $i;?>[]"/>
                    			<?php }else{?>	
                    				<input type=radio value=<?php echo $row2->option_id;?> id='radio1_<?php echo $row->question_id;?>' name='answer_<?php echo $i;?>'/>
                   				<?php }?>
                   				</td>
                   				<td>
                   					<?php echo $row2->option;?>
                   				</td>
                   				<input style=display:none name='option_<?php echo $i;?>_<?php echo $j;?>' value='<?php echo $row2->option;?>'>
                   				<input style=display:none name='score_<?php echo $i;?>_<?php echo $j;?>' value="<?php echo $row2->score;?>">
                   				<?php $j++;?>
                   				</tr>
                  		<?php }?>
                   	<?php }?>
                  		</table>
                  		<br/>
                  		<?php if($row->type=="Multiple Answers"){ ?>
                  			<input type="radio" checked='checked' style='display:none' value="no_answer" id='radio1_<?php echo $row->question_id;?>_0' name='answer_<?php echo $i;?>[]'/>
                  	 	<?php }else{?>
                  			<input type="radio" checked='checked' style='display:none' value="no_answer" id='radio1_<?php echo $row->question_id;?>_0' name='answer_<?php echo $i;?>'/>
                  	 	<?php }?>
                  <?php }?>
                    <input type="text" style='display:none' value='<?php echo $row->question_id;?>' id='text_<?php echo $row->question_id;?>' name='question_<?php echo $i;?>'/>
                  	<button id='next<?php if($i<100) echo "0"; if($i<10) echo "0"; echo $i;?>' class='next btn btn-success' type='button'>Next</button>
                    </div>    
 
			<?php 
				}elseif($i<1 || $i<$rows){ $j=1;?>
					<div id='question<?php echo $i;?>' class='cont'>
                    <table>        
					<tr>
						<td><?php echo $i.". ";?></td>
						<td><?php echo $row->question;?></td>
					</tr>
					</table>
					<?php if ($row->type=="Fill in the Blanks"){?>
                   		<input type=text id='radio1_<?php echo $row->question_id;?>' name='answer_<?php echo $i;?>'/>
                   		<?php $answers="";
                   		foreach($result2->result() as $row2){
                   			if($row->question_id == $row2->question_id){
                    			$answers .= $row2->option.", ";?>
                    			<input style=display:none name='option_<?php echo $i;?>_<?php echo $j;?>' value="<?php echo $row2->option;?>">
                   				<input style=display:none name='score_<?php echo $i;?>_<?php echo $j;?>' value="<?php echo $row2->score;?>">
                  				<?php $j++;?>
                  		<?php }}?>
                  		<label><?php echo $answers?></label>
                   		<br/>
                   	<?php }else{ ?>
                   		<table>
                   		<?php foreach($result2->result() as $row2){
                   			if($row->question_id == $row2->question_id){?>
                  				<tr>
                  				<td><?php echo $row2->score;?></td>
                  				<td>
                  				<?php if($row->type=="Multiple Answers"){?>
                  					<input type=checkbox value=<?php echo $row2->option_id;?> id='radio1_<?php echo $row->question_id;?>' name='answer_<?php echo $i;?>[]'/>
                    			<?php }else{?>	
                    				<input type=radio value=<?php echo $row2->option_id;?> id='radio1_<?php echo $row->question_id;?>' name='answer_<?php echo $i;?>'/>
                   				<?php }?>
                   				</td>
                   				<td>
                   					<?php echo $row2->option;?>
                   				</td>
                   				<input style=display:none name='option_<?php echo $i;?>_<?php echo $j;?>' value='<?php echo $row2->option;?>'>
                   				<input style=display:none name='score_<?php echo $i;?>_<?php echo $j;?>' value="<?php echo $row2->score;?>">
                   				<?php $j++;?>
                   				</tr>
                  		<?php }?>
                   	<?php }?>
                  		</table>
                  		<br/>
                  		<?php if($row->type=="Multiple Answers"){ ?>
                  			<input type="radio" checked='checked' style='display:none' value="no_answer" id='radio1_<?php echo $row->question_id;?>_0' name='answer_<?php echo $i;?>[]'/>
                  	 	<?php }else{?>
                  			<input type="radio" checked='checked' style='display:none' value="no_answer" id='radio1_<?php echo $row->question_id;?>_0' name='answer_<?php echo $i;?>'/>
                  	 	<?php }?>
                  <?php }?>
                    <input type="text" style='display:none' value='<?php echo $row->question_id;?>' id='text_<?php echo $row->question_id;?>' name='question_<?php echo $i;?>'/>
                  	<?php if($category != "Intelligence"){?>
                  	<button id='pre<?php if($i<100) echo "0"; if($i<10) echo "0"; echo $i;?>' class='previous btn btn-success' type='button'>Previous</button>
                  	<?php }?>
                  	<button id='next<?php if($i<100) echo "0"; if($i<10) echo "0"; echo $i;?>' class='next btn btn-success' type='button'>Next</button>
                    </div>   
                                                                                                 
            <?php 
            	}elseif($i==$rows){ $j=1;?>
                   	<div id='question<?php echo $i;?>' class='cont'>
                   	<table>        
					<tr>
						<td><?php echo $i.". ";?></td>
						<td><?php echo $row->question;?></td>
					</tr>
					</table>
					<?php if ($row->type=="Fill in the Blanks"){?>
                   		<input type=text id='radio1_<?php echo $row->question_id;?>' name='answer_<?php echo $i;?>'/>
                   		<?php $answers="";
                   		foreach($result2->result() as $row2){
                   			if($row->question_id == $row2->question_id){
                    			$answers .= $row2->option.", ";?>
                    			<input style=display:none name='option_<?php echo $i;?>_<?php echo $j;?>' value='<?php echo $row2->option;?>'>
                   				<input style=display:none name='score_<?php echo $i;?>_<?php echo $j;?>' value="<?php echo $row2->score;?>">
                  				<?php $j++;?>
                  		<?php }}?>
                  		<label><?php echo $answers?></label>
                   		<br/>
                   	<?php }else{ ?>
                   		<table>
                   		<?php foreach($result2->result() as $row2){
                   			if($row->question_id == $row2->question_id){?>
                  				<tr>
                  				<td><?php echo $row2->score;?></td>
                  				<td>
                    			<?php if($row->type=="Multiple Answers"){?>
                  					<input type=checkbox value=<?php echo $row2->option_id;?> id='radio1_<?php echo $row->question_id;?>' name='answer_<?php echo $i;?>[]'/>
                    			<?php }else{?>	
                    				<input type=radio value=<?php echo $row2->option_id;?> id='radio1_<?php echo $row->question_id;?>' name='answer_<?php echo $i;?>'/>
                   				<?php }?>
                   				</td>
                   				<td>
                   					<?php echo $row2->option;?>
                   				</td>
                   				<input style=display:none name='option_<?php echo $i;?>_<?php echo $j;?>' value='<?php echo $row2->option;?>'>
                   				<input style=display:none name='score_<?php echo $i;?>_<?php echo $j;?>' value="<?php echo $row2->score;?>">
                   				<?php $j++;?>
                   				</tr>
                  		<?php }?>
                   	<?php }?>
                  		</table>
                  		<br/>
                  		<?php if($row->type=="Multiple Answers"){ ?>
                  			<input type="radio" checked='checked' style='display:none' value="no_answer" id='radio1_<?php echo $row->question_id;?>_0' name='answer_<?php echo $i;?>[]'/>
                  	 	<?php }else{?>
                  			<input type="radio" checked='checked' style='display:none' value="no_answer" id='radio1_<?php echo $row->question_id;?>_0' name='answer_<?php echo $i;?>'/>
                  	 	<?php }?>
                  <?php }?>
                    <input type="text" style='display:none' value='<?php echo $row->question_id;?>' id='text_<?php echo $row->question_id;?>' name='question_<?php echo $i;?>'/>                                                            
 	                <?php if($category != "Intelligence"){?>
 	                <button id='pre<?php if($i<100) echo "0"; if($i<10) echo "0"; echo $i;?>' class='previous btn btn-success' type='button'>Previous</button>                    
                    <?php }?>
                    <button id='next<?php if($i<100) echo "0"; if($i<10) echo "0"; echo $i;?>' class='next btn btn-success' type='submit'>Finish</button>
                    </div>
           <?php                 
		}$i++;}?>
 			<input style=display:none name='rows' value=<?php echo $rows;?>>
          	</form>
	</div>
</div>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src=<?php echo base_url()."scripts/jquery-1.9.1.min.js";?>></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <!--  <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.validate.min.js"></script>-->
 
<script>
$('.cont').addClass('hide');
count=$('.questions').length;
$('#question'+1).removeClass('hide');
 
$(document).on('click','.next',function(){
	element=$(this).attr('id');
	last = parseInt(element.substr(element.length - 3));
	var nex=last+1;
	$('#question'+last).addClass('hide');
	$('#question'+nex).removeClass('hide');
});
 
$(document).on('click','.previous',function(){
	element=$(this).attr('id');
	last = parseInt(element.substr(element.length - 3));
	pre=last-1;
	$('#question'+last).addClass('hide');
	$('#question'+pre).removeClass('hide');
});

$(document).on('change','input[type=checkbox]',function(){
	var answer = false;
	id = $(this).attr('id');
	$("#"+id+":checked").each(function(){ 
		answer = true;
		$("#"+id+"_0").prop('checked', false);
	});
 
	if(!answer)
		$("#"+id+"_0").prop('checked', true);
});
</script>  