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
		
		//$format = $this->request->getQuery('format');
		$name = $this->request->getQuery('name');
		//$ldh = $this->request->getQuery('ldh');
		
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
		
		if(!empty($name)){
			$queryP->where(['surname LIKE' => '%'.$name.'%']);
			$queryC->where(['companies.name LIKE' => '%'.$name.'%']);
		}
		
		/*if(!empty($ldh)){
			$query->where(['grade_legion_d_honneur' => $ldh]);
		}*/
		
		$persons = $this->paginate($queryP);
		$companies = $this->paginate($queryC);
        $this->set(compact('persons', 'companies'));
		
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
