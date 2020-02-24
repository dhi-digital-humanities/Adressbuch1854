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
				<tr>
					<th><?=__('Adresse(n)')?></th>
					<td>
					<?php if (!empty($person->addresses)) : ?>
						<ul>
							<?php foreach($person->addresses as $address): ?>
							<?php
								$streetOld = h($address->street->name_old_clean);
								$streetNew = h($address->street->name_new);
								$street;
								if($streetOld === $streetNew){
									$street = $streetOld;
								} else {
									$street = $streetOld.' ('.$streetNew.')';
								}
								
								$housNo = h($address->houseno);
								if(!empty($address->houseno_specification)){
									$housNo.=' '.h($address->houseno_specification);
								}
								
								$spec = h($address->address_specification_verbatim);
													
								$lat = $address->geo_lat;
								$long = $address->geo_long;
							?>
							<li>
								<?php
									echo $this->Html->link($street, ['controller' => 'Streets', 'action' => 'view', $address->street->id]);
									
									echo ' '.$housNo;
									
									if(!empty($spec)){
										echo ', '.$spec;
									}
									
									/* Sollen die Geokoordinaten hier gezeigt werden (wenn vorhanden)? Dann diesen Code entkommentieren.
									if(!empty($long) && !empty($lat )){
										echo '<br>'.__('Geokoordinaten').': '.$lat.', '.$long.' '.__('(lat/long)');
									}*/
								?>
							</li>
							<?php endforeach; ?>
						</ul>
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
                <h4><?= __('Assoziierte Unternehmen') ?></h4>
                <div class="table-responsive">
                    <table>
                        <tr>
							<th><?= __('Name') ?></th>
							<th><?= __('Anmerkungen') ?></th>
							<th><?= __('Beruf') ?></th>
							<th><?= __('Adresse(n)') ?></th>
							<th><?= __('Sonstige Merkmale') ?></th>
							<th><?= __('Kategorien') ?></th>
                        </tr>
						<?php
						foreach ($person->companies as $company): ?>
						<?php
							$cats = [];
							if($company->has('prof_category')){
								array_push($cats, $company->prof_category->name);
							}
							
							$plus = [];
							if($company->bold){
								array_push($plus, __('Vorab-Abonnent'));
							}
							if($company->notable_commercant){
								array_push($plus, 'Notable Commerçant');
							}
							if($company->advert){
								array_push($plus, __('mit Geschäftseintrag'));
							}
						?>
						<tr>
							<td><?= $this->Html->link(h($company->name), ['controller' => 'Companies', 'action' => 'view', $company->id]) ?></td>
							<td><?= h($company->specification_verbatim) ?></td>
							<td><?= h($company->profession_verbatim) ?></td>
							<td><?php
								if (!empty($company->addresses)){
									foreach ($company->addresses as $address){
										$streetOld = h($address->street->name_old_clean);
										$streetNew = h($address->street->name_new);
										$street;
										
										if($streetOld === $streetNew){
											$street = $streetOld;
										} else {
											$street = $streetOld.' ('.$streetNew.')';
										}
										
										$housNo = h($address->houseno);
										if(!empty($address->houseno_specification)){
											$housNo.=' '.h($address->houseno_specification);
										}
										
										echo $this->Html->link($street, ['controller' => 'Streets', 'action' => 'view', $address->street->id]);
										echo ' '.$housNo.'<br>';
									}
								}
							?></td>
							<td><?= implode(', ', $plus)?></td>
							<td><?= implode(', ', $cats)?></td>
						</tr>
						<?php 
							endforeach;
						?>
                    </table>
                </div>
            </div>
            <?php endif; ?>
            <?php if (!empty($person->external_references)) : ?>
            <div class="related">
                <h4><?= __('Literatur- und Quellenhinweise') ?></h4>
                <div class="table-responsive">
                    <table>
                        <tr>
							<th><?= __('Nr') ?></th>
                            <th><?= __('Literatur/Quelle') ?></th>
                            <th><?= __('Kurzbeschreibung') ?></th>
                        </tr>
                        <?php
							$countNo = 1;
							foreach ($person->external_references as $externalReference) : ?>
                        <tr>
							<td><?= $this->Number->format($countNo) ?></td>
                            <td><?php 
								if(!empty($externalReference->link)){
									echo $this->Html->link(h($externalReference->reference), $externalReference->link, ['target' => 'new']);
								} else {
									echo h($externalReference->reference);
								}
								?></td>
                            <td><?= h($externalReference->short_description) ?></td>
                        </tr>
                        <?php
							$countNo++;
							endforeach; ?>
                    </table>
                </div>
            </div>
            <?php endif; ?>
			<div class='citation'>
				Zitierhinweis: <?php echo 'Hier wird ein passender Zitierhinweis erscheinen.'?>
			</div>
        </div>
    </div>
</div>
