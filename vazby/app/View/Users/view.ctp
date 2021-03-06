<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Js->link(__('Edit User'), array('action' => 'edit', $user['User']['id']), array('update'=>'#content')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Js->link(__('List Users'), array('action' => 'index'), array('update'=>'#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New User'), array('action' => 'add'), array('update'=>'#content')); ?> </li>
		<li><?php echo $this->Js->link(__('List Swords'), array('controller' => 'swords', 'action' => 'index'), array('update'=>'#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New Sword'), array('controller' => 'swords', 'action' => 'add'), array('update'=>'#content')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Swords'); ?></h3>
	<?php if (!empty($user['Sword'])): ?>
	<table>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Sword'] as $sword): ?>
		<tr>
			<td><?php echo $sword['id']; ?></td>
			<td><?php echo $sword['name']; ?></td>
			<td class="actions">
				<?php echo $this->Js->link(__('View'), array('controller' => 'swords', 'action' => 'view', $sword['id']), array('update'=>'#content')); ?>
				<?php echo $this->Js->link(__('Edit'), array('controller' => 'swords', 'action' => 'edit', $sword['id']), array('update'=>'#content')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'swords', 'action' => 'delete', $sword['id']), null, __('Are you sure you want to delete # %s?', $sword['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Js->link(__('New Sword'), array('controller' => 'swords', 'action' => 'add'), array('update'=>'#content')); ?> </li>
		</ul>
	</div>
</div>
