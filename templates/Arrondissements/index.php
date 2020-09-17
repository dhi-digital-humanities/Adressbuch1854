<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Arrondissement[]|\Cake\Collection\CollectionInterface $arrondissements

 */

?>
<div class="row">
    <?= $this->element('sideNav', ['mapBox' => false, 'export' => 'all'])?>
    <div class="column-responsive column-80">
		<div class="content">
			<h3><?= __('Arrondissements') ?></h3>
			<div class="table-responsive">
				<table>
					<thead>
						<tr>
							<th><?= __('Nr') ?></th>
							<th><?= __('Arrondissement') ?></th>
							<th><?= __('Typ') ?></th>
							<th><?= __('Postleitzahl') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$countNo = 1 + (($this->Paginator->current('Arrondissements')-1) * $this->Paginator->param('perPage'));
							foreach ($arrondissements as $arrondissement): ?>
						<?php
						$noStr;
						$no = $arrondissement->no;
						if($no == 1){
							$noStr = $no.'ier';
						} else {
							$noStr = $no.'ième';
						}
						?>
						<tr>
							<td><?= $this->Number->format($countNo) ?></td>
							<td><?= $this->Html->link($noStr, ['action' => 'view', $arrondissement->id]) ?></td>
							<td><?= $arrondissement->type == 'pre1860' ? 'Vor 1860' : 'Nach 1860' ?></td>
							<td><?= $arrondissement->postcode ?></td>
						</tr>
						<?php
						$countNo++;
						endforeach; ?>
					</tbody>
				</table>
			</div>
			<div class="paginator">
				<ul class="pagination">
					<?= $this->Paginator->first('<< ' . __('Anfang')) ?>
					<?= $this->Paginator->prev('< ' . __('zurück')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('vor') . ' >') ?>
					<?= $this->Paginator->last(__('Ende') . ' >>') ?>
				</ul>
				<p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Arrondissement(s) von {{count}}')) ?></p>
			</div>
		</div>
		<!-- <div class="bigMap">
			<div id="mapBox" class="content" onload="initializeMap()">
				<?= $this->Html->script('address-map.js') ?>
			</div>
		</div>
        This is a placeholder for a map
        -->
	</div>
</div>
