<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Arrondissement $arrondissement
 */

	use Cake\Collection\Collection;

	$noStr;
	$type = $arrondissement->type;
	$no = $arrondissement->no;
	if($no == 1){
		$noStr = $no.'ier Arrondissement ('.$type.')';
	} else {
		$noStr = $no.'ième Arrondissement ('.$type.')';
	}
?>
<div class="row">
    <?= $this->element('sideNav', ['mapBox' => false, 'export' => 'all'])?>
    <div class="column-responsive column-80">
        <div class="arrondissements view content">
            <h3><?= h($noStr) ?></h3>
            <table>
				<tr>
                    <th><?= __('Nummer') ?></th>
                    <td><?= $this->Number->format($arrondissement->no) ?></td>
                </tr>
				<tr>
                    <th><?= __('Typ') ?></th>
                    <td><?= $type == 'pre1860' ? 'Aus Einteilung vor 1860' : 'Aus Einteilung nach 1860' ?></td>
                </tr>
				<?php if($type == 'post1860') : ?>
                <tr>
                    <th><?= __('Postleitzahl') ?></th>
                    <td><?= $arrondissement->postcode ?></td>
                </tr>
                <tr>
                    <th><?= __('INSEE Citycode') ?></th>
                    <td><?= $arrondissement->insee_citycode ?></td>
                </tr>
				<?php endif; ?>
            </table>
			<?php if(!$persons->isEmpty()): ?>
            <div class="related">
                <details>
					<?= '<summary title="'.__('Klicken für Details').'"><h4>'.__('Personen in diesem Arrondissement').'</h4></summary>' ?>
					<?= $this->element('personsMultiTable', ['persons' => $persons])?>
				</details>
            </div>
			<?php endif; ?>
			<?php if(!$companies->isEmpty()): ?>
            <div class="related">
                <details>
					<?= '<summary title="'.__('Klicken für Details').'"><h4>'.__('Unternehmen in diesem Arrondissement').'</h4></summary>' ?>
					<?= $this->element('companiesMultiTable', ['companies' => $companies])?>
				</details>
            </div>
			<?php endif; ?>
        </div>
		<?= $this->element('citation', ['id' => $arrondissement->id, 'type' => 'A', 'title' => $noStr, 'url' => $this->request->getUri()])?>
    </div>
</div>
