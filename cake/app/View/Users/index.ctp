<!-- File: /app/View/Users/index.ctp -->

<h1>Blog users</h1>

<?php
	echo $this->html->link(
		'Show posts',
		array('controller'=>'posts')
	);
	echo '<br />';
	echo $this->Html->link(
		'Add User',
		array(
			'controller'=>'users',
			'action'=>'add'
		)
	);
?>

	<table>
		<tr>
			<th>Id</th>
			<th>Username</th>
			<th>created</th>
			<th>Actions</th>
		</tr>
		
		<?php foreach($users as $user): ?>
		<tr>
			<td>
				<?php echo $user['User']['id']; ?>
			</td>
			<td>
				<?php echo $this->Html->link($user['User']['username'], array('action'=>'view',$user['User']['id'])); ?>
			</td>
			<td>
				<?php echo $user['User']['created']; ?>
			</td>
			<td>
				<?php echo $this->Html->link('Edit', array('action'=>'edit',$user['User']['id'])); ?>
				<?php echo ', '; ?>
				<?php echo $this->Form->postLink('delete',array('action'=>'delete',$user['User']['id']),array('confirm'=>'Are you sure?')); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php unset($user); ?>
		
	</table>

