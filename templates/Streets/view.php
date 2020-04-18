<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Street $street
 */
	use Cake\Collection\Collection;
	
	$varieties = [];
	foreach($sameStreets as $sameStr){
		array_push($varieties, h($sameStr->name_old_verbatim));
	}
	
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
<div class="row">
    <?= $this->element('sideNav', ['mapBox' => false, 'export' => 'all'])?>
    <div class="column-responsive column-80">
        <div class="streets view content">
            <h3><?= h($street->name_old_clean) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name alt') ?></th>
                    <td><?= h($street->name_old_clean) ?></td>
                </tr>
                <tr>
                    <th><?= __('Schreibweisen im Buch') ?></th>
                    <td><?= implode(', ', $varieties) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name heute') ?></th>
                    <td><?= h($street->name_new) ?></td>
                </tr>
				<tr>
                    <th><?= __('Arrondissements') ?></th>
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
            </table>
			<?php if(!$persons->isEmpty()): ?>
            <div class="related">
                <details>
					<?= '<summary title="'.__('Klicken für Details').'"><h4>'.__('Personen in dieser Straße').'</h4></summary>' ?>
					<?= $this->element('personsMultiTable', ['persons' => $persons])?>
				</details>
            </div>
			<?php endif; ?>
			<?php if(!$companies->isEmpty()): ?>
            <div class="related">
                <details>
					<?= '<summary title="'.__('Klicken für Details').'"><h4>'.__('Unternehmen in dieser Straße').'</h4></summary>' ?>
					<?= $this->element('companiesMultiTable', ['companies' => $companies])?>
				</details>
            </div>
			<?php endif; ?>
        </div>
		<?= $this->element('citation', ['id' => $street->id, 'type' => 'S', 'title' => $street->name_old_clean, 'url' => $this->request->getUri()])?>
    </div>
</div>
