<!-- File: /app/View/Users/index.ctp -->

<h1>Blog users</h1>

<?php
	echo $this->Html->link('Add User',array(
										'controller'=>'posts',
										'action'=>'add')
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
				<?php ?>
			</td>
			<td>
				<?php ?>
			</td>
			<td>
				<?php ?>
			</td>
			<td>
				<?php ?>
				<?php echo ', '; ?>
				<?php ?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php unset($user); ?>
		
	</table>

