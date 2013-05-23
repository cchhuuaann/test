<div class="users Form">
<?php
	echo $this->Session->flash('auth');
	echo $this->Form->create('User');
 ?>
 	<fieldset>
 		<legend>
 			<?php echo __('Please enter your username and password'); ?>
 		</legend>
 			<?php
 				echo $this->Form->input('username');
 				echo $this->Form->input('password');
 			?>
 	</fieldset>
 	<?php echo $this->form->end(__('Login')); ?>
</div>