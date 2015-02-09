<h2>Create a news item</h2>

<?php echo validation_errors(); ?>
<?php echo $error; ?>

<?php echo form_open_multipart('news/create') ?>

	<label for="title">Title</label>
	<input type="input" name="title" /><br />

	<label for="text">Text</label>
	<textarea name="text"></textarea><br />
	<div><input type="file" name="photo" size="20" /></div>
	<input type="submit" name="submit" value="Create news item" />

</form>