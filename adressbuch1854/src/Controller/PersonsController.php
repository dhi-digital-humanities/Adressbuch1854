<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Persons Controller
 *
 * @property \App\Model\Table\PersonsTable $Persons
 *
 * @method \App\Model\Entity\Person[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PersonsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['LdhRanks', 'MilitaryStatuses', 'SocialStatuses', 'OccupationStatuses', 'ProfCategories', 'Addresses.Streets'],
        ];
        $persons = $this->paginate($this->Persons);

        $this->set(compact('persons'));
    }

    /**
     * View method
     *
     * @param string|null $id Person id.
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
		
        $person = $this->Persons->get($id, [
            'contain' => [
			'LdhRanks',
			'MilitaryStatuses',
			'SocialStatuses',
			'OccupationStatuses',
			'ProfCategories',
			'Addresses.Streets.Arrondissements',
			'Companies.ProfCategories',
			'Companies.Addresses.Streets',
			'ExternalReferences.ReferenceTypes',
			'OriginalReferences'],
        ]);
		
        $this->set(compact('person'));
		
		if(isset($formats[$format])){
					
			$this->viewBuilder()->setClassName($formats[$format]);
			$this->viewBuilder()->setOption('serialize', ['person']);
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
