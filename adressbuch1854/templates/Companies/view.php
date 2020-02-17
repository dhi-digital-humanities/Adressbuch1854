<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Companies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="companies view content">
            <h3><?= h($company->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($company->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prof Category') ?></th>
                    <td><?= $company->has('prof_category') ? $this->Html->link($company->prof_category->name, ['controller' => 'ProfCategories', 'action' => 'view', $company->prof_category->id]) : '' ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Addresses') ?></h4>
                <?php if (!empty($company->addresses)) : ?>
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
                        <?php foreach ($company->addresses as $addresses) : ?>
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
                <h4><?= __('Related External References') ?></h4>
                <?php if (!empty($company->external_references)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Reference') ?></th>
                            <th><?= __('Short Description') ?></th>
                            <th><?= __('Link') ?></th>
                            <th><?= __('Reference Type') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($company->external_references as $externalReferences) : ?>
                        <tr>
                            <td><?= h($externalReferences->reference) ?></td>
                            <td><?= h($externalReferences->short_description) ?></td>
                            <td><?= h($externalReferences->link) ?></td>
                            <td><?= h($externalReferences->reference_type->type) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ExternalReferences', 'action' => 'view', $externalReferences->id]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Original References') ?></h4>
                <?php if (!empty($company->original_references)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Scan No') ?></th>
                            <th><?= __('Begin Page No') ?></th>
                            <th><?= __('End Page No') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($company->original_references as $originalReferences) : ?>
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
            <div class="related">
                <h4><?= __('Related Persons') ?></h4>
                <?php if (!empty($company->persons)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Surname') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Gender') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Name Predicate') ?></th>
                            <th><?= __('Specification Verbatim') ?></th>
                            <th><?= __('Profession Verbatim') ?></th>
                            <th><?= __('De L Institut') ?></th>
                            <th><?= __('Notable Commercant') ?></th>
                            <th><?= __('Bold') ?></th>
                            <th><?= __('Advert') ?></th>
                            <th><?= __('Ldh Rank') ?></th>
                            <th><?= __('Military Status') ?></th>
                            <th><?= __('Social Status') ?></th>
                            <th><?= __('Occupation Status') ?></th>
                            <th><?= __('Prof Category') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($company->persons as $persons) : ?>
                        <tr>
                            <td><?= h($persons->id) ?></td>
                            <td><?= h($persons->surname) ?></td>
                            <td><?= h($persons->first_name) ?></td>
                            <td><?= h($persons->gender) ?></td>
                            <td><?= h($persons->title) ?></td>
                            <td><?= h($persons->name_predicate) ?></td>
                            <td><?= h($persons->specification_verbatim) ?></td>
                            <td><?= h($persons->profession_verbatim) ?></td>
                            <td><?= h($persons->de_l_institut) ?></td>
                            <td><?= h($persons->notable_commercant) ?></td>
                            <td><?= h($persons->bold) ?></td>
                            <td><?= h($persons->advert) ?></td>
                            <td><?= h($persons->ldh_rank->rank) ?></td>
                            <td><?= h($persons->military_status->status) ?></td>
                            <td><?= h($persons->social_status->status) ?></td>
                            <td><?= h($persons->occupation_status->status) ?></td>
                            <td><?= h($persons->prof_category->name) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Persons', 'action' => 'view', $persons->id]) ?>
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
