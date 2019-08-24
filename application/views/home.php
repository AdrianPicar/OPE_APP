</head>
<body>
<div id=main>
<p>Welcome <?php echo $this->session->userdata('name');?>.</p>
<div>
<?php if(isset($display_message)) echo $display_message;?>
</div>
</div>