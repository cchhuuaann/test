<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('ip_address'); ?></th>
			<th><?php echo $this->Paginator->sort('role'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['ip_address']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['role']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Js->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['User']['id']), array('update' => '#content')); ?>
			<?php echo $this->Js->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array('update' => '#content')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
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
		<li><?php echo $this->Js->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?></li>
		<li><?php echo $this->Js->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New Post'), array('controller' => 'posts', 'action' => 'add'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('Login'), array('controller' => 'users', 'action' => 'login'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('Logout'), array('controller' => 'users', 'action' => 'logout'), array('update' => '#content')); ?> </li>
	</ul>
</div>
