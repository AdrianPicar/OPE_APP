<div id="main">
<form method="post" action="update_email_failed">
<h1>Email for Failed Applicants</h1>
<br>

<table>
<tr>
<td>
<label>Subject:</label>
</td>
</tr>

<tr>
<td>
<input name=email_subject value="<?php echo $subject_failed;?>">
</td>

<td>
<?php echo form_error("email_subject");?>
</td>
</tr>
</table>

<label>Message:</label>
<textarea cols=95% rows="20%" id="id_question" name="email_message"><?php echo $message_failed;?></textarea>
<?php echo form_error("email_message");?>

<br>
<div>
<label><?php echo $this->session->flashdata("success");?></label>
</div>

<input class=button type="submit" id=submit name="submit" value="Save" />

</div>
</form>