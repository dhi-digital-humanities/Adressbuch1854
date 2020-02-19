<?php
declare(strict_types=1);

namespace App\Controller;

class SearchController extends AppController
{
	
	public function initialize() : void {
		parent::initialize();
		$this->loadModel('Persons');
		$this->loadModel('Companies');
	}
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    /*
	TODO: redirect auf search() oder löschen?
	public function index()
    {
        $this->paginate = [
            'contain' => ['LdhRanks', 'MilitaryStatuses', 'SocialStatuses', 'OccupationStatuses', 'ProfCategories'],
        ];
        $persons = $this->paginate($this->Persons);

        $this->set(compact('persons'));
    }*/
	
	public function results(){
		
        $queryP = $this->Persons->find()->contain([
			'LdhRanks',
			'MilitaryStatuses',
			'SocialStatuses',
			'OccupationStatuses',
			'Addresses.Streets.Arrondissements',
			'ExternalReferences.ReferenceTypes',
			'OriginalReferences',
			'ProfCategories',
			'Companies'
		]);
		
		$queryC = $this->Companies->find()->contain([
			'Persons',
			'Addresses.Streets.Arrondissements',
			'ExternalReferences.ReferenceTypes',
			'OriginalReferences',
			'ProfCategories'
		]);
		
		// Check
		$name = $this->request->getQuery('name');
		if(!empty($name)){
			$queryP->where(['persons.surname LIKE' => '%'.$name.'%']);
			$queryC->where(['companies.name LIKE' => '%'.$name.'%']);
		}
		
		//Check
		$prof = $this->request->getQuery('prof');
		if(!empty($prof)){
			$queryP->where(['persons.profession_verbatim LIKE' => '%'.$prof.'%']);
			$queryC->where(['companies.profession_verbatim LIKE' => '%'.$prof.'%']);
		}
		
		// Problem: Wie kann ich ein Objekt finden mit der Bedingung, das mindestens eines seiner vielen zugeordneten Objekte einen bestimmten String enthält?
		// Lösung: Cake matching() statt where() benutzen
		// Check
		$street = $this->request->getQuery('street');
		if(!empty($street)){
			$queryP->matching('Addresses.Streets', function($q) use ($street){
					return $q->where(['OR' => [
					['Streets.name_old_clean LIKE' => '%'.$street.'%'],
					['Streets.name_new LIKE' => '%'.$street.'%']
					]]);
				}
			);
			$queryC->matching('Addresses.Streets', function($q) use ($street){
					return $q->where(['OR' => [
					['Streets.name_old_clean LIKE' => '%'.$street.'%'],
					['Streets.name_new LIKE' => '%'.$street.'%']
					]]);
				}
			);
		}
		
		//Check
		$profCat = $this->request->getQuery('prof_cat');
		if(!empty($profCat)){
			$queryP->where(['persons.prof_category_id' => $profCat]);
			$queryC->where(['companies.prof_category_id' => $profCat]);
		}
		
		//Check
		$arrs = [];
		$arrOld = $this->request->getQuery('arr_old');
		$arrNew = $this->request->getQuery('arr_new');
		if(!empty($arrOld)){
			array_push($arrs, intval($arrOld));
		}
		if(!empty($arrNew)){
			array_push($arrs, intval($arrNew));
		}
		foreach($arrs as $arr){
			$queryP->matching('Addresses.Streets.Arrondissements', function ($q) use ($arr){
				return $q->where(['Arrondissements.id' => $arr]);
			});
			$queryC->matching('Addresses.Streets.Arrondissements', function ($q) use ($arr){
				return $q->where(['Arrondissements.id' => $arr]);
			});
		}
		
		//Check
		$firstName = $this->request->getQuery('first_name');
		if(!empty($firstName)){
			$queryP->where(['persons.first_name LIKE' => '%'.$firstName.'%']);
		}
		
		//Check
		$ldh = $this->request->getQuery('ldh_rank');
		if(!empty($ldh)){
			$queryP->where(['ldh_rank_id' => $ldh]);
		}
		
		/*Problem: Cake FormHelper baut bei Radio Buttons einen preset Value in das die Boxen umgebende Checkbox-Element ein, das immer mitgesendet wird
		* daher gibt es in der Query-URL "institut=", wenn keine Box ausgewählt ist, und "institut=&institut=1", wenn ein Wert ausgewählt ist.
		* -> nicht schön, beeinträchtigt die Funktion aber nicht
		*/
		//Check
		$gender = $this->request->getQuery('gender');
		if(!empty($gender)){
			$queryP->where([strtolower('gender') => $gender]);
		}
		
		/* 
		* Achtung bei Booleans: Eine !empty-Überprüfung ist erstens nicht nötig (da in der if/elseif-Schleife abgeprüft wird, ob der Parameter einen bestimmten
		* Wert hat, und zweitens leider nicht möglich, da der String '0' als empty erkannt wird.
		*/
		//Check
		$bold = $this->request->getQuery('bold');
		if($bold == '1'){
			$queryP->where(['bold' => true]);
		} elseif ($bold == '0'){
			$queryP->where(['bold' => false]);				
		}
		
		// Check
		$advert = $this->request->getQuery('advert');
		if($advert == '1'){
			$queryP->where(['advert' => true]);
		} elseif ($advert == '0'){
			$queryP->where(['advert' => false]);				
		}
		
		//Check
		$dlI = $this->request->getQuery('institut');
		if($dlI == '1'){
			$queryP->where(['de_l_institut' => true]);
		} elseif($dlI == '0') {
			$queryP->where(['de_l_institut' => false]);
		}
		
		//Check
		$soc = $this->request->getQuery('soc_stat');
		if(!empty($soc)){
			$queryP->where(['persons.social_status_id' => $soc]);
		}
		
		//Check
		$mil = $this->request->getQuery('mil_stat');
		if(!empty($mil)){
			$queryP->where(['persons.military_status_id' => $mil]);
		}
		
		//Check
		$occup = $this->request->getQuery('occ_stat');
		if(!empty($occup)){
			$queryP->where(['persons.occupation_status_id' => $occup]);
		}
		
		//Check
		if(empty($name) && empty($street) && empty($prof) && empty($profCat) && count($arrs)==0){
			$queryC->where(['companies.id =' => 0]);
		}
		
		$queryP->order(['persons.surname' => 'ASC']);
		$queryC->order(['companies.name' => 'ASC']);
		
		$persons = $this->paginate($queryP);
		$companies = $this->paginate($queryC);
        $this->set(compact('persons', 'companies'));
		
		//$format = $this->request->getQuery('format');
		/*if(!empty($format)){
			$this->viewBuilder()->setClassName(ucfirst($format));
			$this->set('_serialize', ['persons']);
		}*/
	}
	
	/*
	private function simpleSearch(&$queryP, &$queryC){
		$text = $this->request->getQuery('text');
		$tokens = explode(' ', $text);
		
		//addresses.streets.name und addresses.address_specification_verbatim absuchen
		foreach($tokens as $token){
			
			$queryP->where(['OR' => [['persons.surname' => $token],
				['persons.first_name' => $token],
				['persons.profession_verbatim' => $token],
				['persons.specification_verbatim' => $token],
				['persons.name_predicate' => $token]]]);
		}
	}
	*/
	
	public function query(){
			$ranks = $this->Persons->LdhRanks->find();
			$socialStatuses = $this->Persons->SocialStatuses->find();
			$militaryStatuses = $this->Persons->MilitaryStatuses->find();
			$occupationStatuses = $this->Persons->OccupationStatuses->find();
			$arrondissements = $this->Persons->Addresses->Streets->Arrondissements->find();
			$categories = $this->Persons->ProfCategories->find();
			$persons = $this->Persons->find();
			
			$this->set(compact('categories', 'persons','ranks', 'socialStatuses', 'militaryStatuses', 'occupationStatuses', 'arrondissements'));
	}


}
