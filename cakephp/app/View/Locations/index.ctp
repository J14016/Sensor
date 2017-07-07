
<?php echo $this->Html->script('http://maps.google.com/maps/api/js?key=AIzaSyATm0UXmhPB9xn-3VlAfPkR963g2ibt5Oc&sensor=true',false); ?>

<div class="locations index">
	<h2><?php echo __('Locations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('zipcode'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('latitude'); ?></th>
			<th><?php echo $this->Paginator->sort('longitude'); ?></th>
			<th><?php echo $this->Paginator->sort('elevation'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($locations as $location): ?>
	<tr>
		<td><?php echo h($location['Location']['id']); ?>&nbsp;</td>
		<td><?php echo h($location['Location']['name']); ?>&nbsp;</td>
		<td><?php echo h($location['Location']['zipcode']); ?>&nbsp;</td>
		<td><?php echo h($location['Location']['address']); ?>&nbsp;</td>
		<td><?php echo h($location['Location']['latitude']); ?>&nbsp;</td>
		<td><?php echo h($location['Location']['longitude']); ?>&nbsp;</td>
		<td><?php echo h($location['Location']['elevation']); ?>&nbsp;</td>
		<td><?php echo h($location['Location']['created']); ?>&nbsp;</td>
		<td><?php echo h($location['Location']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $location['Location']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $location['Location']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $location['Location']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $location['Location']['id']))); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	
	
	
	
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
	
	var data;
	var chart;
	
	// Load the Visualization API and the piechart package.
	google.charts.load('current', {'packages':['corechart']});

	// Set a callback to run when the Google Visualization API is loaded.
	google.charts.setOnLoadCallback(drawChart);

	// Callback that creates and populates a data table,
	// instantiates the pie chart, passes in the data and
	// draws it.
	function drawChart() {
		
	// Create our data table.
	var data = google.visualization.arrayToDataTable([
		['name', 'elevation'],
		<?php foreach ($locations as $location): ?>
        	[
			"<?php echo $location['Location']['name']; ?>",
			<?php echo $location['Location']['elevation']; ?>
        	],
		<?php endforeach; ?>
	]);
	/*
        data = new google.visualization.DataTable();
	
        data.addColumn('string', 'name');
        data.addColumn('number', 'elevation');
	
        data.addRows([
        	<?php foreach ($locations as $location): ?>
        	[
			"<?php echo $location['Location']['name']; ?>",
			<?php echo $location['Location']['elevation']; ?>
        	],
		<?php endforeach; ?>
        ]);
	*/

        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        google.visualization.events.addListener(chart, 'select', selectHandler);
        chart.draw(data, options);
	}

	function selectHandler() {
		var selectedItem = chart.getSelection()[0];
		var value = data.getValue(selectedItem.row, 0);
		alert('The user selected ' + value);
	}

	</script>
	<div id="chart_div" style="width: 900px; height: 500px;"></div>


	
	<?php $map_options = null; ?>
	<?php $i=1; ?>
	<?php foreach($locations as $location): ?>
	<?php
	if($i == 1) {
		$latitude = $location['Location']['latitude'];
		$longitude = $location['Location']['longitude'];
		$address = $location['Location']['address'];
		$i++;
		$map_options = array(
			'id' => 'map1',
			'zoom' => 14,
			'type' => 'ROAD',
			//'custom' => null,
			'localize' => false,
			'latitude' => $latitude,
			'longitude' => $longitude,
			'marker' => true,
			'markerIcon' => 'http://maps.google.com/mapfiles/kml/shapes/parking_lot_maps.png',
			'infoWindow' => true,
			'windowText' => $location['Location']['name'].":".$location['Location']['address']
		);
	}
	?>
	<?php endforeach; ?>
	<div id = "map">
	<?php echo $this->GoogleMap->map($map_options); ?>
	</div>
	
	<?php $i=1; ?>
	<?php foreach($locations as $location): ?>
	<?php
	if($i>1) {
		$marker_options = array(
			'showWindow' => true,
			'windowText' => $location['Location']['name'].":".$location['Location']['address'],
			'markerTitle' => 'Title',
			'markerIcon' => 'https://maps.google.com/mapfiles/kml/shapes/parking_lot_maps.png',
	 	);
		echo $this->GoogleMap->addMarker('map1', $i, array('latitude' => $location['Location']['latitude'], 'longitude' => $location['Location']['longitude']), $marker_options);	
	}
	$i++;
	?>
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
		<li><?php echo $this->Html->link(__('New Location'), array('action' => 'add')); ?></li>
	</ul>
</div>
