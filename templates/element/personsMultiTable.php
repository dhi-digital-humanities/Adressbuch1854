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
		
			
		
			<th><?= __('Name') ?></th>
			
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
			/*if(!empty($person->zusatz)){
				$name.=h($person->zusatz).' ';
			}*/
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
			/*if($person->has('social_status') && $person->social_status->status != 'Commoner'){
				array_push($cats, $person->social_status->status);
			}
			if($person->has('occupation_status') && $person->occupation_status->status != 'Active'){
				array_push($cats, $person->occupation_status->status);
			}
			if($person->has('military_status') && $person->military_status->status != 'Civil'){
				array_push($cats, $person->military_status->status);
			}*/
			
			
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
			
			
			
			<td><?= $this->Html->link(htmlspecialchars_decode($name, ENT_QUOTES), ['controller' => 'Persons', 'action' => 'view', $person->id]) ?></td>
			
			<td><?php if(!empty($person->profession->profession_verbatim)){
				echo $this->html->link($person->profession->profession_verbatim, ['controller'=>'Profession', 'action'=>'view', $person->profession->id]);
			} ?></td>
			</td>
			<td><?php
				if (!empty($person->addresses)){
					echo htmlspecialchars_decode($this->element('addressList', ['addresses' => $person->addresses, 'list' => $addrAsList]));
				} 
			?></td>
			<td class="middle-width"><?= implode(', ', $plus)?></td>
			<td class="middle-width"><?= implode(', ', $cats)?></td>

			<!-- possiblité d'enregistrer nos recherches dans un panier pour les exporter plus tard -->

			<td><a href="/pages/panier_export?action=ajout&amp;l=<?= $person->id ?>&amp;n=<?= $name ?>&amp;p=<?= $person->profession_verbatim?>&amp;u=<?= $this->request->getUri(); ?>" onclick="window.open(this.href, '', 
				'toolbar=no, location=no, directories=no, status=yes, scrollbars=yes, resizable=yes, copyhistory=no, width=800, height=350'); return false;"><img src="/webroot/scans/icon-download.png" title="<?= __('Speichern') ?>" style="width: 20px"></a>
			<td>
		</tr>
		<?php
		$countNo++;
		endforeach; ?>
	</table>
<?php ?>
</div>
