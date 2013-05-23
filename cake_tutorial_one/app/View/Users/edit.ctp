<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('role');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Js->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('update' => '#content')); ?></li>
		<li><?php echo $this->Js->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New Post'), array('controller' => 'posts', 'action' => 'add'), array('update' => '#content')); ?> </li>
	</ul>
</div>
