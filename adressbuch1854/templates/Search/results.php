<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person[]|\Cake\Collection\CollectionInterface $persons
 */
?>
<h2><?= __('Ergebnisse') ?></h2>
<?php echo __('Für Ihre Suchafrage wurden ').
	$this->Paginator->counter(__('{{count}} Person(en)'), ['model' => 'Persons']).
	' und '.
	$this->Paginator->counter(__('{{count}} Unternehmen'), ['model' => 'Companies']).
	' gefunden:';	
?>

<?php if (!$persons->isEmpty()) : ?>
<div class="persons index content">
    <h3><?= __('Personen') ?></h3>
		<!-- TODO: $this->Paginator->limitControl([10 => 10, 25 => 25, 50 => 50]) 
		-> für Ergebnisanzeige? -->
					<!-- TODO: mit Paginator->sort() Sortierung nach Spalten ermöglichen?
						Geht vielleicht nur mit korrekten Modelnamen, nicht mit zusammengesetzten
						Dingen wie Name oder Adresse -->
	
	<?= $this->element('personsMultiTable', ['persons' => $persons, 'count' => true])?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Anfang')) ?>
            <?= $this->Paginator->prev('< ' . __('zurück')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('vor') . ' >') ?>
            <?= $this->Paginator->last(__('Ende') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Person(en) von {{count}}'), ['model' => 'Persons']) ?></p>
    </div>
</div>
<?php endif; ?>
<?php if (!$companies->isEmpty()) : ?>
<div class="companies index content">
    <h3><?= __('Unternehmen') ?></h3>
	<?= $this->element('companiesMultiTable', ['companies' => $companies, 'count' => true])?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Anfang')) ?>
            <?= $this->Paginator->prev('< ' . __('zurück')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('vor') . ' >') ?>
            <?= $this->Paginator->last(__('Ende') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Unternehmen von {{count}}'), ['model' => 'Companies']) ?></p>
    </div>
</div>
<?php endif; ?>
<div class="export content">
	<h4>Ergebnisse exportieren</h4>
	<?= $this->Form->postButton('Json', ['controller' => 'Search', 'action' => 'export/json', 'data' => ['persons' => $persons, 'companies' => $companies]])?>
	<?= $this->Form->postButton('XML', ['controller' => 'Search', 'action' => 'export/xml', 'data' => ['persons' => $persons, 'companies' => $companies]])?>
	...oder...
	<h4> Gesamte Datenbank exportieren</h4>
	<?= $this->Form->postButton('SQL', ['controller' => 'Search', 'action' => 'export/sql', 'data' => ['persons' => $persons, 'companies' => $companies]])?>
	<?= $this->Form->postButton('CSV', ['controller' => 'Search', 'action' => 'export/csv', 'data' => ['persons' => $persons, 'companies' => $companies]])?>
</div>
<div id="mapBox" onload="initializeMap('multiView')">
	Dies ist ein Platzhalter-Div für die Karte.
</div>