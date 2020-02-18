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
		
		$name = $this->request->getQuery('name');
		if(!empty($name)){
			$queryP->where(['persons.surname LIKE' => '%'.$name.'%']);
			$queryC->where(['companies.name LIKE' => '%'.$name.'%']);
		}
		
		$prof = $this->request->getQuery('prof');
		if(!empty($prof)){
			$queryP->where(['persons.profession_verbatim LIKE' => '%'.$prof.'%']);
			// Zuerst Model ändern: Attribut profession_verbatim für companies einfügen!
			//$queryC->where(['companies.profession_verbatim LIKE' => '%'.$prof.'%']);
		}
		
		$street = $this->request->getQuery('street');
		if(!empty($street)){
			$queryP->where(['persons.addresses.street.name LIKE' => '%'.$street.'%']);
			$queryC->where(['companies.addresses.street.name LIKE' => '%'.$street.'%']);
		}
		
		$profCat = $this->request->getQuery('prof_cat');
		if(!empty($profCat)){
			$queryP->where(['persons.prof_cat_id =' => $profCat]);
			$queryC->where(['companies.prof_cat_id =' => $profCat]);
		}
		
		$arrs = [$this->request->getQuery('arr_new'), $this->request->getQuery('arr_old')];
		foreach($arrs as $arr){
			if(!empty($arr)){
				$queryP->where(['persons.addresses.street.arrondissements.id =' => $arr]);
				$queryC->where(['companies.addresses.street.arrondissements.id =' => $arr]);
			}
		}
		
		$firstName = $this->request->getQuery('first_name');
		if(!empty($name)){
			$queryP->where(['persons.first_name LIKE' => '%'.$firstName.'%']);
		}
		
		$ldh = $this->request->getQuery('ldh_rank');
		if(!empty($ldh)){
			$queryP->where(['ldh_rank_id' => $ldh]);
		}
		
		$gender = $this->request->getQuery('gender');
		if(!empty($gender)){
			$queryP->where([strtolower('gender') => $gender]);
		}
		
		$bold = $this->request->getQuery('bold');
		if(!empty($bold)){
			if(boolval($bold)){
				$queryP->where(['bold >' => 0]);
			} else {
				$queryP->where(['bold <' => 1]);				
			}
		}
		
		$advert = $this->request->getQuery('advert');
		if(!empty($advert)){
			if(boolval($advert)){
				$queryP->where(['advert >' => 0]);
			} else {
				$queryP->where(['advert <' => 1]);				
			}
		}
		
		$dlI = $this->request->getQuery('institut');
		if(!empty($dlI)){
			if(boolval($dlI)){
				$queryP->where(['dlI >' => 0]);
			} else {
				$queryP->where(['dlI <' => 1]);				
			}
		}
		
		$soc = $this->request->getQuery('soc_stat');
		if(!empty($soc)){
			$queryP->where(['persons.social_status_id =' => $soc]);
		}
		
		$mil = $this->request->getQuery('mil_stat');
		if(!empty($mil)){
			$queryP->where(['persons.military_status_id =' => $mil]);
		}
		
		$occup = $this->request->getQuery('occ_stat');
		if(!empty($occup)){
			$queryP->where(['persons.occupation_status_id =' => $occup]);
		}
		
		if(empty($name) && empty($street) && empty($prof) && empty($profCat) && empty($arrs)){
			$queryC->where(['companies.id =' => 0]);
		}
		
		$persons = $this->paginate($queryP);
		$companies = $this->paginate($queryC);
        $this->set(compact('persons', 'companies'));
		
		//$format = $this->request->getQuery('format');
		/*if(!empty($format)){
			$this->viewBuilder()->setClassName(ucfirst($format));
			$this->set('_serialize', ['persons']);
		}*/
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
