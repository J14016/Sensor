<div class="sensors form">
<?php echo $this->Form->create('Sensor'); ?>
	<fieldset>
		<legend><?php echo __('Edit Sensor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('data');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Sensor.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Sensor.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Sensors'), array('action' => 'index')); ?></li>
	</ul>
</div>
