<!--  https://testmoz.com -->
<h1>Edit Question</h1>

<style>
	input.score {
		width:35px;
		border-color:#5E5E47;
		border-style:solid;
		border-width:2px;
	}
	
	textarea.fill_in {
		position: relative;
		bottom: -11px;
	}
</style>
</head>
<body>
<div id=main_alt>
<form method="post" action=<?php echo base_url()."admin/update_question"?>>
<input style="display:none" name="id" value='<?php echo $id;?>' />
<textarea class=question id="id_question" name="question" cols=65 rows=5 ><?php echo $question;?></textarea>
<?php echo validation_errors();?>
<label>Type</label>
<select id="id_type" name="type">	
<?php foreach($question_types->result() as $row){?>
		<option <?php if($type==$row->type) echo "selected=true";?> value="<?php echo str_replace(' ','_',$row->type);?>"><?php echo $row->type;?></option>
<?php }?>
</select>

<label>Category</label>
<select id="id_category" name="category">
<?php foreach($categories->result() as $row){?>
	<option <?php if($category==$row->category) echo "selected=true";?> value=<?php echo $row->category;?>><?php echo $row->category;?></option>
<?php }?>	
</select>

<div id="answer-template">
	<div id="type-id-True_or_False" class='answer-template'>
		<label>Enter the two answer choices and mark the correct answer</label>
		<br>	
			<?php if($type=="True or False"){ $i=0; foreach($options->result() as $row){?>
			<div>
				<input type="number" step="1" placeholder="0" class=score name="True_or_False-score_<?php echo $i;?>" value=<?php echo $row->score;?>>
				<input readonly="true" cols="10" id="id_1-answer_<?php echo $i;?>" name="True_or_False-answer_<?php echo $i;?>" rows="2" value=<?php echo $row->option;?>>
			</div>
			<br>
			<?php $i++;}}else{?>
			<div>
				<!-- style="border-color:black;border-width:2px;" <input checked="checked" name="True_or_False-correct" type="radio" value="0" /> -->
				<input type="number" step="1" placeholder="0" class=score name=True_or_False-score_0 value=0 >
				<input readonly="true" cols="10" id="id_1-answer_0" name="True_or_False-answer_0" rows="2" value="True">
			</div>
			<br>
			<div>
				<input type="number" step="1" placeholder="0" class=score name=True_or_False-score_1 value=0 >
				<input readonly="true" cols="10" id="id_1-answer_1" name="True_or_False-answer_1" rows="2" value="False">
			</div>
			<br>
			<?php }?>
	</div>

	<div id="type-id-Multiple_Choice" class='answer-template'>
		<label>Enter the answer choices, and mark which answer is correct</label>
		<div id="multiple-choice-options">
		<?php $i=0; foreach($options->result() as $row){?>
			<div class="answer-option">
				<input type="number" step="1" placeholder="0" id=multiple_choice class=score name="Multiple_Choice-score_<?php echo $i;?>" value=<?php echo $row->score;?>>
				<textarea class=choice cols="40" id="id_2-answer_<?php echo $i;?>" name="Multiple_Choice-answer_<?php echo $i;?>" rows="2"><?php echo $row->option;?></textarea>
				<br>
			</div>
		<?php $i++;}?>
			
		</div>
		<input style=display:none id=Multiple_Choice-index name=Multiple_Choice-index value=<?php echo $i-1;?>>
		<p><a href="#" class="add-answer-choice">Add</a> / <a href="#" class="remove-answer-choice">Remove</a> answer choice</p>
	</div>
    
	<div id="type-id-Fill_in_the_Blanks" class='answer-template'>
		<label>Enter the answer choices, and mark which answers are correct</label>
		<div id="fill-in-the-blank-answer-options">
		<?php $i=0; foreach($options->result() as $row){?>
			<div class="answer-option">
				<input type="number" step="1" placeholder="0" class=score name="Fill_in_the_Blanks-score_<?php echo $i;?>" value=<?php echo $row->score;?>>
				<textarea class=fill_in cols="40" id="id_3-answer_<?php echo $i;?>" name="Fill_in_the_Blanks-answer_<?php echo $i;?>" rows="2"><?php echo $row->option;?></textarea>
			</div>
		<?php $i++;}?>	
		     
		</div>
		<input style=display:none id=Fill_in_the_Blanks-index name=Fill_in_the_Blanks-index value=<?php echo $i-1;?>>
		<p><a href="#" class="add-answer-choice">Add</a> / <a href="#" class="remove-answer-choice">Remove</a> answer choice</p>
	</div>
	
	<div id="type-id-Multiple_Answers" class='answer-template'>
		<label>Enter the choices and mark all the correct answers.</label>
		<br>
		<div id="multiple-answers-options">
		<?php $i=0; foreach($options->result() as $row){?>
			<div class="answer-option">
				<input type="number" step="1" placeholder="0" id=multiple_answers class=score name="Multiple_Answers-score_<?php echo $i;?>" value=<?php echo $row->score;?>>
				<textarea class=choice cols="40" id="id_4-answer_<?php echo $i;?>" name="Multiple_Answers-answer_<?php echo $i;?>" rows="2"><?php echo $row->option;?></textarea>
				<br>
			</div>
		<?php $i++;}?>
		
		</div>
		<input style=display:none id=Multiple_Answers-index name=Multiple_Answers-index value=<?php echo $i-1;?>>
		<p><a href="#" class="add-answer-choice">Add</a> / <a href="#" class="remove-answer-choice">Remove</a> choice</p>    
	</div>
