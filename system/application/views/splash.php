<?php $this->load->view('page/header'); ?>

<div id="countries-list">
	<h2>Countries</h2>
	<ul>
	<?php foreach ($countries as $country): ?>
		<li><?=anchor('site/country/'.$country, $country)?></li>
	<?php endforeach ?>
	</ul>

</div>

<div id="years-list">
	<h2>Years</h2>
	<ul>
	<?php foreach ($years as $year): ?>
		<li><?=anchor('site/year/'.$year, $year)?></li>
	<?php endforeach ?>
	</ul>
</div>


<?php $this->load->view('page/footer'); ?>