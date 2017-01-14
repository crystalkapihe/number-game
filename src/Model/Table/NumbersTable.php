<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Numbers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Guesses
 *
 * @method \App\Model\Entity\Number get($primaryKey, $options = [])
 * @method \App\Model\Entity\Number newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Number[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Number|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Number patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Number[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Number findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NumbersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('numbers');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Guesses', [
            'foreignKey' => 'number_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('value')
            ->requirePresence('value', 'create')
            ->notEmpty('value');

        $validator
            ->numeric('points_awarded')
            ->allowEmpty('points_awarded');

        $validator
            ->requirePresence('difficulty', 'create')
            ->notEmpty('difficulty');

        $validator
            ->integer('guess_count')
            ->requirePresence('guess_count', 'create')
            ->notEmpty('guess_count');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
