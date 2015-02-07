<h2>Edit a news item</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('news/update') ?>
	<input type='hidden' name='id' value="<?php echo $news['id']?>"/>
	<label for="title">Title</label>
	
	<input type="input" name="title" value="<?php echo $news['title'];?>" /><br />

	<label for="text">Text</label>
	<textarea name="text"><?php echo $news['text'];?></textarea><br />

	<input type="submit" name="submit" value="Update news item" />

</form>