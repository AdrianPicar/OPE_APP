<script src=<?php echo base_url()."public/js/jquery-1.9.1.min.js";?>></script>
<script type="text/javascript" src="<?php echo base_url()."public/js/tinymce/tinymce.min.js"?>"></script>
<script type="text/javascript">
tinyMCE.init({
	mode : "textareas",
	plugins: "responsivefilemanager preview",
	toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | preview | responsivefilemanager",
	relative_urls: false,
	remove_script_host: false,
	external_filemanager_path:"/ope_app/public/js/tinymce/filemanager/",
	filemanager_title:"Responsive Filemanager" ,
	external_plugins: { "filemanager" : "/ope_app/public/js/tinymce/filemanager/plugin.min.js"}
});

function convert(){
    var minutes = parseInt($('#minutes').val());
    var seconds = parseInt($('#seconds').val());

	if(isNaN(minutes))
		minutes = 0;
	if(isNaN(seconds))
		seconds = 0;
	
   	$('#time_limit').val((minutes*60)+seconds);
}
</script>
</head>
<body>

<div id="sidebar" >
	<h1>General Settings</h1>
	<ul class="sidemenu">
		<li><a href="<?php echo base_url()."settings/edit_display_message";?>">Edit Display Message</a></li>
		<li><a href="<?php echo base_url()."settings/edit_post_exam";?>">Edit Post-exam Message</a></li>
		<li><a href="<?php echo base_url()."settings/edit_exam_type";?>">Edit Exam Type</a></li>
		<li><a href="<?php echo base_url()."settings/generate_unique_key";?>">Generate Unique Key</a></li>
		<li><a href="<?php echo base_url()."settings/add_new_exam";?>">Add New Exam</a></li>
	</ul>
	<h1>Email Settings</h1>
	<ul class="sidemenu">
		<li><a href="<?php echo base_url()."settings/edit_email_password";?>">Email Address and Password</a></li>
		<li><a href="<?php echo base_url()."settings/edit_email_passed";?>">Email for Passed Applicants</a></li>
		<li><a href="<?php echo base_url()."settings/edit_email_failed";?>">Email for Failed Applicants</a></li>	
	</ul>
	<h1>Category<br>Settings</h1>
	<ul class="sidemenu">	
		<?php foreach($categories->result() as $row){?>
		<li><a href=<?php echo base_url()."settings/edit_category_settings/".$row->category_no;?>><?php echo $row->category;?></a></li>
		<?php }?>
	</ul>	
</div>

<div id="main">
<form method="post" action="update_category_settings">
<h1><?php echo $category;?></h1>
<input style=display:none name=category value=<?php echo $category;?>>
<input style=display:none name=category_no value=<?php echo $category_no;?>>
<br>
<label>Instructions:</label>
<textarea cols=95% rows="20%" id="id_question" name="instructions"><?php echo $instructions?></textarea>
<?php echo form_error("instructions");?>
<table>
<tr>
<td>
<label>Time Limit:</label>
<input type=number min="0" step="1" pattern="\d+" placeholder="0" id=time_limit name=time_limit value=<?php echo $time_limit?>>
</td>

<td>
<label>Minutes:</label>
<input type=number min="0" step="1" pattern="\d+" placeholder="0" id=minutes name=minutes onkeyup="convert()">
</td>

<td>
<label>Seconds:</label>
<input type=number min="0" step="1" pattern="\d+" placeholder="0" id=seconds name=seconds onkeyup="convert()">
</td>
</tr>

<tr>
<td>
<label>No. of Items:</label>
</td>
</tr>

<tr>
<td>
<input type=number min="0" step="1" pattern="\d+" placeholder="0" name=no_items value=<?php echo $no_items?>>
</td>
<td>
<?php echo form_error("no_items");?>
</td>
<td></td>
</tr>

<tr>
<td>
<label>Passing Score:</label>
</td>
</tr>

<tr>
<td>
<input type=number min="0" step="1" pattern="\d+" placeholder="0" name=passing_score value=<?php echo $passing_score?>>
</td>
<td>
<?php echo form_error("passing_score");?>
</td>
<td></td>
</tr>
</table>

<div>
<label><?php echo $this->session->flashdata("success");?></label>
</div>

<input class=button type="submit" id=submit name="submit" value="Save" />
<input class=button type="reset" name="cancel" value="Cancel" onclick="window.location = '<?php echo base_url();?>admin/home'" />

</div>
</form>