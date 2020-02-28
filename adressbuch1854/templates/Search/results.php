<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person[]|\Cake\Collection\CollectionInterface $persons
 */
 
 use Cake\Routing\Router;
 echo $this->Html->css(['export', 'map']);
 $uri = $this->request->getRequestTarget();
?>
<h2><?= __('Ergebnisse') ?></h2>
<?php echo __('Für Ihre Suchafrage wurden ').
	$this->Paginator->counter(__('{{count}} Person(en)'), ['model' => 'Persons']).
	' und '.
	$this->Paginator->counter(__('{{count}} Unternehmen'), ['model' => 'Companies']).
	' gefunden:';	
?>
<div class="row">
    <?= $this->element('sideNav', ['mapBox' => false, 'export' => 'all'])?>
    <div class="column-responsive column-80">
		<?php if (!($persons->isEmpty() && $companies->isEmpty())) : ?>
		<div class="content">
		<?php if (!$persons->isEmpty()) : ?>
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
		<?php endif; ?>
		<?php if (!$companies->isEmpty()) : ?>
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
		<?php endif; ?>
		</div>
		<div class="bigMap">
			<div id="mapBox" class="content" onload="initializeMap(true)">
				<?= $this->Html->script('map_paris_leaflet.js') ?>
			</div>
		</div>
		<?php else: ?>
		<div class="content">
			<h3><?= __('Keine Ergebnisse') ?></h3>
			<p> <?= $this->Html->link(__('Zurück zur Suche'), ['action' => 'query'])?> </p>
		</div>
		<?php endif;?>
	</div>
</div>