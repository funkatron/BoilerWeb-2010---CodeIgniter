<?php $this->load->view('page/header'); ?>

<table class="datatable tablesorter">
	<thead>
		<tr>
			<th>Country</th>
			<th>Year</th>
			<th>Population</th>
		</tr>
	</thead>
	
	<tbody>
	<?php foreach ($data as $row): ?>
		<tr>
			<td><?=anchor('site/country/'.$row->country, $row->country)?></td>
			<td><?=anchor('site/year/'.$row->year, $row->year)?></td>
			<td><?=$row->population?></td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>

<?php $this->load->view('page/footer'); ?>