</div>

<div class="button-list">
	<input class=button type="submit" name="submit" value="Save" />
    <input class=button type="reset" name="cancel" value="Cancel" onclick="window.location = '<?php echo base_url();?>admin/view_questions';" />
</div>
</form>
</div>
<script src=<?php echo base_url()."scripts/jquery-1.9.1.min.js";?>></script>
<script type="text/javascript" src="<?php echo base_url()."scripts/tinymce/tinymce.min.js"?>"></script>
<script type="text/javascript">
var current_type_id = "<?php echo str_replace(' ', '_', $type);?>"
$(document).ready(function(){
    // handle the showing/hiding of the subforms
    $('#answer-template .answer-template').hide(); 
    $('#type-id-' + current_type_id).show();
	$('#id_type').bind('click change focus', function(event){
		if($(this).val() != current_type_id){
            $('#answer-template .answer-template').hide(); 
			current_type_id = $(this).val();
            $('#type-id-' + current_type_id).show();
		}
	})

	$('textarea:first').focus()

    $('.add-answer-choice').on('click', addAnswerChoice);
    $('.remove-answer-choice').on('click', removeAnswerChoice);

    $(".score").each(function(){
    	if($(this).val() > 0)
    		$(this).css("border-color", "orange");
    });

    tinyMCE.init({
    	mode : "none",
    	selector: "textarea.question",
        plugins: "responsivefilemanager preview",
        toolbar1: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
		toolbar2: "preview | responsivefilemanager",
        relative_urls: false,
        remove_script_host: false,
        width: 800,
        external_filemanager_path:"/ope_app/scripts/tinymce/filemanager/",
  		filemanager_title:"Responsive Filemanager" ,
   		external_plugins: { "filemanager" : "/ope_app/scripts/tinymce/filemanager/plugin.min.js"}
    });

    tinyMCE.init({
    	mode : "none",
    	selector: "textarea.choice",
        plugins: "responsivefilemanager preview",
        toolbar1: "undo redo | bold italic | preview | responsivefilemanager",
        relative_urls: false,
        remove_script_host: false,
        width: 350,
        external_filemanager_path:"/ope_app/scripts/tinymce/filemanager/",
  		filemanager_title:"Responsive Filemanager" ,
   		external_plugins: { "filemanager" : "/ope_app/scripts/tinymce/filemanager/plugin.min.js"}
    });
});

