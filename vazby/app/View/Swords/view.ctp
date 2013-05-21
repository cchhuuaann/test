<div class="swords view">
<h2><?php  echo __('Sword'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sword['Sword']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($sword['Sword']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Js->link(__('Edit Sword'), array('action' => 'edit', $sword['Sword']['id']), array('update'=>'#content'), array('update'=>'#content')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sword'), array('action' => 'delete', $sword['Sword']['id']), null, __('Are you sure you want to delete # %s?', $sword['Sword']['id'])); ?> </li>
		<li><?php echo $this->Js->link(__('List Swords'), array('action' => 'index'), array('update'=>'#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New Sword'), array('action' => 'add'), array('update'=>'#content')); ?> </li>
		<li><?php echo $this->Js->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('update'=>'#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('update'=>'#content')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($sword['User'])): ?>
	<table>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sword['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['name']; ?></td>
			<td class="actions">
				<?php echo $this->Js->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id']), array('update'=>'#content')); ?>
				<?php echo $this->Js->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id']), array('update'=>'#content')); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Js->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('update'=>'#content')); ?> </li>
		</ul>
	</div>
</div>
