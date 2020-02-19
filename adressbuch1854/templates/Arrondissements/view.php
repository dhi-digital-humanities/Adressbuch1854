<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Arrondissement $arrondissement
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Arrondissements'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="arrondissements view content">
            <h3><?= h($arrondissement->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($arrondissement->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($arrondissement->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('No') ?></th>
                    <td><?= $this->Number->format($arrondissement->no) ?></td>
                </tr>
                <tr>
                    <th><?= __('Insee Citycode') ?></th>
                    <td><?= $this->Number->format($arrondissement->insee_citycode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Postcode') ?></th>
                    <td><?= $this->Number->format($arrondissement->postcode) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Streets') ?></h4>
                <?php if (!empty($arrondissement->streets)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name Old Verbatim') ?></th>
                            <th><?= __('Name Old Clean') ?></th>
                            <th><?= __('Name New') ?></th>
                            <th><?= __('Geo Long') ?></th>
                            <th><?= __('Geo Lat') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($arrondissement->streets as $streets) : ?>
                        <tr>
                            <td><?= h($streets->id) ?></td>
                            <td><?= h($streets->name_old_verbatim) ?></td>
                            <td><?= h($streets->name_old_clean) ?></td>
                            <td><?= h($streets->name_new) ?></td>
                            <td><?= h($streets->geo_long) ?></td>
                            <td><?= h($streets->geo_lat) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Streets', 'action' => 'view', $streets->id]) ?>
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
