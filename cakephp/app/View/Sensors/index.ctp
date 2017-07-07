<div class="sensors index">
	<h2><?php echo __('Sensors'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('data'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($sensors as $sensor): ?>
	<tr>
		<td><?php echo h($sensor['Sensor']['id']); ?>&nbsp;</td>
		<td><?php echo h($sensor['Sensor']['data']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $sensor['Sensor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $sensor['Sensor']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sensor['Sensor']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $sensor['Sensor']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	
	
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		var data = google.visualization.arrayToDataTable([
			['id', 'data'],
			<?php foreach ($sensors as $sensor): ?>
			[
				"<?php echo $sensor['Sensor']['id']; ?>",
				<?php echo $sensor['Sensor']['data']; ?>
			],
			<?php endforeach; ?>
		]);

		var options = {
			title: 'Company Performance',
			curveType: 'function',
			legend: { position: 'bottom' }
		};

		var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

		chart.draw(data, options);
	}
	</script>
	<div id="curve_chart" style="width: 1200px; height: 600px"></div>

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
		<li><?php echo $this->Html->link(__('New Sensor'), array('action' => 'add')); ?></li>
	</ul>
</div>
