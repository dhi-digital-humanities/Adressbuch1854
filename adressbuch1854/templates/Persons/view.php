<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */
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
		$pageRef = 'S. ';
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
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Persons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="persons view content">
            <h3><?= h($name) ?></h3>
			<?= __('Eintrag im Buch auf ').implode(' und ', $pageRefs).'.'?>
            <table>
                <tr>
                    <th><?= __('Nachame') ?></th>
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
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Addresses') ?></h4>
                <?php if (!empty($person->addresses)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Houseno') ?></th>
                            <th><?= __('Houseno Specification') ?></th>
                            <th><?= __('Geo Long') ?></th>
                            <th><?= __('Geo Lat') ?></th>
                            <th><?= __('Address Specification Verbatim') ?></th>
                            <th><?= __('Street') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($person->addresses as $addresses) : ?>
                        <tr>
                            <td><?= h($addresses->houseno) ?></td>
                            <td><?= h($addresses->houseno_specification) ?></td>
                            <td><?= h($addresses->geo_long) ?></td>
                            <td><?= h($addresses->geo_lat) ?></td>
                            <td><?= h($addresses->address_specification_verbatim) ?></td>
                            <td><?= h($addresses->street->name_old_verbatim) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Addresses', 'action' => 'view', $addresses->id]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Companies') ?></h4>
                <?php if (!empty($person->companies)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Name') ?></th>
							<th><?= __('Profession Verbatim') ?></th>
							<th><?= __('Specification Verbatim') ?></th>
                            <th><?= __('Prof Category') ?></th>
							<th><?= __('Notable Commercant') ?></th>
							<th><?= __('Bold') ?></th>
							<th><?= __('Advert') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($person->companies as $companies) : ?>
                        <tr>
                            <td><?= h($companies->name) ?></td>
                            <td><?= h($companies->profession_verbatim) ?></td>
							<td><?= h($companies->specification_verbatim) ?></td>
                            <td><?= h($companies->prof_category->name) ?></td>
							<td><?= $companies->notable_commercant ? __('Yes') : __('No'); ?></td>
							<td><?= $companies->bold ? __('Yes') : __('No'); ?></td>
							<td><?= $companies->advert ? __('Yes') : __('No'); ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Companies', 'action' => 'view', $companies->id]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related External References') ?></h4>
                <?php if (!empty($person->external_references)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Short Description') ?></th>
                            <th><?= __('Link') ?></th>
                            <th><?= __('Reference Type') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($person->external_references as $externalReferences) : ?>
                        <tr>
                            <td><?= h($externalReferences->reference) ?></td>
                            <td><?= h($externalReferences->short_description) ?></td>
                            <td><?= h($externalReferences->link) ?></td>
                            <td><?= h($externalReferences->reference_type->type) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ExternalReferences', 'action' => 'view', $externalReferences->id]) ?>
                            </td>
                        </tr>
						<?php if(true){
							echo 'EINE SCHLEIFE!';
						}?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Original References') ?></h4>
                <?php if (!empty($person->original_references)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Scan No') ?></th>
                            <th><?= __('Begin Page No') ?></th>
                            <th><?= __('End Page No') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($person->original_references as $originalReferences) : ?>
                        <tr>
                            <td><?= h($originalReferences->scan_no) ?></td>
                            <td><?= h($originalReferences->begin_page_no) ?></td>
                            <td><?= h($originalReferences->end_page_no) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OriginalReferences', 'action' => 'view', $originalReferences->id]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
