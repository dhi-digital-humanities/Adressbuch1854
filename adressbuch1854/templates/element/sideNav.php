<aside class="column">
	<div class="side-nav">
		<h4 class="heading"><?= __('Zeige alle...') ?></h4>
		<?= $this->Html->link(__('Personen'), ['controller' => 'Persons', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
		<?= $this->Html->link(__('Unternehmen'), ['controller' => 'Companies', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
		<?= $this->Html->link(__('Straßen'), ['controller' => 'Streets', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
		<?= $this->Html->link(__('Arrondissements'), ['controller' => 'Arrondissements', 'action' => 'index'], ['class' => 'side-nav-item']) ?>
	</div>
	<?php if($mapBox):?>
	<div id="mapBox" onload="initializeMap('singleView')">
		Dies ist ein Platzhalter-Div für die Karte.
	</div>
	<?php endif; ?>
</aside>