<script type="text/javascript">
    var url="<?php echo base_url();?>";
    
	function deleteNews(id) {
		
        var r=confirm("Do you want to delete this?");
        if (r==true) {
			window.location = url+"news/delete/"+id;
		} else {
			return false;
		}

	}
</script>
<?php echo anchor('news/create', 'New news'); ?>
<table border="1" id="table1" >
  <tr>
    <th>title</th>
    <th>text</th>
	<th>photo</th>
	<th>show</th>
	<th>edit</th>
	<th>delete</th>
  </tr>

<?php foreach ($news as $news_item): ?>
  <tr>
    <td><?php echo $news_item['title'] ?></td>
    <td><?php echo $news_item['text'] ?></td>
	<td>
	<?php if($news_item['photo']) : ?>
		<img width="200" src="<?php echo base_url()?>uploads/<?php echo $news_item['photo']?>" alt="<?php echo $news_item['title'] ?>" />
	<?php endif; ?>
	</td>
	<td><?php echo anchor('news/show/'.$news_item['id'] , 'show'); ?></td>
    <td><a href="<?php echo base_url()?>news/edit/<?php echo $news_item['id'] ?>">edit</a></td>
	<td><a href="javascript:void(0);" onclick="deleteNews(<?php echo $news_item['id'] ?>);">delete</a></td>
	
  </tr>
<?php endforeach ?>
</table>
<p><?php echo $links; ?></p>
<h2>Welcome <?php echo $username; ?>!</h2>
<a href="<?php echo base_url()?>logout">Logout</a>
