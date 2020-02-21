<?php
declare(strict_types=1);

namespace App\Controller;
use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


class SearchController extends AppController
{
	public function initialize() : void {
		parent::initialize();
		$this->loadModel('Persons');
		$this->loadModel('Companies');
		$this->loadComponent('RequestHandler');
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
	private function getPersonAll(){
		$query = $this->Persons->find()->contain([
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
		
		return $query;
	}
	
	private function getCompanyAll(){
		$query = $this->Companies->find()->contain([
			'Persons',
			'Addresses.Streets.Arrondissements',
			'ExternalReferences.ReferenceTypes',
			'OriginalReferences',
			'ProfCategories'
		]);
		
		return $query;
	}
	
	
	public function results(){
		
        $queryP = $this->getPersonAll();
		$queryC = $this->getCompanyAll();
		
		$type = $this->request->getQuery('type');
		if($type == 'simp'){
			$this->simpleSearch($queryP, $queryC);
		} elseif($type == 'det'){
			$this->detailedSearch($queryP, $queryC);
		} else{
			$queryP->where(['persons.id' => 0]);
			$queryC->where(['companies.id' => 0]);
		}
		
		$queryP->order(['persons.surname' => 'ASC']);
		$queryC->order(['companies.name' => 'ASC']);
		
		$persons = $this->paginate($queryP);
		$companies = $this->paginate($queryC);		
		
		$params = $this->request->getQuery();
		
        $this->set(compact('persons', 'companies', 'params'));
		
		//$format = $this->request->getQuery('format');
		/*if(!empty($format)){
			$this->viewBuilder()->setClassName(ucfirst($format));
			$this->set('_serialize', ['persons']);
		}*/
	}
	
	public function export($format = ''){
			
		$sqlFilePath = '';
		$csvFilePath = '';
	
		$format = strtolower($format);

        // Format to view mapping
        $formats = [
          'xml' => 'Xml',
          'json' => 'Json',
          'sql' => 'SQL',
          'csv' => 'CSV',
        ];

        // Error on unknown type
        if (!isset($formats[$format])) {
            throw new NotFoundException(__('Unknown format.'));
        }
		
		switch($format){
			case 'sql':
				// Set Download of file
				$this->response = $this->response->withCharset('UTF-8');
				return $this->response->withFile($sqlFilePath, ['download' => true, 'name' => 'Adressbuch1854_complete.sql']);
				break;
			case 'csv':
				// Set Download of file
				$this->response = $this->response->withCharset('UTF-8');
				return $this->response->withFile($csvFilePath, ['download' => true, 'name' => 'Adressbuch1854_complete.csv']);
				break;
			case 'json':
				// No break. Will cause json to have the same code as xml.
			case 'xml':
			
				// Set Out Format View
				$this->viewBuilder()->setClassName($formats[$format]);

				// Frage: wie die Parameter der Suche übergeben?
				// Get data
				$persons = $this->getPersonAll();
				$companies = $this->getCompanyAll();
				//$persons= $this->request->getData('persons');
				//$companies= $this->request->getData('companies');
				
				/*$type = $this->request->getQuery('type');
				if($type == 'simp'){
					$this->simpleSearch($persons, $companies);
				} elseif($type == 'det'){
					$this->detailedSearch($persons, $companies);
				} else{
					$persons->where(['persons.id' => 0]);
					$companies->where(['companies.id' => 0]);
				}*/

				// Set Data View
				$this->set(compact('persons', 'companies'));
				$this->viewBuilder()->setOption('serialize', ['persons', 'companies']);

				// Problem: wird durch diese Controller-Action eine View gerendert, so wird der Json bzw. XML-Code korrekt angezeigt.
				// Nutzt man die Browser-eigene Download-Funktion in Firefox, so erhält man die passende Datei dazu als Download.
				// Wird keine view gerendert sondern withDownload() genutzt, so ist die als response gesendete Datei leer.
				// Set Force Download
				$this->response = $this->response->withCharset('UTF-8');
				return $this->response->withDownload('Adressbuch1854_search_results-' . date('YmdHis') . '.' . $format);
		}
		
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
	
	// TODO: Interessant: Die einfache Suche findet Personen, denen mindestens eine Straße mit dem Suchterm zugeordnet ist. Gibt man jedoch zwei
	// unterschiedliche Straßen an, die auch beide einer Person zugeordnet sind, so wird die Person nicht gefunden.
	
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
		
		// for each token 
		// search for persons/companies that contain the current token in either one of the specified data base fields
		foreach($tokens as $token){
			
			// TODO: Abfangen, dass Addresses = null sein kann
			$queryP
				->leftJoinWith('Addresses')
				->leftJoinWith('Addresses.Streets')
				->where([
					'OR' => [
						['Persons.surname LIKE' => '%'.$token.'%'],
						['Persons.first_name LIKE' => '%'.$token.'%'],
						['Persons.title LIKE' => '%'.$token.'%'],
						['Persons.profession_verbatim LIKE' => '%'.$token.'%'],
						['Persons.specification_verbatim LIKE' => '%'.$token.'%'],
						['Persons.name_predicate LIKE' => '%'.$token.'%'],
						['Streets.name_old_clean LIKE' => '%'.$token.'%'],
						['Streets.name_new LIKE' => '%'.$token.'%'],
						['Addresses.address_specification_verbatim LIKE' => '%'.$token.'%']
					]
				])
				->group('Persons.id');
				
			$queryC
				->leftJoinWith('Addresses')
				->leftJoinWith('Addresses.Streets')
				->where([
					'OR' => [
						['Companies.name LIKE' => '%'.$token.'%'],
						['Companies.profession_verbatim LIKE' => '%'.$token.'%'],
						['Companies.specification_verbatim LIKE' => '%'.$token.'%'],
						['Streets.name_old_clean LIKE' => '%'.$token.'%'],
						['Streets.name_new LIKE' => '%'.$token.'%'],
						['Addresses.address_specification_verbatim LIKE' => '%'.$token.'%']
					]
				])
				->group('Companies.id');
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
