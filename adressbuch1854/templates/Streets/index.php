<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Street[]|\Cake\Collection\CollectionInterface $streets
 */
?>
<div class="streets index content">
    <?= $this->Html->link(__('New Street'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Streets') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name_old_verbatim') ?></th>
                    <th><?= $this->Paginator->sort('name_old_clean') ?></th>
                    <th><?= $this->Paginator->sort('name_new') ?></th>
                    <th><?= $this->Paginator->sort('geo_long') ?></th>
                    <th><?= $this->Paginator->sort('geo_lat') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($streets as $street): ?>
                <tr>
                    <td><?= $this->Number->format($street->id) ?></td>
                    <td><?= h($street->name_old_verbatim) ?></td>
                    <td><?= h($street->name_old_clean) ?></td>
                    <td><?= h($street->name_new) ?></td>
                    <td><?= $this->Number->format($street->geo_long) ?></td>
                    <td><?= $this->Number->format($street->geo_lat) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $street->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $street->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $street->id], ['confirm' => __('Are you sure you want to delete # {0}?', $street->id)]) ?>
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
