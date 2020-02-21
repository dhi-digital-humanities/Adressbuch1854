<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person $person
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Persons'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="persons view content">
            <h3><?= h($person->title) ?></h3>
            <table>
                <tr>
                    <th><?= __('Surname') ?></th>
                    <td><?= h($person->surname) ?></td>
                </tr>
                <tr>
                    <th><?= __('First Name') ?></th>
                    <td><?= h($person->first_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gender') ?></th>
                    <td><?= h($person->gender) ?></td>
                </tr>
                <tr>
                    <th><?= __('Title') ?></th>
                    <td><?= h($person->title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name Predicate') ?></th>
                    <td><?= h($person->name_predicate) ?></td>
                </tr>
                <tr>
                    <th><?= __('Specification Verbatim') ?></th>
                    <td><?= h($person->specification_verbatim) ?></td>
                </tr>
                <tr>
                    <th><?= __('Profession Verbatim') ?></th>
                    <td><?= h($person->profession_verbatim) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ldh Rank') ?></th>
                    <td><?= $person->has('ldh_rank') ? $this->Html->link($person->ldh_rank->rank, ['controller' => 'LdhRanks', 'action' => 'view', $person->ldh_rank->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Military Status') ?></th>
                    <td><?= $person->has('military_status') ? $this->Html->link($person->military_status->status, ['controller' => 'MilitaryStatuses', 'action' => 'view', $person->military_status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Social Status') ?></th>
                    <td><?= $person->has('social_status') ? $this->Html->link($person->social_status->status, ['controller' => 'SocialStatuses', 'action' => 'view', $person->social_status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Occupation Status') ?></th>
                    <td><?= $person->has('occupation_status') ? $this->Html->link($person->occupation_status->status, ['controller' => 'OccupationStatuses', 'action' => 'view', $person->occupation_status->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Prof Category') ?></th>
                    <td><?= $person->has('prof_category') ? $this->Html->link($person->prof_category->name, ['controller' => 'ProfCategories', 'action' => 'view', $person->prof_category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('De L Institut') ?></th>
                    <td><?= $person->de_l_institut ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Notable Commercant') ?></th>
                    <td><?= $person->notable_commercant ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Bold') ?></th>
                    <td><?= $person->bold ? __('Yes') : __('No'); ?></td>
                </tr>
                <tr>
                    <th><?= __('Advert') ?></th>
                    <td><?= $person->advert ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Addresses') ?></h4>
                <?php if (!empty($person->addresses)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Houseno') ?></th>
                            <th><?= __('Houseno Specification') ?></th>
                            <th><?= __('Geo Long') ?></th>
                            <th><?= __('Geo Lat') ?></th>
                            <th><?= __('Address Specification Verbatim') ?></th>
                            <th><?= __('Street') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($person->addresses as $addresses) : ?>
                        <tr>
                            <td><?= h($addresses->houseno) ?></td>
                            <td><?= h($addresses->houseno_specification) ?></td>
                            <td><?= h($addresses->geo_long) ?></td>
                            <td><?= h($addresses->geo_lat) ?></td>
                            <td><?= h($addresses->address_specification_verbatim) ?></td>
                            <td><?= h($addresses->street->name_old_verbatim) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Addresses', 'action' => 'view', $addresses->id]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Companies') ?></h4>
                <?php if (!empty($person->companies)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Name') ?></th>
							<th><?= __('Profession Verbatim') ?></th>
							<th><?= __('Specification Verbatim') ?></th>
                            <th><?= __('Prof Category') ?></th>
							<th><?= __('Notable Commercant') ?></th>
							<th><?= __('Bold') ?></th>
							<th><?= __('Advert') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($person->companies as $companies) : ?>
                        <tr>
                            <td><?= h($companies->name) ?></td>
                            <td><?= h($companies->profession_verbatim) ?></td>
							<td><?= h($companies->specification_verbatim) ?></td>
                            <td><?= h($companies->prof_category->name) ?></td>
							<td><?= $companies->notable_commercant ? __('Yes') : __('No'); ?></td>
							<td><?= $companies->bold ? __('Yes') : __('No'); ?></td>
							<td><?= $companies->advert ? __('Yes') : __('No'); ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Companies', 'action' => 'view', $companies->id]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related External References') ?></h4>
                <?php if (!empty($person->external_references)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Short Description') ?></th>
                            <th><?= __('Link') ?></th>
                            <th><?= __('Reference Type') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($person->external_references as $externalReferences) : ?>
                        <tr>
                            <td><?= h($externalReferences->reference) ?></td>
                            <td><?= h($externalReferences->short_description) ?></td>
                            <td><?= h($externalReferences->link) ?></td>
                            <td><?= h($externalReferences->reference_type->type) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ExternalReferences', 'action' => 'view', $externalReferences->id]) ?>
                            </td>
                        </tr>
						<?php if(true){
							echo 'EINE SCHLEIFE!';
						}?>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Original References') ?></h4>
                <?php if (!empty($person->original_references)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Scan No') ?></th>
                            <th><?= __('Begin Page No') ?></th>
                            <th><?= __('End Page No') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($person->original_references as $originalReferences) : ?>
                        <tr>
                            <td><?= h($originalReferences->scan_no) ?></td>
                            <td><?= h($originalReferences->begin_page_no) ?></td>
                            <td><?= h($originalReferences->end_page_no) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'OriginalReferences', 'action' => 'view', $originalReferences->id]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
