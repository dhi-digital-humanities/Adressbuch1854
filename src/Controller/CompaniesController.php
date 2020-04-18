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
            'contain' => ['ProfCategories', 'Addresses.Streets'],
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
		$format = $this->request->getQuery('format');
		if($format != null){
			$format = strtolower($format);
		}
		
		$formats = [
          'xml' => 'Xml',
          'json' => 'Json'
        ];
		
		
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
			'Persons.Addresses.Streets']
        ]);

        $this->set(compact('company'));
		
		if(isset($formats[$format])){
					
			$this->viewBuilder()->setClassName($formats[$format]);
			$this->viewBuilder()->setOption('serialize', ['company']);
			//serialize-Fehler beim XML
			
			// Problem: wird durch diese Controller-Action eine View gerendert, so wird der Json bzw. XML-Code korrekt angezeigt.
			// Nutzt man die Browser-eigene Download-Funktion in Firefox, so erhält man die passende Datei dazu als Download.
			// Wird keine view gerendert sondern withDownload() genutzt, so ist die als response gesendete Datei leer.
			// Set Force Download
			/*if($this->request->getQuery('down') === 'true'){						
				$this->response = $this->response->withCharset('UTF-8');
				return $this->response->withDownload('Adressbuch1854_C-'.$id.'.'.$format);
			}*/
			
		}
    }
}
