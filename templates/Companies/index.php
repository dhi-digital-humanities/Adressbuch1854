<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company[]|\Cake\Collection\CollectionInterface $companies
 */
?>

<div class="row">
    <?= $this->element('sideNav', ['mapBox' => false, 'export' => 'all'])?>
    <div class="column-responsive column-80">
		<div class="content">
			<h3><?= __('Unternehmen') ?></h3>
			<?= $this->element('companiesMultiTable', ['count' => true, 'companies' => $companies])?>
			<div class="paginator">
				<ul class="pagination">
					<?= $this->Paginator->first('<< ' . __('Anfang')) ?>
					<?= $this->Paginator->prev('< ' . __('zurück')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('vor') . ' >') ?>
					<?= $this->Paginator->last(__('Ende') . ' >>') ?>
				</ul>
				<p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Unternehmen von {{count}}')) ?></p>
			</div>
		</div>
		<div class="bigMap">
			<div id="mapBox" class="content" onload="initializeMap(true)">
				<?= $this->Html->script('map_paris_leaflet.js') ?>
			</div>
		</div>
    </div>
</div>