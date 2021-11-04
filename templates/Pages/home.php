<?php
/*
Homepage
*/
?>

<div class="row">
    <?= $this->element('sideNav', ['mapBox' => false, 'export' => 'simple'])?>
    <div class="column-responsive column-80">
		<div class="content">
			<h3><?= __('Willkommen') ?></h3>
			<h4><?=__('Projekt "Adressbuch der Deutschen in Paris von 1854"') ?></h4>
			
			<p class='p'>
			Relaunch von <a target="blank" href='http://adressbuch1854.dhi-paris.fr'>http://adressbuch1854.dhi-paris.fr</a><br>

			Ein Projekt des Deutschen Historichen Instituts Paris (DHIP)<br>

			Website des DHIP: <a target="blank" href='https://www.dhi-paris.fr/home.html'>https://www.dhi-paris.fr/home.html</a><br>

			Website der Abteilung: <a target="blank" href='https://www.dhi-paris.fr/forschung/digital-humanities.html'>https://www.dhi-paris.fr/forschung/digital-humanities.html</a><br>

			Alle Daten des Adressbuchs: <a target="blank" href="https://doi.org/10.5281/zenodo.5524880">https://doi.org/10.5281/zenodo.5524880</a>

		</p>
			<a target='_blank' href='http://adressbuch1854.dh.uni-koeln.de/scans/HD/BHVP_703983_001.jpg'><img class='homepage' src='http://adressbuch1854.dh.uni-koeln.de/scans/SD/BHVP_703983_001.jpg' alt='Seite der Adressbuch' title='IHA zur Nutzung der Seite'/></a>
		
		</div>
	</div>
</div>
