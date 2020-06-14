<?php
declare(strict_types=1);

namespace App\Controller;
use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;

class SearchController extends AppController
{
    public function initialize() : void
    {
		parent::initialize();

        $this->loadModel('Persons');
        $this->loadModel('Companies');
	}

    /**
     * Index method
     *
     * @return
     */
    public function index()
    {
		return $this->redirect([
			'controller' => 'Search',
			'action' => 'query'
		]);
    }

    public function query()
    {
		$arrondissements = $this->Persons->Addresses->Streets->Arrondissements->find();
		$categories = $this->Persons->ProfCategories->find();
		$militaryStatuses = $this->Persons->MilitaryStatuses->find();
		$occupationStatuses = $this->Persons->OccupationStatuses->find();
		$persons = $this->Persons->find();
		$ranks = $this->Persons->LdhRanks->find();
		$socialStatuses = $this->Persons->SocialStatuses->find();

		$this->set(compact(
			'arrondissements',
			'categories',
			'militaryStatuses',
			'occupationStatuses',
			'persons',
			'ranks',
			'socialStatuses'
		));
	}

    public function results()
    {
        $persons = $this->Persons->find()
            ->contain([
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

        $companies = $this->Companies->find()
            ->contain([
                'Persons',
                'Addresses.Streets.Arrondissements',
                'ExternalReferences.ReferenceTypes',
                'OriginalReferences',
                'ProfCategories'
            ]);

        switch ($this->request->getQuery('type')) {
            case 'simp':
                $this->simpleSearch($persons, $companies);
            break;

            case 'det':
                $this->detailedSearch($persons, $companies);
            break;
        }

		$persons->order(['persons.surname' => 'ASC']);
		$companies->order(['companies.name' => 'ASC']);

		$this->paginate($persons);
		$this->paginate($companies);

        $this->set(compact('persons', 'companies'));
	}

	// TODO: Interessant: Die einfache Suche findet Personen, denen mindestens eine Straße mit dem Suchterm zugeordnet ist. Gibt man jedoch zwei
	// unterschiedliche Straßen an, die auch beide einer Person zugeordnet sind, so wird die Person nicht gefunden.

    private function simpleSearch(&$persons, &$companies)
    {
		$text = $this->request->getQuery('text');

		// check if the submitted form input contains word characters. If not, empty the query objects
		if(preg_match('/\w/', $text) === 0) return;

		// split the text around any number of commas, points and whitespaces
		$tokens = preg_split('/[,.\s]+/', $text);

		// for each token
		// search for persons/companies that contain the current token in either one of the specified data base fields
		foreach($tokens as $token){

			// TODO: Abfangen, dass Addresses = null sein kann
			$persons
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

			$companies
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

    private function detailedSearch(&$persons, &$companies)
    {
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
            if(empty($firstName.$soc.$mil.$occup.$ldh) && $dlI === null && $gender === null) return;
            $companies->where(['companies.id' => 0]);
		}

		// Query for $name (surname of persons/name of companies)
		if(!empty($name)){
			$persons->where(['persons.surname LIKE' => '%'.$name.'%']);
			$companies->where(['companies.name LIKE' => '%'.$name.'%']);
		}

		// Query for $prof (given profession of a person or company)
		if(!empty($prof)){
			$persons->where(['persons.profession_verbatim LIKE' => '%'.$prof.'%']);
			$companies->where(['companies.profession_verbatim LIKE' => '%'.$prof.'%']);
		}

		// Query for $street (a person or company, that has at least one associated Street that contains the given String as old or new street name)
		if(!empty($street)){
			$persons->matching('Addresses.Streets', function($q) use ($street){
					return $q->where(['OR' => [
                        ['Streets.name_old_clean LIKE' => '%'.$street.'%'],
                        ['Streets.name_new LIKE' => '%'.$street.'%']
					]]);
				}
			);
			$companies->matching('Addresses.Streets', function($q) use ($street){
					return $q->where(['OR' => [
                        ['Streets.name_old_clean LIKE' => '%'.$street.'%'],
                        ['Streets.name_new LIKE' => '%'.$street.'%']
					]]);
				}
			);
		}

		//Query for $profCat (profession category of person/company)
		if(!empty($profCat)){
			$persons->where(['persons.prof_category_id' => $profCat]);
			$companies->where(['companies.prof_category_id' => $profCat]);
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
			$persons->matching('Addresses.Streets.Arrondissements', function ($q) use ($arr){
				return $q->where(['Arrondissements.id' => $arr]);
			});
			$companies->matching('Addresses.Streets.Arrondissements', function ($q) use ($arr){
				return $q->where(['Arrondissements.id' => $arr]);
			});
		}

		// Query for $bold (the fact, that a person's/company's name is written bold in the address book)
		if($bold === '1'){
			$persons->where(['bold' => true]);
			$companies->where(['bold' => true]);
		} elseif($bold === '0'){
			$persons->where(['bold' => false]);
			$companies->where(['bold' => true]);
		}

		// Query for $advert (the fact, that a person's/company's name appears in the entreprise list of the address book)
		if($advert === '1'){
			$persons->where(['advert' => true]);
			$companies->where(['advert' => true]);
		} elseif($advert === '0'){
			$persons->where(['advert' => false]);
			$companies->where(['advert' => false]);
		}

		/* Queries that only concern persons */

		//Query for $firstName (first name of person)
		if(!empty($firstName)){
			$persons->where(['persons.first_name LIKE' => '%'.$firstName.'%']);
		}

		// Query for $dlI (the fact, that a person is marked "de l'Institut" in the address book)
		if($dlI === '1'){
			$persons->where(['de_l_institut' => true]);
		} elseif($dlI === '0'){
			$persons->where(['de_l_institut' => false]);
		}

		//Query for $ldh (a person's rank in the Légion d'Honneur)
		if(!empty($ldh)){
			$persons->where(['ldh_rank_id' => $ldh]);
		}

		//Query for $gender (a person's gender)
		if(!empty($gender)){
			$persons->where([strtolower('gender') => $gender]);
		}

		// Query for $soc (the social status of a person)
		if(!empty($soc)){
			$persons->where(['persons.social_status_id' => $soc]);
		}

		// Query for $mil (the military status of a person)
		if(!empty($mil)){
			$persons->where(['persons.military_status_id' => $mil]);
		}

		// Query for $occup (the occupational status of a person)
		if(!empty($occup)){
			$persons->where(['persons.occupation_status_id' => $occup]);
		}
	}
}
