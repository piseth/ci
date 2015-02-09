<?php
echo '<h2>'.$news_item['title'].'</h2>';
echo $news_item['text'];
?>
<?php if($news_item['photo']) : ?>
	<div>
		<img width="200" src="<?php echo base_url()?>uploads/<?php echo $news_item['photo']?>" alt="<?php echo $news_item['title'] ?>" />
	</div>
<?php endif; ?>