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
        $arrondissement = $this->Arrondissements->get($id, [
            'contain' => [
				'Streets.Addresses.Companies.ProfCategories',
				'Streets.Addresses.Persons.ProfCategories',
				'Streets.Addresses.Persons.MilitaryStatuses',
				'Streets.Addresses.Persons.OccupationStatuses',
				'Streets.Addresses.Persons.SocialStatuses',
				'Streets.Addresses.Persons.LdhRanks',
				'Streets.Addresses.Persons.Addresses.Streets',
				'Streets.Addresses.Companies.Addresses.Streets'
			],
        ]);

        $this->set('arrondissement', $arrondissement);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $arrondissement = $this->Arrondissements->newEmptyEntity();
        if ($this->request->is('post')) {
            $arrondissement = $this->Arrondissements->patchEntity($arrondissement, $this->request->getData());
            if ($this->Arrondissements->save($arrondissement)) {
                $this->Flash->success(__('The arrondissement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The arrondissement could not be saved. Please, try again.'));
        }
        $streets = $this->Arrondissements->Streets->find('list', ['limit' => 200]);
        $this->set(compact('arrondissement', 'streets'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Arrondissement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $arrondissement = $this->Arrondissements->get($id, [
            'contain' => ['Streets'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $arrondissement = $this->Arrondissements->patchEntity($arrondissement, $this->request->getData());
            if ($this->Arrondissements->save($arrondissement)) {
                $this->Flash->success(__('The arrondissement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The arrondissement could not be saved. Please, try again.'));
        }
        $streets = $this->Arrondissements->Streets->find('list', ['limit' => 200]);
        $this->set(compact('arrondissement', 'streets'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Arrondissement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $arrondissement = $this->Arrondissements->get($id);
        if ($this->Arrondissements->delete($arrondissement)) {
            $this->Flash->success(__('The arrondissement has been deleted.'));
        } else {
            $this->Flash->error(__('The arrondissement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
