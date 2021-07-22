<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 */

require_once(__DIR__.'/../functions/img_zotero.php');
require(__DIR__.'/../functions/varscomp.php');

 $this->Html->css('view');

	$pageRefs = [];
	foreach($company->original_references as $ref){
		$pageRef = __('S. ');
		$begP = $ref->begin_page_no;
		$endP = $ref->end_page_no;
		if($endP != null){
			$pageRef .= $begP.'-'.$endP;
		} else {
			$pageRef .= $begP;
		}
		if($begP >= 9 && $begP <=18){
			$pageRef .= ' '.__('(Geschäftsliste)');
		}
		array_push($pageRefs, $pageRef);
	}

?>
<div class="row">
    <?= $this->element('sideNav', ['mapBox' => true, 'export' => 'all'])?>
    <div class="column-responsive column-80">
        <div class="companies view content">
            <h3><?= h($company->name) ?></h3>
			<?=	!empty($pageRefs) ? __('Eintrag im Buch auf ').implode(' und ', $pageRefs).'.' : '' ?>
            <table>
            	<tr>
            		<th><?= __('Scan der Seite')?></th>
            		<td>
							<?php print image('/../img/','SD/','BHVP_703983_',$begP);?><br>
						
						<details>
							<summary><?= __('Seite in HD ansehen')?></summary>
						<form>
							<button type='submit' title="IHA zur Nutzung der Seite <?php echo $begP?>" formtarget='_blank' formaction='/../img/HD/BHVP_703983_<?php echo $begP ?>.jpg'

							value="text">BHVP_703983_<?php echo $begP?>.jpg</button>
						</form>
						</details>

            	   </td> 
            	</tr>
            	<tr>
            		<th><?= __('Volltexterkennung')?></th>
            		<td>
            		<details>
							<summary><?= __('Volltext der Seite ansehen')?></summary>
						<form>
							<button type='submit' formtarget='_blank' formaction='/../Ocerisations/BHVP_703983_<?php echo $begP ?>.txt'

							value="text">BHVP_703983_<?php echo $begP?>.txt</button>
						</form>
						</details>
            		</td>
            	</tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($company->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Anmerkungen wörtlich') ?></th>
                    <td><?= h($company->specification_verbatim) ?></td>
                </tr>
                <tr>
                    <th><?= __('Beruf') ?></th>
                    <td><?= h($company->profession_verbatim) ?></td>
                </tr>
                <tr>
                    <th><?= __('Berufskategorie') ?></th>
                    <td><?= $company->has('prof_category') ? $company->prof_category->name : '' ?></td>
                </tr>
				<tr>
					<th><?=__('Adresse(n)')?></th>
					<td>
					<?php if (!empty($company->addresses)) : ?>
					<?= htmlspecialchars_decode($this->element('addressList', ['addresses' => $company->addresses, 'list' => true])) ?>
					<?php endif; ?>
					</td>
				</tr>
				<tr>
                    <th><?= __('Sonstige Merkmale') ?></th>
                    <td>
						<table>
							<tr>
								<th><?= __('Vorab-Abonnent (fett)')?></th>
								<th><?= __('Notable Commerçant [NC]')?></th>
								<th><?= __('In Geschäftsliste')?></th>
							</tr>
							<tr>
								<td><?=$company->bold ? __('Ja') : __('Nein');?></td>
								<td><?=$company->notable_commercant ? __('Ja') : __('Nein');?></td>
								<td><?=$company->advert ? __('Ja') : __('Nein');?></td>
							</tr>
						</table>
					</td>
                </tr>
            </table>
            <?php if (!empty($company->persons)) : ?>
			<div class="related">
                <details>
					<?= '<summary title="'.__('Klicken für Details').'"><h4>'.__('Assoziierte Personen').'</h4></summary>' ?>
					<?= $this->element('personsMultiTable', ['persons' => $company->persons])?>
				</details>
            </div>
            <?php endif; ?>
			<?php if (!empty($company->external_references)) : ?>
			<div class="related">
                <details>
					<?= '<summary title="'.__('Klicken für Details').'"><h4>'.__('Literatur- und Quellenhinweise').'</h4></summary>' ?>
					<?= $this->element('externalReferenceMultiTable', ['externalReferences' => $company->external_references])?>
				</details>
			</div>
			<div>
<?php endif; ?>
			     

</div>

 <br><div class="csl-bib-body" style="line-height: 1.35; margin-left: 2em; text-indent:-2em;">
  <div class="csl-entry">Kronauge, F.«&nbsp;<?php echo $nachname ?>&nbsp;». In <i>Adressbuch der Deutschen in Paris für das Jahr 1854</i>, Elektronische Edition., <?php echo $begP ?>, 1854. <a target="_blank" href='<?php  $this->request->getUri() ?>'><?php echo $this->request->getUri() ?></a>.</div>

<?php print zoterocomp($nachname, $prof_category, $specification, $profession, $addr_no, $addr_old, $addr_new, $begP);?>
</div>

</div>

 

