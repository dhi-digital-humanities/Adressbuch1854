<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person[]|\Cake\Collection\CollectionInterface $persons
 */

 use Cake\Routing\Router;

 echo $this->Html->css(['export', 'map']);

 $uri = $this->request->getRequestTarget();

//  The params must be given to the pagination links, since it will otherwise not
// show the desired results, but the results for an empty query string.
// The current pagination param for Person or Company must be unset first
// to avoid overriding.
 $params = $this->request->getQueryParams();
 unset($params['Persons']);
 unset($params['Companies']);

?>
<h2><?= __('Ergebnisse') ?></h2>
<?php echo __('Für Ihre Suchanfrage wurden ').
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
			<?= $this->element('personsMultiTable', ['persons' => $persons, 'count' => true, 'offset' => (($this->Paginator->current('Persons')-1) * $this->Paginator->param('perPage', 'Persons'))])?>
			<div class="paginator">
				<ul class="pagination">
					<?= $this->Paginator->first('<< ' . __('Anfang'), ['model' => 'Persons', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->prev('< ' . __('zurück'), ['model' => 'Persons', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->numbers(['model' => 'Persons', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->next(__('vor') . ' >', ['model' => 'Persons', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->last(__('Ende') . ' >>', ['model' => 'Persons', 'url' => ['?' => $params]]) ?>
				</ul>
				<p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Person(en) von {{count}}'), ['model' => 'Persons']) ?></p>
			</div>
		<?php endif; ?>
		<?php if (!$companies->isEmpty()) : ?>
			<h3><?= __('Unternehmen') ?></h3>
			<?= $this->element('companiesMultiTable', ['companies' => $companies, 'count' => true, 'offset' => (($this->Paginator->current('Companies')-1) * $this->Paginator->param('perPage', 'Companies'))])?>
			<div class="paginator">
				<ul class="pagination">
					<?= $this->Paginator->first('<< ' . __('Anfang'), ['model' => 'Companies', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->prev('< ' . __('zurück'), ['model' => 'Companies', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->numbers(['model' => 'Companies', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->next(__('vor') . ' >', ['model' => 'Companies', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->last(__('Ende') . ' >>', ['model' => 'Companies', 'url' => ['?' => $params]]) ?>
				</ul>
				<p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Unternehmen von {{count}}'), ['model' => 'Companies']) ?></p>
			</div>
		<?php endif; ?>
		</div>
		<div class="bigMap">
			<div id="mapBox" class="content" onload="initializeMap()">
				<?= $this->Html->script('address-map.js') ?>
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
