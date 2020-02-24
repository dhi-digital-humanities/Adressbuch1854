<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Streets Controller
 *
 * @property \App\Model\Table\StreetsTable $Streets
 *
 * @method \App\Model\Entity\Street[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StreetsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $streets = $this->paginate($this->Streets);

        $this->set(compact('streets'));
    }

    /**
     * View method
     *
     * @param string|null $id Street id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $street = $this->Streets->get($id, [
            'contain' => [
            'Arrondissements'],
        ]);
		
		$sameStreets = $this->Streets->find()->contain([
            'Arrondissements',
			'Addresses.Persons.LdhRanks',
			'Addresses.Persons.MilitaryStatuses',
			'Addresses.Persons.SocialStatuses',
			'Addresses.Persons.OccupationStatuses',
			'Addresses.Persons.ProfCategories',
			'Addresses.Persons.Addresses.Streets',
			'Addresses.Companies.Addresses.Streets',
			'Addresses.Companies.ProfCategories'],
		);
		$sameStreets->where(['name_old_clean' => $street->name_old_clean]);

		$this->set(compact('street', 'sameStreets'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $street = $this->Streets->newEmptyEntity();
        if ($this->request->is('post')) {
            $street = $this->Streets->patchEntity($street, $this->request->getData());
            if ($this->Streets->save($street)) {
                $this->Flash->success(__('The street has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The street could not be saved. Please, try again.'));
        }
        $arrondissements = $this->Streets->Arrondissements->find('list', ['limit' => 200]);
        $this->set(compact('street', 'arrondissements'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Street id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $street = $this->Streets->get($id, [
            'contain' => ['Arrondissements'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $street = $this->Streets->patchEntity($street, $this->request->getData());
            if ($this->Streets->save($street)) {
                $this->Flash->success(__('The street has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The street could not be saved. Please, try again.'));
        }
        $arrondissements = $this->Streets->Arrondissements->find('list', ['limit' => 200]);
        $this->set(compact('street', 'arrondissements'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Street id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $street = $this->Streets->get($id);
        if ($this->Streets->delete($street)) {
            $this->Flash->success(__('The street has been deleted.'));
        } else {
            $this->Flash->error(__('The street could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
