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
		
		$type = $this->request->getQuery('type');
		if($type == 'simp'){
			$this->simpleSearch($queryP, $queryC);
		} elseif($type == 'det'){
			$this->detailedSearch($queryP, $queryC);
		} else{
			$queryP->where(['persons.id =' => 0]);
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
	
	private function detailedSearch(&$queryP, &$queryC){
				
		$name = $this->request->getQuery('name');
		$prof = $this->request->getQuery('prof');
		$street = $this->request->getQuery('street');
		$profCat = $this->request->getQuery('prof_cat');
		$arrOld = $this->request->getQuery('arr_old');
		$arrNew = $this->request->getQuery('arr_new');
		$bold = $this->request->getQuery('bold');
		$advert = $this->request->getQuery('advert');
		
		$firstName = $this->request->getQuery('first_name');
		$dlI = $this->request->getQuery('institut');
		$ldh = $this->request->getQuery('ldh_rank');
		$gender = $this->request->getQuery('gender');
		$soc = $this->request->getQuery('soc_stat');
		$mil = $this->request->getQuery('mil_stat');
		$occup = $this->request->getQuery('occ_stat');
		
		
		// TODO: Nur für Company checken und stattdessen das Form nicht abschicken, wenn _alle_ Felder leer sind?
		// Dabei könnte ein Problem sein, dass das hidden Input field "type" ja nie empty ist.
		// Checking if all values for company or person are empty and empty the entire query object
		if(empty($name.$street.$prof.$profCat.$arrOld.$arrNew) && $bold === null && $advert === null){
			$queryC->where(['companies.id' => 0]);
			if(empty($firstName.$soc.$mil.$occup.$ldh) && $dlI === null && $gender === null){
				$queryP->where(['persons.id' => 0]);
				return;
			}
		}
		
		// Query for $name (surname of persons/name of companies)
		if(!empty($name)){
			$queryP->where(['persons.surname LIKE' => '%'.$name.'%']);
			$queryC->where(['companies.name LIKE' => '%'.$name.'%']);
		}
		
		// Query for $prof (given profession of a person or company)
		if(!empty($prof)){
			$queryP->where(['persons.profession_verbatim LIKE' => '%'.$prof.'%']);
			$queryC->where(['companies.profession_verbatim LIKE' => '%'.$prof.'%']);
		}
		
		// Query for $street (a person or company, that has at least one associated Street that contains the given String as old or new street name)
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
		
		//Query for $profCat (profession category of person/company)
		if(!empty($profCat)){
			$queryP->where(['persons.prof_category_id' => $profCat]);
			$queryC->where(['companies.prof_category_id' => $profCat]);
		}
		
		//Query for $arrOld/$arrNew (a person or company, that has at least one associated street that lies at least partially within the given arrondissement)
		$arrs = [];
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
		
		// Query for $bold (the fact, that a person's/company's name is written bold in the address book)
		if($bold == '1'){
			$queryP->where(['bold' => true]);
			$queryC->where(['bold' => true]);
		} elseif ($bold == '0'){
			$queryP->where(['bold' => false]);	
			$queryC->where(['bold' => true]);			
		}
		
		// Query for $advert (the fact, that a person's/company's name appears in the entreprise list of the address book)
		if($advert == '1'){
			$queryP->where(['advert' => true]);
			$queryC->where(['advert' => true]);
		} elseif ($advert == '0'){
			$queryP->where(['advert' => false]);
			$queryC->where(['advert' => false]);				
		}
		
		/* Queries that only concern persons */
		
		//Query for $firstName (first name of person)
		if(!empty($firstName)){
			$queryP->where(['persons.first_name LIKE' => '%'.$firstName.'%']);
		}
		
		// Query for $dlI (the fact, that a person is marked "de l'Institut" in the address book)
		if($dlI == '1'){
			$queryP->where(['de_l_institut' => true]);
		} elseif($dlI == '0') {
			$queryP->where(['de_l_institut' => false]);
		}
		
		//Query for $ldh (a person's rank in the Légion d'Honneur)
		if(!empty($ldh)){
			$queryP->where(['ldh_rank_id' => $ldh]);
		}

		//Query for $gender (a person's gender)
		if(!empty($gender)){
			$queryP->where([strtolower('gender') => $gender]);
		}
		
		// Query for $soc (the social status of a person)
		if(!empty($soc)){
			$queryP->where(['persons.social_status_id' => $soc]);
		}
		
		// Query for $mil (the military status of a person)
		if(!empty($mil)){
			$queryP->where(['persons.military_status_id' => $mil]);
		}
		
		// Query for $occup (the occupational status of a person)
		if(!empty($occup)){
			$queryP->where(['persons.occupation_status_id' => $occup]);
		}
		
	}
	
	private function simpleSearch(&$queryP, &$queryC){
		
		$text = $this->request->getQuery('text');
		
		// check if the submitted form input is contains word characters. If not, empty the query objects
		if(preg_match('/\w/', $text) === 0){
			$queryP->where(['persons.id' => 0]);
			$queryC->where(['companies.id' => 0]);
			return;
		}
		
		// split the text around any number of commas, points and whitespaces
		$tokens = preg_split('/[,.\s]+/', $text);
			
		// Problem: wird union() eingesetzt, hängt sich die Funktion auf, so dass das timeout greift und eine Fehlerseite des Browsers erscheint
		// (der Fehler wird nicht von Cake abgefangen). Dies passiert sowohl, wenn die union() nach der verfeinerten Query als auch davor aufgerufen
		// wird (siehe auskommentierten Code vor der Schleife. Nimmt man ihn aus dem Kommentar heraus und setzt dafür die Loop-Schleife als Kommentar,
		// geschieht dasselbe Problem). Nutzt man die Methode append() der Klasse Collections, dann funktioniert zwar die Vereinigung der beiden
		// Query-Objekte, doch man erhält ein Objekt vom Typ Collections und nicht Query zurück.
		// --> Entweder das union-Problem lösen oder statt zwei verschiedener Abfragen matching() und where() mit einem großen OR-Ausdruck zusammenbringen.
		
		/*$queryPAddr = $queryP->where(['persons.surname' => 'Müller']);
		$queryPAttr = $queryP->where(['persons.surname' => 'Weidmann']);;
		// different columns??? kann durch matching kommen, aber ist hier ja noch nicht der Fall...
		$queryP=$queryPAttr->union($queryPAddr);
		$queryP->where(['persons.surname' => 'Weidmann']);*/
		
		// for each token
		foreach($tokens as $token){
			
			// assign the original query object to two distinct objects that will be refined seperately
			$queryPAddr = $queryP;
			$queryPAttr = $queryP;
			
			// search for persons that contain the current token in either one of the specified data base fields
			$queryPAttr->where(['OR' => [['persons.surname' => $token],
				['persons.first_name' => $token],
				['persons.title' => $token],
				['persons.profession_verbatim' => $token],
				['persons.specification_verbatim' => $token],
				['persons.name_predicate' => $token]]]);
			$queryPAddr->innerJoinWith('Addresses.Streets', function($q) use ($token){
					return $q->where(['OR' => [
					['Streets.name_old_clean LIKE' => '%'.$token.'%'],
					['Streets.name_new LIKE' => '%'.$token.'%'],
					['Addresses.address_specification_verbatim LIKE' => '%'.$token.'%']
					]]);
				});			
				
			// make the union of all perons that contain the $token in any of the previously queried fields so that the
			// the next loop will only affect this resulting subset of the original query object
			$queryPAttr->union($queryPAddr);
			
			// repeat the procedure for the companies query object
			$queryCAddr = $queryC;
			$queryCAttr = $queryC;
		
			$queryCAttr->where(['OR' => [
				['companies.name' => $token],
				['companies.profession_verbatim' => $token],
				['companies.specification_verbatim' => $token]
			]]);
			$queryCAddr->matching('Addresses.Streets', function($q) use ($token){
				return $q->where(['OR' => [
				['Addresses.Streets.name_old_clean LIKE' => '%'.$token.'%'],
				['Addresses.Streets.name_new LIKE' => '%'.$token.'%'],
				['Addresses.address_specification_verbatim LIKE' => '%'.$token.'%']
				]]);
			});	

			$queryC = $queryCAttr->union($queryCAddr);
		}
		
	}
	
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
