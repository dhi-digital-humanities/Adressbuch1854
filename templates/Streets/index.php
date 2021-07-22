<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Street[]|\Cake\Collection\CollectionInterface $streets
 */
?>

<div class="row">
    <?= $this->element('sideNav', ['mapBox' => false, 'export' => 'all'])?>
    <div class="column-responsive column-80">
		<div class="content">
			<h3><?= __('Straßen') ?></h3>
			<div class="table-responsive">
				<table>
					<thead>
						<tr>
							<th><?= __('Nr') ?></th>
							<th><?= __('Name alt') ?></th>
							<th><?= __('Name heute') ?></th>
							<th><?= __('Arrondissements') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php
						$countNo = 1 + (($this->Paginator->current('Streets')-1) * $this->Paginator->param('perPage'));
						foreach ($streets as $street): ?>
						<?php
							$arrsOld = [];
							$arrsNew = [];
							foreach($street->arrondissements as $arr){
								if($arr->type === 'pre1860'){
									array_push($arrsOld, $this->Html->link($arr->no, ['controller' => 'Arrondissements', 'action' => 'view', $arr->id]));
								} else {
									array_push($arrsNew, $this->Html->link($arr->no, ['controller' => 'Arrondissements', 'action' => 'view', $arr->id]));
								}
							}
						?>
						<tr>
							<td><?= $this->Number->format($countNo) ?></td>
							<td><?= htmlspecialchars_decode($this->Html->link(h($street->name_old_clean), ['action' => 'view', $street->id])) ?></td>
							<td><?= h($street->name_new) ?></td>
							<td>
								<table>
									<tr>
										<th><?= __('Vor 1860')?></th>
										<th><?= __('Nach 1860')?></th>
									</tr>
									<tr>
										<th><?= implode(', ', $arrsOld) ?></th>
										<th><?= implode(', ', $arrsNew) ?></th>
									</tr>
								</table>
							</td>
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
				<p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Straße(n) von {{count}}')) ?></p>
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
