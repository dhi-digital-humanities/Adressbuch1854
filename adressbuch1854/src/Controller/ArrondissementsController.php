<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Arrondissements Controller
 *
 * @property \App\Model\Table\ArrondissementsTable $Arrondissements
 *
 * @method \App\Model\Entity\Arrondissement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArrondissementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $arrondissements = $this->paginate($this->Arrondissements);

        $this->set(compact('arrondissements'));
    }

    /**
     * View method
     *
     * @param string|null $id Arrondissement id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		
		$this->loadModel('Persons');
		$this->loadModel('Companies');
		
        $arrondissement = $this->Arrondissements->get($id);
		
		$persons = $this->Persons->find()->contain([
			'LdhRanks',
			'MilitaryStatuses',
			'SocialStatuses',
			'OccupationStatuses',
			'ProfCategories',
			'Addresses.Streets']);
		
		// use distinct to avoid doubled persons (some persons may have different addresses with
		// the same arrondissement and may therefore be selected mutiple times)
		$persons->leftJoinWith('Addresses.Streets.Arrondissements')
				->where(['Arrondissements.id' => $id])
				->distinct(['Persons.id']);
			
		$companies = $this->Companies->find()->contain([
			'Addresses.Streets',
			'ProfCategories']);
			
		$companies->leftJoinWith('Addresses.Streets.Arrondissements')
				->where(['Arrondissements.id' => $id])
				->distinct(['Companies.id']);

        $this->set(compact('arrondissement', 'companies', 'persons'));
    }
}
