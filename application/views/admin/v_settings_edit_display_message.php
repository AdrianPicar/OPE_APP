<div id="main">
<form method="post" action="update_display_message">
<h1>Edit Display Message</h1>
<br>
<label>Display Message:</label>
<textarea cols=95% rows="20%" id="id_question" name="display_message"><?php echo $display_message;?></textarea>
<?php echo form_error("display_message");?>
<div>
<label><?php echo $this->session->flashdata("success");?></label>
</div>
<br>
<input class=button type="submit" id=submit name="submit" value="Save" />
<input class=button type="reset" name="cancel" value="Cancel" onclick="window.location = '<?php echo base_url();?>admin/home'" />

</div>
</form>