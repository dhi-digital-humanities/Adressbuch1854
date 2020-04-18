<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Persons Model
 *
 * @property \App\Model\Table\LdhRanksTable&\Cake\ORM\Association\BelongsTo $LdhRanks
 * @property \App\Model\Table\MilitaryStatusesTable&\Cake\ORM\Association\BelongsTo $MilitaryStatuses
 * @property \App\Model\Table\SocialStatusesTable&\Cake\ORM\Association\BelongsTo $SocialStatuses
 * @property \App\Model\Table\OccupationStatusesTable&\Cake\ORM\Association\BelongsTo $OccupationStatuses
 * @property \App\Model\Table\ProfCategoriesTable&\Cake\ORM\Association\BelongsTo $ProfCategories
 * @property \App\Model\Table\AddressesTable&\Cake\ORM\Association\BelongsToMany $Addresses
 * @property \App\Model\Table\CompaniesTable&\Cake\ORM\Association\BelongsToMany $Companies
 * @property \App\Model\Table\ExternalReferencesTable&\Cake\ORM\Association\BelongsToMany $ExternalReferences
 * @property \App\Model\Table\OriginalReferencesTable&\Cake\ORM\Association\BelongsToMany $OriginalReferences
 *
 * @method \App\Model\Entity\Person get($primaryKey, $options = [])
 * @method \App\Model\Entity\Person newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Person[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Person|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Person saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Person patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Person[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Person findOrCreate($search, callable $callback = null, $options = [])
 */
class PersonsTable extends Table
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

        $this->setTable('persons');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('LdhRanks', [
            'foreignKey' => 'ldh_rank_id',
        ]);
        $this->belongsTo('MilitaryStatuses', [
            'foreignKey' => 'military_status_id',
        ]);
        $this->belongsTo('SocialStatuses', [
            'foreignKey' => 'social_status_id',
        ]);
        $this->belongsTo('OccupationStatuses', [
            'foreignKey' => 'occupation_status_id',
        ]);
        $this->belongsTo('ProfCategories', [
            'foreignKey' => 'prof_category_id',
        ]);
        $this->belongsToMany('Addresses', [
            'foreignKey' => 'person_id',
            'targetForeignKey' => 'address_id',
            'joinTable' => 'addresses_persons',
        ]);
        $this->belongsToMany('Companies', [
            'foreignKey' => 'person_id',
            'targetForeignKey' => 'company_id',
            'joinTable' => 'companies_persons',
        ]);
        $this->belongsToMany('ExternalReferences', [
            'foreignKey' => 'person_id',
            'targetForeignKey' => 'external_reference_id',
            'joinTable' => 'external_references_persons',
        ]);
        $this->belongsToMany('OriginalReferences', [
            'foreignKey' => 'person_id',
            'targetForeignKey' => 'original_reference_id',
            'joinTable' => 'original_references_persons',
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
            ->scalar('surname')
            ->maxLength('surname', 64)
            ->allowEmptyString('surname');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 64)
            ->allowEmptyString('first_name');

        $validator
            ->scalar('gender')
            ->allowEmptyString('gender');

        $validator
            ->scalar('title')
            ->maxLength('title', 42)
            ->allowEmptyString('title');

        $validator
            ->scalar('name_predicate')
            ->maxLength('name_predicate', 42)
            ->allowEmptyString('name_predicate');

        $validator
            ->scalar('specification_verbatim')
            ->maxLength('specification_verbatim', 128)
            ->allowEmptyString('specification_verbatim');

        $validator
            ->scalar('profession_verbatim')
            ->maxLength('profession_verbatim', 128)
            ->allowEmptyString('profession_verbatim');

        $validator
            ->boolean('de_l_institut')
            ->allowEmptyString('de_l_institut');

        $validator
            ->boolean('notable_commercant')
            ->allowEmptyString('notable_commercant');

        $validator
            ->boolean('bold')
            ->allowEmptyString('bold');

        $validator
            ->boolean('advert')
            ->allowEmptyString('advert');

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
        $rules->add($rules->existsIn(['ldh_rank_id'], 'LdhRanks'));
        $rules->add($rules->existsIn(['military_status_id'], 'MilitaryStatuses'));
        $rules->add($rules->existsIn(['social_status_id'], 'SocialStatuses'));
        $rules->add($rules->existsIn(['occupation_status_id'], 'OccupationStatuses'));
        $rules->add($rules->existsIn(['prof_category_id'], 'ProfCategories'));

        return $rules;
    }
}
