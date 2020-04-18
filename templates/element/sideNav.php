<?php
/*
Contains a side Navigation.
$export: all/simple/none, means: none -> no export; simple -> export for the entire database; all -> export for entire database and current datasets
*/
echo $this->Html->css(['map', 'export']);

$uri = $this->request->getRequestTarget();
?>

<aside class="column">
	<?php if($mapBox):?>
		<div class="smallMap">
			<div id="mapBox"  class="content" onload="initializeMap(true)">
				<?= $this->Html->script('map_paris_leaflet.js') ?>
			</div>
		</div>
	<?php endif; ?>
	<div class="side-nav" id="showallheading">
		<h4 class="heading"><?= __('Zeige alle...') ?></h4>
		<?= $this->Html->link(__('Personen'), ['controller' => 'Persons', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
		<?= $this->Html->link(__('Unternehmen'), ['controller' => 'Companies', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
		<?= $this->Html->link(__('Straßen'), ['controller' => 'Streets', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
		<?= $this->Html->link(__('Arrondissements'), ['controller' => 'Arrondissements', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
		<?php if($export != 'none'):?>
		<h4 class="heading" id="exportheading"><?=__('Export')?></h4>
		<div class="export-side">
		<?php if($export === 'all'):?>
			<div class="export-item">
				<h5><?=__('Aktuelle Datensätze')?></h5>
				<?= $this->Form->postButton('Json', ['controller' => '', 'action' => $uri.'?format=json&down=true'])?>
				<?= $this->Form->postButton('XML', ['controller' => '', 'action' => $uri.'?format=xml&down=true'])?>
			</div>
		<?php endif;?>
			<div class="export-item">
				<h5><?=__('Gesamte Datenbank')?></h5>
				<?= $this->Form->postButton('SQL', ['controller' => 'Search', 'action' => 'export?format=sql'])?>
				<?= $this->Form->postButton('CSV', ['controller' => 'Search', 'action' => 'export?format=csv'])?>
			</div>
		</div>
		<?php endif;?>
	</div>
</aside>