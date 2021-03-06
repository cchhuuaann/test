<div class="swords index">
	<h2><?php echo __('Swords'); ?></h2>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($swords as $sword): ?>
	<tr>
		<td><?php echo h($sword['Sword']['id']); ?>&nbsp;</td>
		<td><?php echo h($sword['Sword']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Js->link(__('View'), array('action' => 'view', $sword['Sword']['id']), array('update'=>'#content')); ?>
			<?php echo $this->Js->link(__('Edit'), array('action' => 'edit', $sword['Sword']['id']), array('update'=>'#content')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sword['Sword']['id']), null, __('Are you sure you want to delete # %s?', $sword['Sword']['id'])); ?>
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
		<li><?php echo $this->Js->link(__('New Sword'), array('action' => 'add'), array('update'=>'#content')); ?></li>
		<li><?php echo $this->Js->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('update'=>'#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('update'=>'#content')); ?> </li>
	</ul>
</div>
