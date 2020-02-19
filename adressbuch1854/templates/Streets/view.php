<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Street $street
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Streets'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="streets view content">
            <h3><?= h($street->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name Old Verbatim') ?></th>
                    <td><?= h($street->name_old_verbatim) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name Old Clean') ?></th>
                    <td><?= h($street->name_old_clean) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name New') ?></th>
                    <td><?= h($street->name_new) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($street->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Geo Long') ?></th>
                    <td><?= $this->Number->format($street->geo_long) ?></td>
                </tr>
                <tr>
                    <th><?= __('Geo Lat') ?></th>
                    <td><?= $this->Number->format($street->geo_lat) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Arrondissements') ?></h4>
                <?php if (!empty($street->arrondissements)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('No') ?></th>
                            <th><?= __('Insee Citycode') ?></th>
                            <th><?= __('Type') ?></th>
                            <th><?= __('Postcode') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($street->arrondissements as $arrondissements) : ?>
                        <tr>
                            <td><?= h($arrondissements->id) ?></td>
                            <td><?= h($arrondissements->no) ?></td>
                            <td><?= h($arrondissements->insee_citycode) ?></td>
                            <td><?= h($arrondissements->type) ?></td>
                            <td><?= h($arrondissements->postcode) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Arrondissements', 'action' => 'view', $arrondissements->id]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Addresses') ?></h4>
                <?php if (!empty($street->addresses)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Houseno') ?></th>
                            <th><?= __('Houseno Specification') ?></th>
                            <th><?= __('Geo Long') ?></th>
                            <th><?= __('Geo Lat') ?></th>
                            <th><?= __('Address Specification Verbatim') ?></th>
                            <th><?= __('Street Id') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($street->addresses as $addresses) : ?>
                        <tr>
                            <td><?= h($addresses->id) ?></td>
                            <td><?= h($addresses->houseno) ?></td>
                            <td><?= h($addresses->houseno_specification) ?></td>
                            <td><?= h($addresses->geo_long) ?></td>
                            <td><?= h($addresses->geo_lat) ?></td>
                            <td><?= h($addresses->address_specification_verbatim) ?></td>
                            <td><?= h($addresses->street_id) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Addresses', 'action' => 'view', $addresses->id]) ?>
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
