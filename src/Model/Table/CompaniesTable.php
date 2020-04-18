<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Companies Model
 *
 * @property \App\Model\Table\ProfCategoriesTable&\Cake\ORM\Association\BelongsTo $ProfCategories
 * @property \App\Model\Table\AddressesTable&\Cake\ORM\Association\BelongsToMany $Addresses
 * @property \App\Model\Table\ExternalReferencesTable&\Cake\ORM\Association\BelongsToMany $ExternalReferences
 * @property \App\Model\Table\OriginalReferencesTable&\Cake\ORM\Association\BelongsToMany $OriginalReferences
 * @property \App\Model\Table\PersonsTable&\Cake\ORM\Association\BelongsToMany $Persons
 *
 * @method \App\Model\Entity\Company get($primaryKey, $options = [])
 * @method \App\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company findOrCreate($search, callable $callback = null, $options = [])
 */
class CompaniesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('companies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('ProfCategories', [
            'foreignKey' => 'prof_category_id',
        ]);
        $this->belongsToMany('Addresses', [
            'foreignKey' => 'company_id',
            'targetForeignKey' => 'address_id',
            'joinTable' => 'addresses_companies',
        ]);
        $this->belongsToMany('ExternalReferences', [
            'foreignKey' => 'company_id',
            'targetForeignKey' => 'external_reference_id',
            'joinTable' => 'companies_external_references',
        ]);
        $this->belongsToMany('OriginalReferences', [
            'foreignKey' => 'company_id',
            'targetForeignKey' => 'original_reference_id',
            'joinTable' => 'companies_original_references',
        ]);
        $this->belongsToMany('Persons', [
            'foreignKey' => 'company_id',
            'targetForeignKey' => 'person_id',
            'joinTable' => 'companies_persons',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 62)
            ->allowEmptyString('name');
		
        $validator
            ->scalar('profession_verbatim')
            ->maxLength('profession_verbatim', 128)
            ->allowEmptyString('profession_verbatim');
		
        $validator
            ->scalar('specification_verbatim')
            ->maxLength('specification_verbatim', 128)
            ->allowEmptyString('specification_verbatim');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['prof_category_id'], 'ProfCategories'));

        return $rules;
    }
}
