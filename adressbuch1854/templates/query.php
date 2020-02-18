<?php
	// defining the options-arrays for the search form
	
	$optionsArrMod = [];
	$optionsArrOld = [];
	$optionsRank = [];
	$optionsSoc = [];
	$optionsMil = [];
	$optionsOcc = [];
	$optionsCat = [];
	
	foreach($arrondissements as $arr){
		$id = $arr->id;
		$no = $arr->no;
		$type = $arr->type;
		if($type == 'pre1860'){
			$type = __('alt');
			if($no == 1){
				array_push($optionsArrOld, [$id => $no.'ier ('.$type.')']);
			} else {
				array_push($optionsArrOld, [$id => $no.'ième ('.$type.')']);
			}
		} else {
			$type = __('modern');
			if($no == 1){
				array_push($optionsArrMod, [$id => $no.'ier ('.$type.')']);
			} else {
				array_push($optionsArrMod, [$id => $no.'ième ('.$type.')']);
			}

		}
	}
	
	foreach($ranks as $rank){
		$id = $rank->id;
		$name = $rank->rank;
		array_push($optionsRank, [$id => __($name)]);
	}
	
	foreach($socialStatuses as $socialStat){
		$id = $socialStat->id;
		$status = $socialStat->status;
		array_push($optionsSoc, [$id => __($status)]);
	}
	
	foreach($militaryStatuses as $militaryStat){
		$id = $militaryStat->id;
		$status = $militaryStat->status;
		array_push($optionsMil, [$id => __($status)]);
	}
	
	foreach($occupationStatuses as $occupationStat){
		$id = $occupationStat->id;
		$status = $occupationStat->status;
		array_push($optionsOcc, [$id => __($status)]);
	}
	
	foreach($categories as $cat){
		$id = $cat->id;
		$name = $cat->name;
		array_push($optionsCat, [$id => __($name)]);
	}
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="search form content">
            <?= $this->Form->create($persons, ['type' => 'get', 'url' => 'search']) ?>
            <!-- Für spätere Befüllung des Forms
			mit den bereits eingegebenen Suchparametern bei Sprung von search.php zu query.php:
			$this->Form->setValueSources('query'])-->
            <fieldset>
                <legend><?= __('Search for a person') ?></legend>
                <div class="form content names">
				<h5 class="heading"><?= __('Personen- oder Firmenname')?></h5>
				<?php
                    echo $this->Form->control('surname', ['label' => __('Name')]);
                    echo $this->Form->control('first_name', ['label' => __('Vorname')]);
                    
					echo $this->Form->control('company', ['label' => __('Firmenname')]);
                ?>
				</div>
				<div class="form content profession">
				<h5 class="heading"><?= __('Beruf')?></h5>
				<?php
					echo $this->Form->control('profession_verbatim', ['label' => __('Beruf')]);
					echo $this->Form->label('prof_categories.name', __('Kategorie'));
					echo $this->Form->select('prof_categories.name', $optionsCat, ['empty' => true]);
				?>
				</div>
				<div class="form content persAttributes">
				<h5 class="heading"><?= __('Persönliche Merkmale')?></h5>
				<?php
					echo $this->Form->label('ldh_ranks.ranks', __('Rang der Légion d\'Honneur'));
					echo $this->Form->select('ldh_ranks.ranks', $optionsRank, ['empty' => true]);
                    
					echo $this->Form->label('social_statuses.status', __('Sozialer Stand'));
					echo $this->Form->select('social_statuses.status', $optionsSoc, ['empty' => true]);
                    
					echo $this->Form->label('military_statuses.status', __('Militärstatus'));
					echo $this->Form->select('military_statuses.status', $optionsMil, ['empty' => true]);
                    
					echo $this->Form->label('occupation_statuses.status', __('Beruflicher Status'));
					echo $this->Form->select('occupation_statuses.status', $optionsOcc, ['empty' => true]);
				?>
				</div>
				<div class="form content address">
				<h5 class="heading"><?= __('Adresse')?></h5>
				<?php
                    echo $this->Form->control('street', ['label' => __('Straße')]);                    
					echo $this->Form->label('addresses.streets.arrondissements.no'.'.new', __('Arrondissement').' ('.__('modern').')');
					echo $this->Form->select('addresses.streets.arrondissements.no'.'.new', $optionsArrMod, ['empty' => true]);
					echo $this->Form->label('addresses.streets.arrondissements.no'.'.old', __('Arrondissement').' ('.__('alt').')');
					echo $this->Form->select('addresses.streets.arrondissements.no'.'.old', $optionsArrOld, ['empty' => true]);
                ?>
				</div>
            </fieldset>
			<?= $this->Form->button(__('Search')) ?>
            <?= $this->Form->end() ?>
			Tipp: Falls Ihre Suche nicht die gewünschten Ergebnisse liefert, versuchen Sie erneut mit weniger Eingaben zu suchen. Probieren Sie auch verschiedene
			Schreibweisen von Straßen- und Personennamen aus und suchen Sie zunächst ohne Vornamen, da diese im Buch häufig nicht vorhanden oder stark abgekürzt sind.
			<!-- Hier eine Info hin wie "Probieren Sie verschiedene Schreibweisen der Namen aus. Wenn Sie nach einer Person suchen,
			und bei Eingabe des Namens und Vornamens keine Ergebnisse erhalten, suchen Sie zunächst ohne Vornamen. Meist sind die Vornamen im
			Adressbuch nicht vorhanden / nur mit einem Buchstaben abgkürzt.-->
        </div>
    </div>
</div>
