<div class="posts view">
<h2><?php  echo __('Post'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($post['Post']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($post['Post']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Body'); ?></dt>
		<dd>
			<?php echo h($post['Post']['body']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($post['Post']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($post['Post']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Js->link($post['User']['id'], array('controller' => 'users', 'action' => 'view', $post['User']['id']), array('update' => '#content')); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Js->link(__('Edit Post'), array('controller' => 'posts','action' => 'edit', $post['Post']['id']), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Post'), array('controller' => 'posts','action' => 'delete', $post['Post']['id']), null, __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?> </li>
		<li><?php echo $this->Js->link(__('List Posts'), array('controller' => 'posts','action' => 'index'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New Post'), array('controller' => 'posts','action' => 'add'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('update' => '#content')); ?> </li>
		<li><?php echo $this->Js->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('update' => '#content')); ?> </li>
	</ul>
</div>
