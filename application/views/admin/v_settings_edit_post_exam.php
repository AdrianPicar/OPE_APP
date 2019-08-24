<div id="main">
<form method="post" action="update_post_exam">
<h1>Edit Post-exam Message</h1>
<br>
<label>Post-exam Message:</label>
<textarea cols=95% rows="20%" id="id_question" name="post_exam_message"><?php echo $post_exam_message;?></textarea>
<?php echo form_error("post_exam_message");?>
<div>
<label><?php echo $this->session->flashdata("success");?></label>
</div>
<br>
<input class=button type="submit" id=submit name="submit" value="Save" />
<input class=button type="reset" name="cancel" value="Cancel" onclick="window.location = '<?php echo base_url();?>admin/home'" />

</div>
</form>