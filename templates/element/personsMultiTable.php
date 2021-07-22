<?php
/*
Creates a table containing the main information about multiple persons. It uses the given array or query object with the variable name $persons.
$count: Adds a numbering if 'count' is set to true.
$offset: Number, by which the count should be increased
$addrAsList: Use a list of addresses (instead of simple breaks) if addrAsList is set to true;
*/

if(!isset($count)){
	$count=false;
}

if(!isset($offset)){
	$offset=0;
}

if(!isset($addrAsList)){
	$addrAsList=false;
}

$this->Html->css('multiTable.css');
?>
<div class="table-responsive">
	<table>
		<tr>
			<?php if($count):?>
			<th><?= __('Nr') ?></th>
			<?php endif;?>
			<th><?= __('Name') ?></th>
			<th class="small-width"><?= __('Anmerkungen') ?></th>
			<th><?= __('Beruf') ?></th>
			<th><?= __('Adresse(n)') ?></th>
			<th class="middle-width"><?= __('Sonstige Merkmale') ?></th>
			<th class="middle-width"><?= __('Kategorien') ?></th>
		</tr>
		<?php
		$countNo = 1 + $offset;
		foreach ($persons as $person) : ?>
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
			<?php if($count):?>
			<td><?= $this->Number->format($countNo)?></td>
			<?php endif;?>
			<td><?= $this->Html->link(htmlspecialchars_decode($name), ['controller' => 'Persons', 'action' => 'view', $person->id]) ?></td>
			<td class="small-width"><?= h($person->specification_verbatim) ?></td>
			<td><?= h($person->profession_verbatim) ?></td>
			<td><?php
				if (!empty($person->addresses)){
					echo htmlspecialchars_decode($this->element('addressList', ['addresses' => $person->addresses, 'list' => $addrAsList]));
				} 
			?></td>
			<td class="middle-width"><?= implode(', ', $plus)?></td>
			<td class="middle-width"><?= implode(', ', $cats)?></td>
		</tr>
		<?php
		$countNo++;
		endforeach; ?>
	</table>
</div>
