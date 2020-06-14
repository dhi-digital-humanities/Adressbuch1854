<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        // $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    public function beforeRender($event)
    {
        $format = $this->request->getQuery('export');
        if(empty($format)) return;

        $format = strtolower($format);

        $formats = [
            'xml' => 'Xml',
            'json' => 'Json'
        ];

        if(isset($formats[$format])){
            $filename = 'Adressbuch1854_';
            $viewVars = $this->viewBuilder()->getVars();

            if ($this->request->getParam('action') === 'view') {
                switch($this->name){
                    case 'Persons':
                        $filename .= 'P-'.$viewVars['person']->id;
                    break;

                    case 'Companies':
                        $filename .= 'C-'.$viewVars['company']->id;
                    break;

                    case 'Streets':
                        $filename .= 'S-'.$viewVars['street']->id;
                    break;

                    case 'Arrondissements':
                        $filename .= 'A-'.$viewVars['arrondissement']->id;
                    break;

                    case 'Search':
                        $filename .= 'search_results';
                    break;
                }
            } else {
                $filename .= 'overview';
            }

            $filename .= '.'.$format;

            $this->viewBuilder()->setClassName($formats[$format]);
            $this->viewBuilder()->setOption('serialize', true);
            $this->viewBuilder()->setOption('rootNode', 'results');

            $this->response = $this->response
                ->withCharset('UTF-8')
                ->withHeader('Content-Disposition', 'attachment; filename="'.$filename.'"');
        }
    }

    public function export()
    {
        $format = $this->request->getQuery('exportAll');
        if(empty($format)) return;

        // paths relative to webroot
        $csvFilePath = 'download/Adressbuch_1854_all.csv';
        $sqlFilePath = 'download/Adressbuch_1854_all.sql';

        $format = strtolower($this->request->getQuery('exportAll'));

        // Format to view mapping
        $formats = [
            'xml' => 'Xml',
            'json' => 'Json',
            'sql' => 'SQL',
            'csv' => 'CSV',
        ];

        // Error on unknown type
        if (!isset($formats[$format])){
            throw new NotFoundException(__('Unknown format.'));
        }

        $filename = 'Adressbuch1854_complete.'.$format;
        $pathname = '';

        switch($format){
            case 'csv':
                return $this->response = $this->response
                    ->withCharset('UTF-8')
                    ->withFile($csvFilePath, [
                        'download' => true,
                        'name' => $filename
                    ]);

            case 'sql':
                return $this->response = $this->response
                    ->withCharset('UTF-8')
                    ->withFile($sqlFilePath, [
                        'download' => true,
                        'name' => $filename
                    ]);

            default:
                $this->loadModel('Persons');
                $this->loadModel('Companies');

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

                $this->set(compact('persons', 'companies'));
                $this->viewBuilder()->setClassName($formats[$format]);
                $this->viewBuilder()->setOption('serialize', true);
                $this->viewBuilder()->setOption('rootNode', 'results');

                $this->response = $this->response
                    ->withCharset('UTF-8')
                    ->withHeader('Content-Disposition', 'attachment; filename="'.$filename.'"');
        }
    }
}
