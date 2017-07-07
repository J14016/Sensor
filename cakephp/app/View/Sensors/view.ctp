<div class="sensors view">
<h2><?php echo __('Sensor'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sensor['Sensor']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($sensor['Sensor']['data']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sensor'), array('action' => 'edit', $sensor['Sensor']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sensor'), array('action' => 'delete', $sensor['Sensor']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $sensor['Sensor']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Sensors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sensor'), array('action' => 'add')); ?> </li>
	</ul>
</div>
