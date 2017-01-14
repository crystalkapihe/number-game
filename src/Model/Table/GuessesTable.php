<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Guesses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Numbers
 *
 * @method \App\Model\Entity\Guess get($primaryKey, $options = [])
 * @method \App\Model\Entity\Guess newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Guess[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Guess|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Guess patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Guess[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Guess findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GuessesTable extends Table
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

        $this->table('guesses');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->addBehavior('CounterCache', [
            'Numbers' => ['guess_count']
        ]);

        $this->belongsTo('Numbers', [
            'foreignKey' => 'number_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['number_id'], 'Numbers'));

        return $rules;
    }
}
