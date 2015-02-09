<h2>Edit a news item</h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('news/update') ?>
	<input type='hidden' name='id' value="<?php echo $news['id']?>"/>
	<label for="title">Title</label>
	
	<input type="input" name="title" value="<?php echo $news['title'];?>" /><br />

	<label for="text">Text</label>
	<textarea name="text"><?php echo $news['text'];?></textarea><br />
	<?php if($news['photo']) : ?>
		<div>
			<img width="200" src="<?php echo base_url()?>uploads/<?php echo $news['photo']?>" alt="<?php echo $news['title'] ?>" />
		</div>
	<?php endif; ?>
	<div><input type="file" name="photo" size="20" /></div>
	<input type="submit" name="submit" value="Update news item" />

</form>