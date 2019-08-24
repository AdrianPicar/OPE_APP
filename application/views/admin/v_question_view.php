<script src=<?php echo base_url()."public/js/jquery-1.9.1.min.js";?>></script>  
<script>
$(document).ready(function(){
	$(document).on('click','.delete',function(e){
		e.preventDefault();
		var result = confirm("Want to delete?");
		if (result==true){
			$('#question_id').val($(this).attr('id'));
			$("#search").attr("action", "delete_question");
			$("#search").submit();
		}
	});

	$(document).on('click','#butt_delete',function(e){
		e.preventDefault();
		var result = confirm("Want to delete?");
		if (result==true){
			$("#search").attr("action", "delete_questions");
			$("#search").submit();
		}
	});
});
</script>
</head>
<body onload="search()">
<?php 
$i=0;
$this->load->helper('form');
?>
<div id=sidebar>
	<h1>Add Questions</h1>
	<ul class="sidemenu">
		<li><a href="add_question">Add Question</a></li>
		<li><a href="upload">Upload Questions</a></li>
	</ul>
	<h1>Print Questions</h1>
	<ul class="sidemenu">
		<li><a href="print_questions/All">All</a></li>
		<?php foreach($number->result() as $row){?>
			<li><a href="print_questions/<?php echo $row->category;?>"><?php echo $row->category;?></a></li>
		<?php }?>
	</ul>	
</div>
<div id="main">
<form method='post' action="" id="search">
<table>
<tr>
<td>
<label>Search question:</label>
</td>
</tr>
<tr>
<td>
<input id='name' name='question_search' onkeyup="search()" />
</td>
</tr>

<tr>
<td>
<label>Categories:</label>
<?php foreach($number->result() as $row){?>
	<input type=checkbox checked=1 name="check_<?php echo $row->category;?>" onclick="search()" ><?php echo $row->category;?>
<?php }?>
</td> 
</tr>

<tr>
<td>
<label>Question Types:</label>
<input type=checkbox checked=1 name="check_True_or_False" onclick="search()" > True or False
<input type=checkbox checked=1 name="check_Multiple_Choice" onclick="search()" > Multiple Choice
<input type=checkbox checked=1 name="check_Fill_in_the_Blanks" onclick="search()"> Fill in the Blanks
<input type=checkbox checked=1 name="check_Multiple_Answers" onclick="search()"> Multiple Answers
</td> 
</tr>

</table>
<label>
<?php foreach($number->result() as $row){
	echo $row->category.": ".$row->count." | ";
}?>
</label>
<hr>

<div id=result>
<?php echo $table;?>
<br>
<label><?php echo $this->session->flashdata("success");?></label>
<input class=button type=button id=butt_delete value=Delete />
</div>

<input style=display:none value=<?php echo $num_rows;?> name=num_rows>
<input id=question_id style=display:none value="" name=question_id>

</form>
</div>
     
<script>
function search(){ 
    $.ajax({
		type: "POST",
		url: "ajax_questions",
		data: $('form').serialize(),
		success: function(msg){
			$('#result').html(msg);
			$(".questions").hide();
		    $('#questions1').show();	
		}
    });
}

$(document).on('click','.page',function(e){
	e.preventDefault();
	element=$(this).attr('id');
	$(".questions").hide();
	$('#questions'+element).show();
	});
</script> 