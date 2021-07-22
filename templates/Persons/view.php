<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */

require(__DIR__.'/../functions/img_zotero.php');
require (__DIR__.'/../functions/varspersons.php');


	$name = '';
	if(!empty($person->title)){
		$name.=h($person->title).' ';
	}
	if(!empty($person->name_predicate)){
		$name.=h($person->name_predicate).' ';
	}
	$name.=h($person->surname);
	if(!empty($person->first_name)){
		$name.=', '.h($person->first_name);
	}

	$pageRefs = [];
	foreach($person->original_references as $ref){
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

	$titles = [];
	if(!empty($person->title)){
		array_push($titles, $person->title);
	}
	if($person->de_l_institut){
		array_push($titles, 'de l\'Institut');
	}
?>
<div class="row">
    <?= $this->element('sideNav', ['mapBox' => true, 'export' => 'all'])?>
    <div class="column-responsive column-80">
        <div class="persons view content">
            <h3><?= htmlspecialchars_decode(h($name)) ?></h3>
			<?= !empty($pageRefs) ? __('Eintrag im Buch auf ').implode(' und ', $pageRefs).'.' : ''?>
            <table>
            	<tr>
            		<th><?= __('Scan der Seite') ?></th>
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
                    <th><?= __('Nachname') ?></th>
                    <td><?= h($person->name_predicate).' '.h($person->surname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Vorname') ?></th>
                    <td><?= h($person->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Geschlecht') ?></th>
                    <td><?php
						if($person->gender === 'M'){
							echo 'Männlich';
						} elseif ($person->gender === 'F'){
							echo 'Weiblich';
						} else {
							echo 'Nicht bekannt';
						} ?></td>
                </tr>
                <tr>
                    <th><?= __('Titel') ?></th>
                    <td><?= implode(', ', $titles)?></td>
                </tr>
                <tr>
                    <th><?= __('Anmerkungen wörtlich') ?></th>
                    <td><?= h($person->specification_verbatim) ?></td>
                </tr>
                <tr>
                    <th><?= __('Beruf') ?></th>
                    <td><?= h($person->profession_verbatim) ?></td>
                </tr>
                <tr>
                    <th><?= __('Berufskategorie') ?></th>
                    <td><?= $person->has('prof_category') ? $person->prof_category->name : '' ?></td>
                </tr>
				<tr>
					<th><?=__('Adresse(n)')?></th>
					<td>
					<?php if (!empty($person->addresses)) : ?>
						<?= htmlspecialchars_decode($this->element('addressList', ['addresses' => $person->addresses, 'list' => true])) ?>
					<?php endif; ?>
					</td>
				</tr>
				<?php if($person->has('ldh_rank')) : ?>
                <tr>
                    <th><?= __('Rang der Légion d\'Honneur') ?></th>
                    <td><?= $person->ldh_rank->rank ?></td>
                </tr>
				<?php endif;?>
                <tr>
                    <th><?= __('Sonstige Kategorien') ?></th>
                    <td>
						<table>
							<tr>
								<th><?= __('Stand')?></th>
								<th><?= __('Militärischer Status')?></th>
								<th><?= __('Beruflicher Status')?></th>
							</tr>
							<tr>
								<td><?=$person->social_status->status?></td>
								<td><?=$person->military_status->status?></td>
								<td><?=$person->occupation_status->status?></td>
							</tr>
						</table>
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
								<td><?=$person->bold ? __('Ja') : __('Nein');?></td>
								<td><?=$person->notable_commercant ? __('Ja') : __('Nein');?></td>
								<td><?=$person->advert ? __('Ja') : __('Nein');?></td>
							</tr>
						</table>
					</td>
                </tr>
            </table>
            <?php if (!empty($person->companies)) : ?>
            <div class="related">
                <details>
				<?= '<summary title="'.__('Klicken für Details').'"><h4>'.__('Assoziierte Unternehmen').'</h4></summary>' ?>
					<?= $this->element('companiesMultiTable', ['companies' => $person->companies])?>
				</details>
            </div>
            <?php endif; ?>
			<?php if (!empty($person->external_references)) : ?>
			<div class="related">
                <details>
					<?= '<summary title="'.__('Klicken für Details').'"><h4>'.__('Literatur- und Quellenhinweise').'</h4></summary>' ?>
					<?= $this->element('externalReferenceMultiTable', ['externalReferences' => $person->external_references])?>
				</details>
			</div><br>
			<div>
<?php endif; ?>

</div>

 <br><div class="csl-bib-body" style="line-height: 1.35; margin-left: 2em; text-indent:-2em;">
  <div class="csl-entry">Kronauge, F. «&nbsp;<?php echo $name ?>&nbsp;». In <i>Adressbuch der Deutschen in Paris für das Jahr 1854</i>, Elektronische Edition., <?php echo $begP ?>, 1854. <a target="_blank" href='<?php  $this->request->getUri() ?>'><?php echo $this->request->getUri() ?></a>.</div>

<?php print zoteroperson($name, $precision, $precision2, $military_status, $social_status,$occupation_status, $gender, $ldh, $houseno, $addr_name, $addr_new, $begP);?>
          

</div>

</div>
