<div class="tests form">
	<?php echo $this->Form->create('Post'); ?>
	<fieldset>
		<legend><?php echo __('新規投稿'); ?></legend>
		<?php
			echo $this->Form->input('title');
			echo $this->Form->input('body');
		?>
	</fieldset>
	<?php echo $this->Form->end(__('submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('一覧'), array('action'=>'index')); ?></li>
	</ul>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('新規投稿'), array('action'=>'add')); ?></li>
	</ul>
</div>