<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Profession Entity
 *
 * @property int $id
 * @property string|null $profession_verbatim
 * @property string|null $profession_unified
 * @property string|null $norm
 * @property string|null $ind
 * @property string|null $ohab_ges
 * @property string|null $ohdab
 *
 * @property \App\Model\Entity\Company[] $companies
 * @property \App\Model\Entity\Person[] $persons
 */
class Profession extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'profession_verbatim' => true,
        'profession_unified' => true,
        'norm' => true,
        'ind' => true,
        'ohab_ges' => true,
        'ohdab' => true,
        'companies' => true,
        'persons' => true,
    ];
}
