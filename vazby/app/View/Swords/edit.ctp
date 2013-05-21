<div class="swords form">
<?php echo $this->Form->create('Sword'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sword'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('User');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Sword.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Sword.id'))); ?></li>
		<li><?php echo $this->Js->link(__('List Swords'), array('action' => 'index'), array('update'=>'#content')); ?></li>
		<li><?php echo $this->Js->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('update'=>'#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('update'=>'#content')); ?> </li>
	</ul>
</div>
