<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('Sword');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Js->link(__('List Users'), array('action' => 'index'), array('update'=>'#content')); ?></li>
		<li><?php echo $this->Js->link(__('List Swords'), array('controller' => 'swords', 'action' => 'index'), array('update'=>'#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New Sword'), array('controller' => 'swords', 'action' => 'add'), array('update'=>'#content')); ?> </li>
	</ul>
</div>
