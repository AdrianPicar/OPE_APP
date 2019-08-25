</head>
<body>
<div id="main">
<form id=exam_type_form method="post" action="update_exam_type">
<h1>Edit Exam Type</h1>
<br>
<label>Type</label>
<select id=exam_type name=exam_type>
<?php foreach($exam_types->result() as $row){?>
	<option value="<?php echo $row->type;?>"><?php echo $row->type;?></option>
<?php }?>
</select>
<br> 
<br> 
<?php foreach($exam_types->result() as $row){?>
<div class=exam_type_details id="<?php echo $row->type;?>">
<table border=0 cellpadding=0 cellspacing=5 table-layout=fixed width=50%>
<th></th>
<th>Category</th>
<th>Order</th>
<?php foreach($categories->result() as $row2){?>
		<tr>
		<td>
			<input type=button value=Select class=select_button id="<?php echo $row->type."_".$row2->category_no."_button";?>" name="<?php echo $row->type;?>"/>
			<input type=checkbox style="display:none" value=<?php echo $row2->category_no;?> class=<?php echo $row->type."_checkbox"?> id="<?php echo $row->type."_".$row2->category_no."_checkbox";?>" name="<?php echo $row->type."_checkbox[]";?>" />
		</td>
		<td>
			<label><?php echo $row2->category;?></label>
		</td>
		<td>
			<input readonly=true size=2 value="X" class="<?php echo $row->type."_exam_order"?>" id="<?php echo $row->type."_".$row2->category_no."_exam_order";?>" name="<?php echo $row->type."_".$row2->category_no."_exam_order";?>">
		</td>
		</tr>
<?php }?>
</table>
<input style="display:none" id="<?php echo $row->type."_exam_order"?>">
</div>
<?php }?>
<br>
<?php echo validation_errors();?>
<label><?php echo $this->session->flashdata("success");?></label>
<input class=button id=reset_button type=button value=Reset>
<input class=button type=submit value=Update>

</div>
</form>

<script src=<?php echo base_url()."scripts/jquery-1.9.1.min.js";?>></script>
<script type="text/javascript">
var current_type = "ENG";
var exam_order = 1;
$(document).ready(function(){
    $(".exam_type_details").hide(); 
    $("#"+current_type).show();
    $(".exam_order").prop('disabled', true);

    <?php foreach($exam_types->result() as $row){ $i=1;?> 
    <?php foreach($exam_types_details->result() as $row2){
    	if($row2->type == $row->type){?>
    		var exam_order_id = "<?php echo "#".$row->type."_".$row2->category_no."_exam_order";?>";
    		var exam_button_id = "<?php echo "#".$row->type."_".$row2->category_no."_button";?>";
    		var exam_checkbox_id = "<?php echo "#".$row->type."_".$row2->category_no."_checkbox";?>";
			var exam_order = "<?php echo $row2->order;?>";
    		$(exam_button_id).prop('disabled', true);
    		$(exam_button_id).css("color", "black");
    		$(exam_order_id).val(exam_order);
    		$(exam_checkbox_id).prop('checked', true);
    		
    <?php $i++; }} ?>
   		var exam_order = "<?php echo "#".$row->type."_exam_order";?>";
   		$(exam_order).val(<?php echo $i;?>);
    <?php }?>

    $("."+current_type+"_option").hide();
    for(var i=1; i<=$("."+current_type+"_checkbox:checked").size(); i++){
    	$("."+current_type+"_option[value="+i+"]").show();
    }

    $('#exam_type').bind('click change focus', function(event){
    	$("."+current_type+"_option").hide();
		if($(this).val() != current_type){
            $('.exam_type_details').hide(); 
			current_type = $(this).val();
            $("#"+current_type).show();             
		}
	})
	
	$("#reset_button").click(function(){
		$('.select_button').each(function(){
			if($(this).attr("name") == current_type){
				$(this).prop("disabled", false);
				$(this).css("color", "#3399FF");
			}
		});	

		$("."+current_type+"_exam_order").each(function(){
			$(this).val("X");
		})
		
		$("."+current_type+"_checkbox").each(function(){
			$(this).prop('checked', false);
		})

		$("#"+current_type+"_exam_order").val(1);
	})
	
	$('.select_button').click(function(){
		$(this).prop("disabled", true);
		$(this).css("color", "black");
		var button_id = $(this).attr('id');
		var exam_order_id = "#"+button_id.substr(0,button_id.length-6)+"exam_order";
		var exam_checkbox_id = "#"+button_id.substr(0,button_id.length-6)+"checkbox";
		var exam_order = $("#"+current_type+"_exam_order").val();
		$(exam_order_id).val(exam_order);
		$("#"+current_type+"_exam_order").val(parseInt(exam_order)+1);
		$(exam_checkbox_id).prop('checked', true);
	});		
});
</script>