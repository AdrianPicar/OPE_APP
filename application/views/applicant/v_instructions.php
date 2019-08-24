</head>
<body>
<h1><?php echo $category;?></h1>
<?php echo $instructions;?>
<br>
<input class=button type=reset id=butt_exam value="Proceed to the Exam">
<script src=<?php echo base_url()."public/js/jquery-1.9.1.min.js";?>></script>       
<script>
	$(document).on('click','#butt_exam',function(e){
		e.preventDefault();
		var result = confirm("Are you sure you want to proceed to the exam?");
		if (result==true){
			$("#search").submit();
			window.location = '<?php echo base_url()."applicant/exam";?>';
		}
	});
</script>
