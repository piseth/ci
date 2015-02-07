
<?php echo anchor('news/create', 'New news'); ?>
<table border="1" id="table1" >
  <tr>
    <th>title</th>
    <th>text</th>
	<th>show</th>
	<th>edit</th>
	<th>delete</th>
  </tr>

<?php foreach ($news as $news_item): ?>
  <tr>
    <td><?php echo $news_item['title'] ?></td>
    <td><?php echo $news_item['text'] ?></td>
	<td><?php echo anchor('news/show/'.$news_item['id'] , 'show'); ?></td>
    <td><a href="<?php echo base_url()?>news/edit/<?php echo $news_item['id'] ?>">edit</a></td>
	<td><a href="<?php echo base_url()?>news/delete/<?php echo $news_item['id'] ?>">delete</a></td>
  </tr>
<?php endforeach ?>
</table>
<p><?php echo $links; ?></p>
