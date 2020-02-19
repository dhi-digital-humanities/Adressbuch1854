<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person[]|\Cake\Collection\CollectionInterface $persons
 */
?>
<div class="persons index content">
    <?= $this->Html->link(__('New Person'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Persons') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('surname') ?></th>
                    <th><?= $this->Paginator->sort('first_name') ?></th>
                    <th><?= $this->Paginator->sort('gender') ?></th>
                    <th><?= $this->Paginator->sort('title') ?></th>
                    <th><?= $this->Paginator->sort('name_predicate') ?></th>
                    <th><?= $this->Paginator->sort('specification_verbatim') ?></th>
                    <th><?= $this->Paginator->sort('profession_verbatim') ?></th>
                    <th><?= $this->Paginator->sort('de_l_institut') ?></th>
                    <th><?= $this->Paginator->sort('notable_commercant') ?></th>
                    <th><?= $this->Paginator->sort('bold') ?></th>
                    <th><?= $this->Paginator->sort('advert') ?></th>
                    <th><?= $this->Paginator->sort('ldh_rank_id') ?></th>
                    <th><?= $this->Paginator->sort('military_status_id') ?></th>
                    <th><?= $this->Paginator->sort('social_status_id') ?></th>
                    <th><?= $this->Paginator->sort('occupation_status_id') ?></th>
                    <th><?= $this->Paginator->sort('prof_category_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($persons as $person): ?>
                <tr>
                    <td><?= $this->Number->format($person->id) ?></td>
                    <td><?= h($person->surname) ?></td>
                    <td><?= h($person->first_name) ?></td>
                    <td><?= h($person->gender) ?></td>
                    <td><?= h($person->title) ?></td>
                    <td><?= h($person->name_predicate) ?></td>
                    <td><?= h($person->specification_verbatim) ?></td>
                    <td><?= h($person->profession_verbatim) ?></td>
                    <td><?= h($person->de_l_institut) ?></td>
                    <td><?= h($person->notable_commercant) ?></td>
                    <td><?= h($person->bold) ?></td>
                    <td><?= h($person->advert) ?></td>
                    <td><?= $person->has('ldh_rank') ? $this->Html->link($person->ldh_rank->id, ['controller' => 'LdhRanks', 'action' => 'view', $person->ldh_rank->id]) : '' ?></td>
                    <td><?= $person->has('military_status') ? $this->Html->link($person->military_status->id, ['controller' => 'MilitaryStatuses', 'action' => 'view', $person->military_status->id]) : '' ?></td>
                    <td><?= $person->has('social_status') ? $this->Html->link($person->social_status->id, ['controller' => 'SocialStatuses', 'action' => 'view', $person->social_status->id]) : '' ?></td>
                    <td><?= $person->has('occupation_status') ? $this->Html->link($person->occupation_status->id, ['controller' => 'OccupationStatuses', 'action' => 'view', $person->occupation_status->id]) : '' ?></td>
                    <td><?= $person->has('prof_category') ? $this->Html->link($person->prof_category->name, ['controller' => 'ProfCategories', 'action' => 'view', $person->prof_category->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $person->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $person->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $person->id], ['confirm' => __('Are you sure you want to delete # {0}?', $person->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
<div class="companies index content">
    <?= $this->Html->link(__('New Company'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Companies') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('profession_verbatim') ?></th>
                    <th><?= $this->Paginator->sort('prof_category_id') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($companies as $company): ?>
                <tr>
                    <td><?= $this->Number->format($company->id) ?></td>
                    <td><?= h($company->name) ?></td>
					<td><?= h($company->profession_verbatim) ?></td>
                    <td><?= $company->has('prof_category') ? $this->Html->link($company->prof_category->name, ['controller' => 'ProfCategories', 'action' => 'view', $company->prof_category->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $company->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $company->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $company->id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
