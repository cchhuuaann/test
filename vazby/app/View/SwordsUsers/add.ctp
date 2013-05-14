<div class="swordsUsers form">
<?php echo $this->Form->create('SwordsUser'); ?>
	<fieldset>
		<legend><?php echo __('Add Swords User'); ?></legend>
	<?php
		echo $this->Form->input('swords_id');
		echo $this->Form->input('users_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Swords Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Swords'), array('controller' => 'swords', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Swords'), array('controller' => 'swords', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
