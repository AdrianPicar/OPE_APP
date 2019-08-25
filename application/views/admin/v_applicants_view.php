<?php 
$i=0;
$this->load->helper('form');
?>
<body onload="search()">
<form method='post' id="search" action="send_email">
<table>
<tr class=search>
<td>
<label>Search by:</label>
</td>
</tr>
<tr class=search>
<td>
<select id="search_cat" name="search_cat">
<option value="name" selected="selected">Name</option>
<option value="course">Course</option>
<option value="school">School</option>
<option value="position">Position</option>
<option value="exam_date">Exam Date</option>
</select>
</td>
<td>
<input id='search_input' name='search_input' onkeyup="search()" />
</td>
<td id=date_input>
<select id=month_from name=month_from>
	<option value=1>January</option>
	<option value=2>February</option>
	<option value=3>March</option>
	<option value=4>April</option>
	<option value=5>May</option>
	<option value=6>June</option>
	<option value=7>July</option>
	<option value=8>August</option>
	<option value=9>September</option>
	<option value=10>October</option>
	<option value=11>November</option>
	<option value=12>December</option>
</select>
<select id=day_from name=day_from>
<?php for($i=1; $i<=31; $i++){?>
	<option id=<?php echo $i."_from";?> value=<?php echo $i;?>><?php echo $i;?></option>
<?php }?>
</select>
<select id=year_from name=year_from>
<?php for($i=intval(date("Y")); $i>=1901; $i--){?>
	<option value=<?php echo $i;?>><?php echo $i;?></option>
<?php }?>
</select>
to
<select id=month_to name=month_to>
	<option value=1>January</option>
	<option value=2>February</option>
	<option value=3>March</option>
	<option value=4>April</option>
	<option value=5>May</option>
	<option value=6>June</option>
	<option value=7>July</option>
	<option value=8>August</option>
	<option value=9>September</option>
	<option value=10>October</option>
	<option value=11>November</option>
	<option value=12>December</option>
</select>
<select id=day_to name=day_to>
<?php for($i=1; $i<=31; $i++){?>
	<option id=<?php echo $i."_to";?> value=<?php echo $i;?>><?php echo $i;?></option>
<?php }?>
</select>
<select id=year_to name=year_to>
<?php for($i=intval(date("Y")); $i>=1901; $i--){?>
	<option value=<?php echo $i;?>><?php echo $i;?></option>
<?php }?>
</select>
<input class=button type=button value=Go! onclick="search()" />
</td>
</tr>
</table>
<table>
<tr class=search>
<td>
<label>Remarks:</label>
</td>
<td>
<input type=checkbox checked=1 name=check_passed onclick="search()" > Passed
</td>
<td>
<input type=checkbox checked=1 name=check_failed onclick="search()" > Failed
</td>
<td>
<input type=checkbox checked=1 name=check_not_yet onclick="search()"> Not Yet Completed
</td>
</tr>

<tr class=search>
<td>
<label>Exam Types:</label>
</td>
<td>
<input type=checkbox checked=1 name=check_eng onclick="search()" > ENG
</td>
<td>
<input type=checkbox checked=1 name=check_mpt onclick="search()" > MPT
</td>
<td>
<input type=checkbox checked=1 name=check_rnf onclick="search()"> RNF
</td>
</tr>
</table>

<div id=result>
<?php echo $table;?>
</div>
<table>
<tr class=search colspan=2>
<td><label>Legend:</label></td>
</tr>

<tr class=search>
<td><div style="background-color:#66FFFF;width:50px;height:20px;"></td>
<td>- PASSED</td>
</tr>

<tr class=search>
<td><div style="background-color:#FFCCCC;width:50px;height:20px;"></td>
<td>- FAILED</td>
</tr>

<tr class=search>
<td><div style="background-color:white;width:50px;height:20px;"></td>
<td>- NOT YET COMPLETED</td>
</tr>

</table>

