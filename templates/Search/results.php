<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person[]|\Cake\Collection\CollectionInterface $persons
 */

 use Cake\Routing\Router;

 echo $this->Html->css(['export', 'map']);

 $uri = $this->request->getRequestTarget();

//  The params must be given to the pagination links, since it will otherwise not
// show the desired results, but the results for an empty query string.
// The current pagination param for Person or Company must be unset first
// to avoid overriding.
 $params = $this->request->getQueryParams();
 
 unset($params['Companies']);

?>
<h2><?= __('Ergebnisse') ?></h2>
<?php echo __('Für Ihre Suchanfrage wurden ').
	
	$this->Paginator->counter(__('{{count}} Unternehmen'), ['model' => 'Companies']).
	' gefunden:';
?>
<div class="row">
    <?= $this->element('sideNav', ['mapBox' => false, 'export' => 'all'])?>
    <div class="column-responsive column-80">
		<?php if (!($persons->isEmpty() && $companies->isEmpty())) : ?>
		<div class="content">
		<?php if (!$persons->isEmpty()) : ?>
			<h3><?= __('Personen') ?></h3>
			<?= $this->element('personsMultiTable', ['persons' => $persons, 'count' => true, 'offset' => (($this->Paginator->current('Persons')-1) * $this->Paginator->param('perPage', 'Persons'))])?>
			<div class="paginator">
				<ul class="pagination">
					<?= $this->Paginator->first('<< ' . __('Anfang'), ['model' => 'Persons', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->prev('< ' . __('zurück'), ['model' => 'Persons', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->numbers(['model' => 'Persons', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->next(__('vor') . ' >', ['model' => 'Persons', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->last(__('Ende') . ' >>', ['model' => 'Persons', 'url' => ['?' => $params]]) ?>
				</ul>
				<p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Person(en) von {{count}}'), ['model' => 'Persons']) ?></p>
			</div>
		<?php endif; ?>
		<?php if (!$companies->isEmpty()) : ?>
			<h3><?= __('Unternehmen') ?></h3>
			<?= $this->element('companiesMultiTable', ['companies' => $companies, 'count' => true, 'offset' => (($this->Paginator->current('Companies')-1) * $this->Paginator->param('perPage', 'Companies'))])?>
			<div class="paginator">
				<ul class="pagination">
					<?= $this->Paginator->first('<< ' . __('Anfang'), ['model' => 'Companies', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->prev('< ' . __('zurück'), ['model' => 'Companies', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->numbers(['model' => 'Companies', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->next(__('vor') . ' >', ['model' => 'Companies', 'url' => ['?' => $params]]) ?>
					<?= $this->Paginator->last(__('Ende') . ' >>', ['model' => 'Companies', 'url' => ['?' => $params]]) ?>
				</ul>
				<p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Unternehmen von {{count}}'), ['model' => 'Companies']) ?></p>
			</div>
		<?php endif; ?>
		</div>
<div class="bigMap">

		<div id="mapBox" class="sidebar-map" onload="initializeMap()">
			<div id="sidebar" class="sidebar collapsed">
        <!-- Nav tabs -->
        <div class="sidebar-tabs">
            <ul role="tablist">
                <li><a href="#home" role="tab"><i class="fa fa-bars"></i></a></li>
                <li><a href="#profile" role="tab"><i class="fa fa-user"></i></a></li>
                <li class="fa fa-message"><a href="#messages" role="tab"><i class="fa fa-envelope"></i></a></li>
                <li><a href="https://github.com/dhi-digital-humanities/Adressbuch1854" role="tab" target="_blank"><i class="fa fa-github"></i></a></li>
            </ul>

        </div>

        <!-- Tab panes -->
        <div class="sidebar-content">
            <div class="sidebar-pane" id="home">
                <h1 class="sidebar-header">
                    Kartographie mit Leaflet
                    <span class="sidebar-close"><i class="fa fa-caret-left"></i></span>
                </h1><br>

                <h4>Download der Daten des Adressbuchs</h4>

                <p class="lorem">Download der Dateien des Projekts ALPAGE</p>
                <a href="download/Export_arrondissements.zip"><button type="button">Export_arrondissement.zip</button></a>

                <p class="lorem">Download der Daten von Paris OpenData</p>
                <a href="download/arrondissements.zip"><button type="button">arrondissement.zip</button></a>

            </div>

            <div class="sidebar-pane" id="profile" style="line-height: 1.5;">
                <h1 class="sidebar-header"><span class="sidebar-close"><i class="fa fa-caret-left"></i></span>Beschreibung</h1><br>

                <p class="lorem">Die Karte wurde mit Leaflet und mehreren Erweiterungen realisiert.<br>
                   
              Die Karte  darin besthet um Menschen zu sehen, Menschen zu finden und Menschen zu suchen.</p>
            </div>

            <div class="sidebar-pane" id="messages">
                <h1 class="sidebar-header">Mail<span class="sidebar-close"><i class="fa fa-caret-left"></i></span></h1><br>
                   <h4> Projektleintung :</h4>
                        <a href="mailto:mailto:MKoenig@dhi-paris.fr">Mareike Koenig</a><em>, Stellvertretende Direktorin, Abteinlungsleiterin Digital Humanities, (DHIP)</em><br>
                        <a href="mailto:JurgenHermes">Jurgen Hermes</a><em>, Sprachile Informationsverabeitung, Institut füu Digital Humanities, Universität zu Köln, (IDH)</em><br>
                    <br><h4>Projektmitarbeiter*innen :</h4>
                        <a href="mailto:GKembellec@dhi-paris.fr">Dr Gerald Kembellec</a><em> (DHIP, Entwicklung)</em><br>
                        <a href="mailto:AlinaOstrowski">Alina Ostrowski</a><em> (IDH, Entwicklung)</em><br>
                        <a href="mailto:evan.vrvll@gmail.com">Evan Virevialle</a><em> (DHIP, Entwicklung)</em><br>
                        <a href="mailto:Denis Demmer">Denis Demmer</a><em> (IDH, Administration)</em>
            </div>

        </div>
    </div>
				<?= $this->Html->script('address-map.js'); ?>
				
			</div>
		</div>
		<?php else: ?>
		<div class="content">
			<h3><?= __('Keine Ergebnisse') ?></h3>
			<p> <?= $this->Html->link(__('Zurück zur Suche'), ['action' => 'query'])?> </p>
		</div>
		<?php endif;?>

	</div>
</div>
