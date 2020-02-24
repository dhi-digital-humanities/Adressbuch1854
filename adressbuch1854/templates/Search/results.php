<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person[]|\Cake\Collection\CollectionInterface $persons
 */
?>
<h2><?= __('Ergebnisse') ?></h2>
<?php echo __('Für Ihre Suchafrage wurden ').
	$this->Paginator->counter(__('{{count}} Person(en)'), ['model' => 'Persons']).
	' und '.
	$this->Paginator->counter(__('{{count}} Unternehmen'), ['model' => 'Companies']).
	' gefunden:';	
?>

<?php if (!$persons->isEmpty()) : ?>
<div class="persons index content">
    <h3><?= __('Personen') ?></h3>
    <div class="table-responsive">
		<!-- TODO: $this->Paginator->limitControl([10 => 10, 25 => 25, 50 => 50]) 
		-> für Ergebnisanzeige? -->
        <table>
            <thead>
                <tr>
					<!-- TODO: mit Paginator->sort() Sortierung nach Spalten ermöglichen?
						Geht vielleicht nur mit korrekten Modelnamen, nicht mit zusammengesetzten
						Dingen wie Name oder Adresse -->
                    <th><?= __('Nr') ?></th>
                    <th><?= __('Name') ?></th>
                    <th><?= __('Anmerkungen') ?></th>
                    <th><?= __('Beruf') ?></th>
					<th><?= __('Adresse(n)') ?></th>
                    <th><?= __('Sonstige Merkmale') ?></th>
                    <th><?= __('Kategorien') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
				$countNo = 1;
				foreach ($persons as $person): ?>
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
                    <td><?= $this->Number->format($countNo)?></td>
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
                <?php 
				$countNo++;
				endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Anfang')) ?>
            <?= $this->Paginator->prev('< ' . __('zurück')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('vor') . ' >') ?>
            <?= $this->Paginator->last(__('Ende') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Person(en) von {{count}}'), ['model' => 'Persons']) ?></p>
    </div>
</div>
<?php endif; ?>
<?php if (!$companies->isEmpty()) : ?>
<div class="companies index content">
    <h3><?= __('Unternehmen') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort(__('Nr')) ?></th>
                    <th><?= $this->Paginator->sort(__('Name')) ?></th>
                    <th><?= __('Anmerkungen') ?></th>
                    <th><?= $this->Paginator->sort(__('Beruf')) ?></th>
					<th><?= $this->Paginator->sort(__('Adresse(n)')) ?></th>
                    <th><?= __('Sonstige Merkmale') ?></th>
                    <th><?= __('Kategorien') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
					$countNo = 1;
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
                    <td><?= $this->Number->format($countNo) ?></td>
                    <td><?= $this->Html->link(h($company->name), ['controller' => 'Companies', 'action' => 'view', $company->id]) ?></td>
					<td><?= h($company->specification_verbatim) ?></td>
					<td><?= h($company->profession_verbatim) ?></td>
                    <td><?php if (!empty($company->addresses)):?>
						<?php foreach ($company->addresses as $address){
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
						}?>
						<?php endif; ?>
					</td>
                    <td><?= implode(', ', $plus)?></td>
                    <td><?= implode(', ', $cats)?></td>
                </tr>
                <?php 
					$countNo++;
					endforeach;
				?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('Anfang')) ?>
            <?= $this->Paginator->prev('< ' . __('zurück')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('vor') . ' >') ?>
            <?= $this->Paginator->last(__('Ende') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Unternehmen von {{count}}'), ['model' => 'Companies']) ?></p>
    </div>
</div>
<?php endif; ?>
<div class="export content">
	<h4>Ergebnisse exportieren</h4>
	<?= $this->Form->postButton('Json', ['controller' => 'Search', 'action' => 'export/json', 'data' => ['persons' => $persons, 'companies' => $companies]])?>
	<?= $this->Form->postButton('XML', ['controller' => 'Search', 'action' => 'export/xml', 'data' => ['persons' => $persons, 'companies' => $companies]])?>
	...oder...
	<h4> Gesamte Datenbank exportieren</h4>
	<?= $this->Form->postButton('SQL', ['controller' => 'Search', 'action' => 'export/sql', 'data' => ['persons' => $persons, 'companies' => $companies]])?>
	<?= $this->Form->postButton('CSV', ['controller' => 'Search', 'action' => 'export/csv', 'data' => ['persons' => $persons, 'companies' => $companies]])?>
</div>
