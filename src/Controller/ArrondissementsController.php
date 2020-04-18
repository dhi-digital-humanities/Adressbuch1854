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
		$format = $this->request->getQuery('format');
		if($format != null){
			$format = strtolower($format);
		}
		
		$formats = [
          'xml' => 'Xml',
          'json' => 'Json'
        ];
		
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
		
		
		if(isset($formats[$format])){
					
			$this->viewBuilder()->setClassName($formats[$format]);
			$this->viewBuilder()->setOption('serialize', ['arrondissement', 'companies', 'persons']);
			//serialize-Fehler beim XML
			
			// Problem: wird durch diese Controller-Action eine View gerendert, so wird der Json bzw. XML-Code korrekt angezeigt.
			// Nutzt man die Browser-eigene Download-Funktion in Firefox, so erhält man die passende Datei dazu als Download.
			// Wird keine view gerendert sondern withDownload() genutzt, so ist die als response gesendete Datei leer.
			// Set Force Download
			/*if($this->request->getQuery('down') === 'true'){						
				$this->response = $this->response->withCharset('UTF-8');
				return $this->response->withDownload('Adressbuch1854_P-'.$id.'.'.$format);
			}*/
			
		}
    }
}
