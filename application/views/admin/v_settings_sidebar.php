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