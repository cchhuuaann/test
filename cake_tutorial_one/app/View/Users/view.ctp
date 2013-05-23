<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('IP Address'); ?></dt>
		<dd>
			<?php echo h($user['User']['ip_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($user['User']['role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Js->link(__('Edit User'), array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('controller' => 'users', 'action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Js->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New Post'), array('controller' => 'posts', 'action' => 'add'), array('update' => '#content')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Posts'); ?></h3>
	<?php if (!empty($user['Post'])): ?>
	<table>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Body'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Post'] as $post): ?>
		<tr>
			<td><?php echo $post['id']; ?></td>
			<td><?php echo $post['title']; ?></td>
			<td><?php echo $post['body']; ?></td>
			<td><?php echo $post['created']; ?></td>
			<td><?php echo $post['modified']; ?></td>
			<td><?php echo $post['user_id']; ?></td>
			<td class="actions">
				<?php echo $this->Js->link(__('View'), array('controller' => 'posts', 'action' => 'view', $post['id']), array('update' => '#content')); ?>
				<?php echo $this->Js->link(__('Edit'), array('controller' => 'posts', 'action' => 'edit', $post['id']), array('update' => '#content')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'posts', 'action' => 'delete', $post['id']), null, __('Are you sure you want to delete # %s?', $post['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Js->link(__('New Post'), array('controller' => 'posts', 'action' => 'add'), array('update' => '#content')); ?> </li>
		</ul>
	</div>
</div>