<?php //if(strlen($pagination)){?>
<!--  <div>
<?php echo $pagination;?>
</div>-->
<input style=display:none value=<?php echo $num_rows;?> name=num_rows>
<?php //}
?>
<label><?php echo $this->session->flashdata("success");?></label>
<input class=button type=submit value="Send Email">
</form>

<script src=<?php echo base_url()."scripts/jquery-1.9.1.min.js";?>></script>       
<script>
$("#date_input").hide();
$("#month_from").val(<?php echo date("m");?>);
$("#day_from").val(<?php echo date("d");?>);
$("#year_from").val(<?php echo date("Y");?>);
$("#month_to").val(<?php echo date("m");?>);
$("#day_to").val(<?php echo date("d");?>);
$("#year_to").val(<?php echo date("Y");?>);

function search(){ 
    $.ajax({
		type: "POST",
		url: "ajax_applicants",
		data: $('form').serialize(),
		success: function(msg){
			$('#result').html(msg);
			$( "tr" ).each(function() {
				$( this ).hide();
				});
			$('.heading').show();
			$('.search').show();
		    $('.1').show();
		}
    });
    
    $(document).on('click','.page',function(e){
    	e.preventDefault();
    	element=$(this).attr('id');
    	$( "tr" ).each(function() {
			$( this ).hide();
			});
    	$('.heading').show();
    	$('.search').show();
    	$('.'+element).show();
    	});
}

$(document).on('click','#check_all', function(e){
	if($(this).prop("checked")==true) {
        $('.applicant_checkbox').each(function() {
        	$(".applicant_checkbox").prop("checked",true);              
        });
    }
    else{
        $('.applicant_checkbox').each(function() {
        	$(".applicant_checkbox").prop("checked",false);                     
        });        
    }       
});

$(document).on('change','#search_cat', function(e){
	if($(this).val() == "exam_date") {
		$("#date_input").show();
        $("#search_input").hide();
    }
    else{
    	$("#date_input").hide();
        $("#search_input").show();        
    }       
});

$('#month_from').bind('click change focus', function(event){
	switch($(this).val()){
		case "2":
			if(($("#year_from").val()%4) != 0) 
				$("#29_from").hide();
			$("#30_from").hide();
			$("#31_from").hide();
			break;
		case "4":
			$("#29_from").show();
			$("#30_from").show();
			$("#31_from").hide();
			break;
		case "6":
			$("#29_from").show();
			$("#30_from").show();
			$("#31_from").hide();
			break;
		case "9":
			$("#29_from").show();
			$("#30_from").show();
			$("#31_from").hide();
			break;
		case "11":
			$("#29_from").show();
			$("#30_from").show();
			$("#31_from").hide();
			break;
		default:
			$("#29_from").show();
			$("#30_from").show();
			$("#31_from").show();
			break;
	}
	$("#day_from")[0].selectedIndex = 0;
});

$('#year_from').bind('click change focus', function(event){
	if($("#month_from").val() == 2){
		if(($(this).val()%4) == 0)
			$("#29_from").show();
		else
			$("#29_from").hide();
	}
});

$('#month_to').bind('click change focus', function(event){
	switch($(this).val()){
		case "2":
			if(($("#year_to").val()%4) != 0) 
				$("#29_to").hide();
			$("#30_to").hide();
			$("#31_to").hide();
			break;
		case "4":
			$("#29_to").show();
			$("#30_to").show();
			$("#31_to").hide();
			break;
		case "6":
			$("#29_to").show();
			$("#30_to").show();
			$("#31_to").hide();
			break;
		case "9":
			$("#29_to").show();
			$("#30_to").show();
			$("#31_to").hide();
			break;
		case "11":
			$("#29_to").show();
			$("#30_to").show();
			$("#31_to").hide();
			break;
		default:
			$("#29_to").show();
			$("#30_to").show();
			$("#31_to").show();
			break;
	}
	$("#day_to")[0].selectedIndex = 0;
});

$('#year_to').bind('click change focus', function(event){
	if($("#month_to").val() == 2){
		if(($(this).val()%4) == 0)
			$("#29_to").show();
		else
			$("#29_to").hide();
	}
});
</script> 