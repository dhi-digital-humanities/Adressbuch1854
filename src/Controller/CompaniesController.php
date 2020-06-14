<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 *
 * @method \App\Model\Entity\Company[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompaniesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => [
                'ProfCategories',
                'Addresses.Streets'
            ],
        ];

        $companies = $this->paginate($this->Companies);

        $this->set(compact('companies'));
    }

    /**
     * View method
     *
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if(!$id) return $this->redirect(['action' => 'index']);

        $company = $this->Companies->get($id, [
            'contain' => [
                'ProfCategories',
                'Addresses.Streets.Arrondissements',
                'ExternalReferences.ReferenceTypes',
                'OriginalReferences',
                'Persons.ProfCategories',
                'Persons.SocialStatuses',
                'Persons.MilitaryStatuses',
                'Persons.OccupationStatuses',
                'Persons.Addresses.Streets'
            ]
        ]);

        $this->set(compact('company'));
    }
}
