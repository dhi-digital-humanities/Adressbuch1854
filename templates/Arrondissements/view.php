<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Arrondissement $arrondissement
 */
use Cake\Collection\Collection;



require(__DIR__.'/../functions/img_zotero.php');
require(__DIR__.'/../functions/varsarr.php');

	

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
                    <th><?= __('Type') ?></th>
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
					<?= $this->element('personsMultiTable', ['persons' => $persons],['order'=>['id'=> 'ASC']])?>			
				</details>
            </div>
			<?php endif; ?>
			<?php if(!$companies->isEmpty()): ?>
            <div class="related">
                <details>
					<?= '<summary title="'.__('Klicken für Details').'"><h4>'.__('Unternehmen in diesem Arrondissement').'</h4></summary>' ?>
					<?= $this->element('companiesMultiTable', ['companies' => $companies], ['order'=>['id'=> 'ASC']])?>
				</details>
			</div><br>
				<div>
            <?php endif; ?>

</div>

 <br><div class="csl-bib-body" style="line-height: 1.35; margin-left: 2em; text-indent:-2em;">
  <div class="csl-entry">Kronauge, F. «&nbsp;<?php echo $noStr ?>&nbsp;». In <i>Adressbuch der Deutschen in Paris für das Jahr 1854</i>, Elektronische Edition, 1854. <a target="_blank" href='<?php  $this->request->getUri() ?>'><?php echo $this->request->getUri() ?></a>.</div>

<?php print zoteroarr($noStr, $arr1) ?>
          

</div>

</div>
