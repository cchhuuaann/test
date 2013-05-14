<div class="swordsUsers view">
<h2><?php  echo __('Swords User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($swordsUser['SwordsUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Swords'); ?></dt>
		<dd>
			<?php echo $this->Html->link($swordsUser['Swords']['name'], array('controller' => 'swords', 'action' => 'view', $swordsUser['Swords']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Users'); ?></dt>
		<dd>
			<?php echo $this->Html->link($swordsUser['Users']['name'], array('controller' => 'users', 'action' => 'view', $swordsUser['Users']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Swords User'), array('action' => 'edit', $swordsUser['SwordsUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Swords User'), array('action' => 'delete', $swordsUser['SwordsUser']['id']), null, __('Are you sure you want to delete # %s?', $swordsUser['SwordsUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Swords Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Swords User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Swords'), array('controller' => 'swords', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Swords'), array('controller' => 'swords', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
