<div class="sensors form">
<?php echo $this->Form->create('Sensor'); ?>
	<fieldset>
		<legend><?php echo __('Add Sensor'); ?></legend>
	<?php
		echo $this->Form->input('data');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sensors'), array('action' => 'index')); ?></li>
	</ul>
</div>
