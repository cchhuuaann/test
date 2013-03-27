<?php ?>
<div class="page" id="vyzkum">
	<div id="cesta"><?= vykresli_navigaci($model) ?></div>
	
	<h2>Výzkum</h2>
	<p>
		Signal processing laboratory je Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Praesent eget lacus vulputate orci cursus semper sit amet vel mi. Lorem ipsuetur adipiscing elit. 
Praesent eget lacus vulputate orci cursus semper sit amet vel mi.
	</p>
	<ul>
		<li id="data-mining">
			<h3><a href="<?php echo URL . $model . "?nav=data-mining"; ?>">data-mining</a></h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Praesent eget lacus vulputate orci cursus semper sit amet vel mi.</p>
		</li>
		<li id="interakce_clovek-stroj">
			<h3><a href="<?php echo URL . $model . "?nav=interakce_clovek-stroj"; ?>">interakce člověk-stroj</a></h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Praesent eget lacus vulputate orci cursus </p>
		</li>
		<li id="neortogonalni_reprezentace_signalu">
			<h3><a href="<?php echo URL . $model . "?nav=neortogonalni_reprezentace_signalu"; ?>">neortogonální reprezentace signálů</a></h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. consectetur adipiscing 
Praesent eget lacus vulputate orci cursus semper sit amet vel mi.</p>
		</li>
		<li id="zpracovani_akustickych_signalu">
			<h3><a href="<?php echo URL . $model . "?nav=zpracovani_akustickych_signalu"; ?>">zpracování akustických signálů</a></h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Praesent eget lacus</p>
		</li>
		<li id="zpracovani_medicinskych_signalu">
			<h3><a href="<?php echo URL . $model . "?nav=zpracovani_medicinskych_signalu"; ?>">zpracovaní medicínských signálů</a></h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
Praesent eget lacus vulputate orci cursus semper sit amet vel mi.</p>
		</li>
	</ul>
</div>

<?php
	vykresli_aktual_info();
?>