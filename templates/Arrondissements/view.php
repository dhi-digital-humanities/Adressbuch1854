<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Arrondissement $arrondissement
 */
use Cake\Collection\Collection;


//importe les fonctions nécessaires pour la page

require(__DIR__.'/../functions/functions.php');
require(__DIR__.'/../functions/varsarr.php');

	

	$noStr;
	$type = $arrondissement->type;
	$no = $arrondissement->no;
	if($no == 1){
		$noStr = $no.'ier Arrondissement ('.$type.')';
	} else {
		$noStr = $no.'ième Arrondissement ('.$type.')';
	}
	
$params = $this->request->getQueryParams();
unset($params['Persons[page]']);
unset($params['Companies[page]']);

$uri = $this->request->getRequestTarget();
?>

<?= $this->Html->script('tab2.js')?>
<div class="container">
	<!-- mise en place de tabs pour switcher sur la même page -->
<div id="tabs">
	<ul>
		<li onclick="selView(1, this)" style="border-bottom:2px solid #ED8B00;"><?= __('Ansicht') ?></li>
		<li onclick="selView(2, this)"><?= __('Exportieren') ?></li>
	</ul>
</div>
<div id='tabcontent'>
	<div id='indextab' class='tabpanel' style="display:inline">	
		<div class="row">
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
							<?= $this->element('personsMultiTable', ['count' => true, 'persons' => $persons, 'offset' => (($this->Paginator->current('Persons')-1) * $this->Paginator->param('perPage'))])?>
						<div class="paginator">
							<ul class="pagination">
							<?= $this->Paginator->first('<< ' . __('Anfang')) ?>
							<?= $this->Paginator->prev('< ' . __('zurück')) ?>
							<?= $this->Paginator->numbers() ?>
							<?= $this->Paginator->next(__('vor') . ' >') ?>
							<?= $this->Paginator->last(__('Ende') . ' >>') ?>
							</ul>
							<p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Person(en) von {{count}}')) ?></p>
						</div>
						</details>
            		</div>
			<?php endif; ?>
			<?php if(!$companies->isEmpty()): ?>
            		<div class="related">
                		<details>
							<?= '<summary title="'.__('Klicken für Details').'"><h4>'.__('Unternehmen in diesem Arrondissement').'</h4></summary>' ?>
							<?= $this->element('companiesMultiTable', ['count' => true, 'companies' => $companies]); ?>
						</details>
					</div><br>
					<div>
           			 <?php endif; ?>

					</div>

 					<br> <div class="csl-bib-body" style="line-height: 1.35; margin-left: 2em; text-indent:-2em;">
				<div class="csl-entry">Zitierhinweis: <?php echo $noStr ?>, in: Adressbuch der Deutschen in Paris für das Jahr 1854, hg. v. F.A. Kronauge. Elektronische Edition, DHI Paris 2022, <a target="_blank" href='<?php  $this->request->getUri() ?>'><?php echo $this->request->getUri() ?></a>, CC-BY 4.0.</div>

					<?php print zoteroarr($noStr, $arr1) ?>
          			</div>
				</div>
			</div>
		</div>
	</div>
	<div id='exporttab' class="tabpanel" style="display:none">
		<div class="row">
		<?= $this->Form->postButton('JSON', ['controller' => '', 'action' => $uri, '?' => array_merge($params, ['export' => 'json'])],['class'=>'button2'])?>
		<?= $this->Form->postButton('XML', ['controller' => '', 'action' => $uri, '?' => array_merge($params, ['export' => 'xml'])],['class'=>'button2'])?>
		</div>
	</div>
</div>
</div>