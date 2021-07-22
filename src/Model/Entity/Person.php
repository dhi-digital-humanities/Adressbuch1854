<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Person Entity
 *
 * @property int $id
 * @property string|null $surname
 * @property string|null $first_name
 * @property string|null $gender
 * @property string|null $title
 * @property string|null $name_predicate
 * @property string|null $specification_verbatim
 * @property string|null $profession_verbatim
 * @property bool|null $de_l_institut
 * @property bool|null $notable_commercant
 * @property bool|null $bold
 * @property bool|null $advert
 * @property int|null $ldh_rank_id
 * @property int|null $military_status_id
 * @property int|null $social_status_id
 * @property int|null $occupation_status_id
 * @property int|null $prof_category_id
 *
 * @property \App\Model\Entity\LdhRank $ldh_rank
 * @property \App\Model\Entity\MilitaryStatus $military_status
 * @property \App\Model\Entity\SocialStatus $social_status
 * @property \App\Model\Entity\OccupationStatus $occupation_status
 * @property \App\Model\Entity\ProfCategory $prof_category
 * @property \App\Model\Entity\Address[] $addresses
 * @property \App\Model\Entity\Company[] $companies
 * @property \App\Model\Entity\ExternalReference[] $external_references
 * @property \App\Model\Entity\OriginalReference[] $original_references
 */
class Person extends Entity
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
        'surname' => true,
        'first_name' => true,
        'gender' => true,
        'title' => true,
        'name_predicate' => true,
        'specification_verbatim' => true,
        'profession_verbatim' => true,
        'de_l_institut' => true,
        'notable_commercant' => true,
        'bold' => true,
        'advert' => true,
        'ldh_rank_id' => true,
        'military_status_id' => true,
        'social_status_id' => true,
        'occupation_status_id' => true,
        'prof_category_id' => true,
        'ldh_rank' => true,
        'military_status' => true,
        'social_status' => true,
        'occupation_status' => true,
        'prof_category' => true,
        'addresses' => true,
        'companies' => true,
        'external_references' => true,
        'original_references' => true,
        //'bhvp300' => true,
    ];
}
