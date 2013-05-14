<div class="swordsUsers index">
	<h2><?php echo __('Swords Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('swords_id'); ?></th>
			<th><?php echo $this->Paginator->sort('users_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($swordsUsers as $swordsUser): ?>
	<tr>
		<td><?php echo h($swordsUser['SwordsUser']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($swordsUser['Swords']['name'], array('controller' => 'swords', 'action' => 'view', $swordsUser['Swords']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($swordsUser['Users']['name'], array('controller' => 'users', 'action' => 'view', $swordsUser['Users']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $swordsUser['SwordsUser']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $swordsUser['SwordsUser']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $swordsUser['SwordsUser']['id']), null, __('Are you sure you want to delete # %s?', $swordsUser['SwordsUser']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Swords User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Swords'), array('controller' => 'swords', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Swords'), array('controller' => 'swords', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