function addAnswerChoice(){
    // find all the .answer-option divs, and the last one
    var options = $(this).parent().parent().find('.answer-option');
    var last_option = $(this).parent().parent().find('.answer-option:last')
    // clone the last one
    var clone = last_option.clone(true, true);
    // figure out what the input elements suffix should be 
    var index = options.length;
    document.getElementById(current_type_id+"-index").value =index;

    if(current_type_id == "Multiple_Choice"){
        //create new div and set attributes
    	var new_div = document.createElement('div');
    	new_div.className = 'answer-option';
    	//create new radio and set attributes
   		var new_input = document.createElement("input");
   		new_input.name = "Multiple_Choice-score_"+index;
   		new_input.value = 0;
   		new_input.type = "number";
   		new_input.id = "multiple_choice"
   		new_input.className = "score";
    	//create new textarea and set attributes
   		var new_textarea = document.createElement("textarea");
   		new_textarea.name = "Multiple_Choice-answer_"+index;
   		new_textarea.id = "id_2-answer_"+index;

   		var new_break = document.createElement("br");

   		new_div.appendChild(new_input);
   		new_div.appendChild(new_textarea);
   		new_div.appendChild(new_break);
   		
   		var div = document.getElementById("multiple-choice-options");
   		div.appendChild(new_div);
   		tinymce.EditorManager.execCommand('mceAddEditor', true, new_textarea.id);
   	}
    else if(current_type_id == "Multiple_Answers"){
        //create new div and set attributes
    	var new_div = document.createElement('div');
    	new_div.className = 'answer-option';
    	//create new radio and set attributes
   		var new_input = document.createElement("input");
   		new_input.name = "Multiple_Answers-score_"+index;
   		new_input.value = 0;
   		new_input.type = "number";
   		new_input.id = "multiple_answers"
   		new_input.className = "score";

    	//create new textarea and set attributes
   		var new_textarea = document.createElement("textarea");
   		new_textarea.name = "Multiple_Answers-answer_"+index;
   		new_textarea.id = "id_4-answer_"+index;

   		var new_break = document.createElement("br");

   		new_div.appendChild(new_input);
   		new_div.appendChild(new_textarea);
   		new_div.appendChild(new_break);
   		
   		var div = document.getElementById("multiple-answers-options");
   		div.appendChild(new_div);
   		tinymce.EditorManager.execCommand('mceAddEditor', true, new_textarea.id);
   	}
    else{
	    // grab the textbox and update the attributes
	    var textarea = clone.find('textarea');
	    textarea.html("");
	    textarea.attr('name', textarea.attr('name').replace(/\d+$/, index))
	    textarea.attr('id', textarea.attr('id').replace(/\d+$/, index))
	    // grab the input element and update the attributes
	    var input = clone.find('input');
	    
	    input.attr('name', input.attr('name').replace(/\d+$/, index));
	    input.attr('value', 1);
	    last_option.append(clone);
    }
}

function removeAnswerChoice(){
	 // find all the .answer-option divs, and the last one
   var options = $(this).parent().parent().find('.answer-option');
   var last_option = $(this).parent().parent().find('.answer-option:last')
   var input = last_option.clone(true, true).find('input');
   if(options.length == 1) return;
   if(options.length == 2)
   	if(input.attr('id')=="multiple_choice" || input.attr('id')=="multiple_answers") 
   	    	return; 
   if(current_type_id == "Multiple_Choice"){
   	//tinyMCE.EditorManager.execCommand('mceFocus', false, "id_2-answer_"+(options.length-1));
   	tinymce.EditorManager.execCommand('mceRemoveEditor', true, "id_2-answer_"+(options.length-1));
   	$('br + br').remove();
   }
   else if(current_type_id == "Multiple_Answers"){
   	//tinyMCE.EditorManager.execCommand('mceFocus', false, "id_2-answer_"+(options.length-1));
   	tinymce.EditorManager.execCommand('mceRemoveEditor', true, "id_4-answer_"+(options.length-1));
   	$('br + br').remove();
   }
   last_option.remove();
   document.getElementById(current_type_id+"-index").value = options.length-2;
}

$(".score").change(function(){
	if($(this).val() > 0)
		$(this).css("border-color", "orange");
	else
		$(this).css("border-color", "#5E5E47");
});
</script>