<div class="news index">
	<h2><?php echo __('News'); ?></h2>
	<?php foreach ($news as $news): ?>
	<div style="margin: 10px">
		<ul style="list-style: none">
			<li>
				<h3>
					<?php
						echo $this->Html->link(h($news['News']['title']), array('controller' => 'news', 'action' => 'view', 'id' => $news['News']['id'], 'title' => h($news['News']['title'])));
					?>
				</h3>
			</li>
			<li><?php echo h($news['News']['created']); ?></li>
			<li><?php echo String::truncate(h($news['News']['body']), 15); ?></li>
		</ul>
	</div>
	<hr />
	<?php endforeach; ?>
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
		<li><?php echo $this->Html->link(__('Administrace'), array('admin' => true, 'controller' => 'users', 'action' => 'login')); ?></li>
	</ul>
</div>
