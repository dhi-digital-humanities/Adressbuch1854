<?php
/*
Contains a side Navigation.
*/
echo $this->Html->css('export.css');
$uri = $this->request->getRequestTarget();
?>

<aside class="column">
	<div class="side-nav">
		<h4 class="heading"><?= __('Zeige alle...') ?></h4>
		<?= $this->Html->link(__('Personen'), ['controller' => 'Persons', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
		<?= $this->Html->link(__('Unternehmen'), ['controller' => 'Companies', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
		<?= $this->Html->link(__('Straßen'), ['controller' => 'Streets', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
		<?= $this->Html->link(__('Arrondissements'), ['controller' => 'Arrondissements', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
		<h4 class="heading" id="exportheading"><?=__('Export')?></h4>
		<div class="export-side">
			<div class="export-item">
				<h5><?=__('Aktuelle Datensätze')?></h5>
				<?= $this->Form->postButton('Json', ['controller' => '', 'action' => $uri.'?format=json&down=true'])?>
				<?= $this->Form->postButton('XML', ['controller' => '', 'action' => $uri.'?format=xml&down=true'])?>
			</div>
			<div class="export-item">
				<h5><?=__('Gesamte Datenbank')?></h5>
				<?= $this->Form->postButton('SQL', ['controller' => 'Search', 'action' => 'export?format=sql'])?>
				<?= $this->Form->postButton('CSV', ['controller' => 'Search', 'action' => 'export?format=csv'])?>
			</div>
		</div>
	</div>
	<?php if($mapBox):?>
	<div id="mapBox" onload="initializeMap('singleView')">
		Dies ist ein Platzhalter-Div für die Karte.
	</div>
	<?php endif; ?>
</aside>