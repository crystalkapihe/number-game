<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Number Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $created
 * @property int $value
 * @property int $user_id
 * @property float $points_awarded
 * @property string $difficulty
 * @property int $guess_count
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Guess[] $guesses
 */
class Number extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
