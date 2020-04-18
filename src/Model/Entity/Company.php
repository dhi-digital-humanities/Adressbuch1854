<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $prof_category_id
 *
 * @property \App\Model\Entity\ProfCategory $prof_category
 * @property \App\Model\Entity\Address[] $addresses
 * @property \App\Model\Entity\ExternalReference[] $external_references
 * @property \App\Model\Entity\OriginalReference[] $original_references
 * @property \App\Model\Entity\Person[] $persons
 */
class Company extends Entity
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
        'name' => true,
		'profession_verbatim' => true,
		'specification_verbatim' => true,
        'prof_category_id' => true,
        'prof_category' => true,
		'notable_commercant' => true,
        'bold' => true,
        'advert' => true,
        'addresses' => true,
        'external_references' => true,
        'original_references' => true,
        'persons' => true,
    ];
}
