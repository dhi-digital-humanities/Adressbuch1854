<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Profession[]|\Cake\Collection\CollectionInterface $profession
 */
$params = $this->request->getQueryParams();
$uri = $this->request->getRequestTarget();

?>
<?=$this->Html->script('tab2.js'); ?>
<div class='container'>
	<!-- mise en place des onglets pour les différentes tables -->
<div id="tabs">
    <ul>
        <li onClick="selView(1, this)" style="border-bottom:2px solid #ED8B00;"><?= __('Index') ?></li>
        <li onClick="selView(2, this)"><?= __('Exportieren') ?></li>
    </ul>
</div>
<div id='tabcontent'>
	<div id='indextab' class='tabpanel' style='display:inline'>
		<div class="row">
			<div class="column-responsive column-80">
				<div class="content">
     <h3><?= __('Berufe') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    
                    <th><?= __('Berufe Adressbuch') ?></th>
                    <th><?= __('Berufe vereinheitlicht') ?></th>
                    <th><?= __('Normierter Ansatz') ?></th>
                    <th><?= __('ind') ?></th>
                    <th><?= __('ohdab') ?></th>
                    <th><?= __('ohab_ges') ?></th>
                    
                    
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($profession as $p): ?>   
                <tr>
                    <td><?= $this->Html->link($p->profession_verbatim, ['controller'=>'Profession', 'action'=>'view', $p->id]) ?></td>
                    <td><?= h($p->profession_unified) ?></td>
                    <td><?= h($p->norm) ?></td>
                    <td><?= h($p->ind) ?></td>
                    <td><?= h($p->ohdab) ?></td>
                    <td><?= h($p->ohab_ges) ?></td>
                    
              
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
        <p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Professions von '.$this->Number->format($total, ['locale'=>'fr_FR']))) ?></p>
    </div>
</div>
</div>
                </div>
                </div>
<div id='exporttab' class='tabpanel' style='display:none'>
		<div class="row">
			<div class="content3"><br>
				<h3><?= __('Aktuelle Datensätze') ?></h3>
				<div class="column-responsive column-80" style="display:flex">
					<?= $this->Form->postButton('JSON', ['controller' => '', 'action' => $uri, '?' => array_merge($params, ['export' => 'json'])],['class'=>'button2'])?>
					<?= $this->Form->postButton('XML', ['controller' => '', 'action' => $uri, '?' => array_merge($params, ['export' => 'xml'])],['class'=>'button2'])?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>