<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 */
 
	$pageRefs = [];
	foreach($company->original_references as $ref){
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
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Companies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="companies view content">
            <h3><?= h($company->name) ?></h3>
			<?=	!empty($pageRefs) ? __('Eintrag im Buch auf ').implode(' und ', $pageRefs).'.' : '' ?>
            <table>
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
						<ul>
							<?php foreach($company->addresses as $address): ?>
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
                <h4><?= __('Assoziierte Personen') ?></h4>
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
                        <?php foreach ($company->persons as $person) : ?>
                        <?php
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
							
							$cats = [];
							if($person->has('prof_category')){
								array_push($cats, $person->prof_category->name);
							}
							if($person->has('social_status') && $person->social_status->status != 'Commoner'){
								array_push($cats, $person->social_status->status);
							}
							if($person->has('occupation_status') && $person->occupation_status->status != 'Active'){
								array_push($cats, $person->occupation_status->status);
							}
							if($person->has('military_status') && $person->military_status->status != 'Civil'){
								array_push($cats, $person->military_status->status);
							}
							
							$plus = [];
							if($person->has('ldh_rank')){
								array_push($plus, $person->ldh_rank->rank);
							}
							if($person->de_l_institut){
								array_push($plus, '(de l\'Institut)');
							}
							if($person->bold){
								array_push($plus, __('Vorab-Abonnent'));
							}
							if($person->notable_commercant){
								array_push($plus, 'Notable Commerçant');
							}
							if($person->advert){
								array_push($plus, __('mit Geschäftseintrag'));
							}
						?>
						<tr>
							<td><?= $this->Html->link($name, ['controller' => 'Persons', 'action' => 'view', $person->id]) ?></td>
							<td><?= h($person->specification_verbatim) ?></td>
							<td><?= h($person->profession_verbatim) ?></td>
							<td><?php
								if (!empty($person->addresses)){
									foreach ($person->addresses as $address){
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
										
										echo ' '.$housNo;
										
										echo '<br>';
									}
								}
							?></td>
							<td><?= implode(', ', $plus)?></td>
							<td><?= implode(', ', $cats)?></td>
						</tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
            <?php endif; ?>
			<?php if (!empty($company->external_references)) : ?>
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
							foreach ($company->external_references as $externalReference) : ?>
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
