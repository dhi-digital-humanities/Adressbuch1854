<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Arrondissement[]|\Cake\Collection\CollectionInterface $arrondissements
 */
?>
<div class="arrondissements index content">
    <?= $this->Html->link(__('New Arrondissement'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Arrondissements') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('no') ?></th>
                    <th><?= $this->Paginator->sort('insee_citycode') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('postcode') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arrondissements as $arrondissement): ?>
                <tr>
                    <td><?= $this->Number->format($arrondissement->id) ?></td>
                    <td><?= $this->Number->format($arrondissement->no) ?></td>
                    <td><?= $this->Number->format($arrondissement->insee_citycode) ?></td>
                    <td><?= h($arrondissement->type) ?></td>
                    <td><?= $this->Number->format($arrondissement->postcode) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $arrondissement->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $arrondissement->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $arrondissement->id], ['confirm' => __('Are you sure you want to delete # {0}?', $arrondissement->id)]) ?>
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
