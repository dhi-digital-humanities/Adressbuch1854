<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 */
 
	$pageRefs = [];
	foreach($company->original_references as $ref){
		$pageRef = 'S. ';
		$begP = $ref->begin_page_no;
		$endP = $ref->end_page_no;
		if($endP != null){
			$pageRef .= $begP.'-'.$endP;
		} else {
			$pageRef .= $begP;
		}
		if($begP >= 9 && $begP <=18){
			$pageRef .= ' '.__('(Geschäftsliste)');
		}
		array_push($pageRefs, $pageRef);
	}
?>
<div class="row">
    <?= $this->element('sideNav', ['mapBox' => true])?>
    <div class="column-responsive column-80">
        <div class="companies view content">
            <h3><?= h($company->name) ?></h3>
			<?=	!empty($pageRefs) ? __('Eintrag im Buch auf ').implode(' und ', $pageRefs).'.' : '' ?>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($company->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Anmerkungen wörtlich') ?></th>
                    <td><?= h($company->specification_verbatim) ?></td>
                </tr>
                <tr>
                    <th><?= __('Beruf') ?></th>
                    <td><?= h($company->profession_verbatim) ?></td>
                </tr>
                <tr>
                    <th><?= __('Berufskategorie') ?></th>
                    <td><?= $company->has('prof_category') ? $company->prof_category->name : '' ?></td>
                </tr>
				<tr>
					<th><?=__('Adresse(n)')?></th>
					<td>
					<?php if (!empty($company->addresses)) : ?>
					<?= $this->element('addressList', ['addresses' => $company->addresses, 'list' => true]) ?>
					<?php endif; ?>
					</td>
				</tr>
				<tr>
                    <th><?= __('Sonstige Merkmale') ?></th>
                    <td>
						<table>
							<tr>
								<th><?= __('Vorab-Abonnent (fett)')?></th>
								<th><?= __('Notable Commerçant [NC]')?></th>
								<th><?= __('In Geschäftsliste')?></th>
							</tr>
							<tr>
								<td><?=$company->bold ? __('Ja') : __('Nein');?></td>
								<td><?=$company->notable_commercant ? __('Ja') : __('Nein');?></td>
								<td><?=$company->advert ? __('Ja') : __('Nein');?></td>
							</tr>
						</table>
					</td>
                </tr>
            </table>
            <?php if (!empty($company->persons)) : ?>
			<div class="related">
                <h4><?= __('Assoziierte Personen') ?></h4>							
				<?= $this->element('personsMultiTable', ['persons' => $company->persons])?>
            </div>
            <?php endif; ?>
			<?php if (!empty($company->external_references)) : ?>
            <div class="related">
                <h4><?= __('Literatur- und Quellenhinweise') ?></h4>
                <div class="table-responsive">
                    <table>
                        <tr>
							<th><?= __('Nr') ?></th>
                            <th><?= __('Literatur/Quelle') ?></th>
                            <th><?= __('Kurzbeschreibung') ?></th>
                        </tr>
                        <?php
							$countNo = 1;
							foreach ($company->external_references as $externalReference) : ?>
                        <tr>
							<td><?= $this->Number->format($countNo) ?></td>
                            <td><?php 
								if(!empty($externalReference->link)){
									echo $this->Html->link(h($externalReference->reference), $externalReference->link, ['target' => 'new']);
								} else {
									echo h($externalReference->reference);
								}
								?></td>
                            <td><?= h($externalReference->short_description) ?></td>
                        </tr>
                        <?php
							$countNo++;
							endforeach; ?>
                    </table>
                </div>
            </div>
            <?php endif; ?>
			<div class='citation'>
				Zitierhinweis: <?php echo 'Hier wird ein passender Zitierhinweis erscheinen.'?>
			</div>
        </div>
    </div>
</div>
