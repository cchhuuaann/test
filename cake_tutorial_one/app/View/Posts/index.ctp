<div class="posts index">
	<h2><?php echo __('Posts'); ?></h2>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('body'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($posts as $post): ?>
	<tr>
		<td><?php echo h($post['Post']['id']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['title']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['body']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['created']); ?>&nbsp;</td>
		<td><?php echo h($post['Post']['modified']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Js->link($post['User']['id'], array('controller' => 'users', 'action' => 'view', $post['User']['id']), array('update' => '#content')); ?>
		</td>
		<td class="actions">
			<?php echo $this->Js->link(__('View'), array('controller' => 'posts','action' => 'view', $post['Post']['id']), array('update' => '#content')); ?>
			<?php echo $this->Js->link(__('Edit'), array('controller' => 'posts','action' => 'edit', $post['Post']['id']), array('update' => '#content')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts','action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Js->link(__('New Post'), array('controller' => 'posts','action' => 'add'), array('update' => '#content')); ?></li>
		<li><?php echo $this->Js->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('Login'), array('controller' => 'users', 'action' => 'login'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'), array('update' => '#content')); ?> </li>
	</ul>
</div>
