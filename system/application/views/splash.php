<?php $this->load->view('page/header'); ?>

<table class="datatable tablesorter">
	<thead>
		<tr>
			<th>Country</th>
			<th>Year</th>
		</tr>
	</thead>
	
	<tbody>
	<?php foreach ($countries as $country): ?>
		<tr>
			<td><?=anchor('site/country/'.$country, $country)?></td>
			<td>
				<?php foreach ($years as $year): ?>
					<?=anchor('site/year/'.$year, $year)?>
				<?php endforeach ?>
			</td>
		</tr>
	<?php endforeach ?>
	</tbody>
</table>


<?php $this->load->view('page/footer'); ?>