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
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Arrondissements'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
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
                <h4><?= __('Personen in diesem Arrondissement') ?></h4>
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
                        <?php foreach ($persons as $person) : ?>
                        <?php
							if(!empty($person->title)){
							$name = '';
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
										$streetFull;
										if($streetOld === $streetNew){
											$streetFull = $streetOld;
										} else {
											$streetFull = $streetOld.' ('.$streetNew.')';
										}
										$housNo = h($address->houseno);
										if(!empty($address->houseno_specification)){
											$housNo.=' '.h($address->houseno_specification);
										}
										
										echo $this->Html->link($streetFull, ['controller' => 'Streets', 'action' => 'view', $address->street->id]);
										
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
			<?php if(!$companies->isEmpty()): ?>
            <div class="related">
                <h4><?= __('Unternehmen in diesem Arrondissement') ?></h4>
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
						foreach ($companies as $company): ?>
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
										$streetFull;
										
										if($streetOld === $streetNew){
											$streetFull = $streetOld;
										} else {
											$streetFull = $streetOld.' ('.$streetNew.')';
										}
										
										$housNo = h($address->houseno);
										if(!empty($address->houseno_specification)){
											$housNo.=' '.h($address->houseno_specification);
										}
										
										echo $this->Html->link($streetFull, ['controller' => 'Streets', 'action' => 'view', $address->street->id]);
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
        </div>
    </div>
</div>
