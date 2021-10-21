<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Person[]|\Cake\Collection\CollectionInterface $persons
 */
?>
<div class="row">
    <?= $this->element('sideNav', ['mapBox' => false, 'export' => 'all'])?>
    <div class="column-responsive column-80">
		<div class="content">
			<h3><?= __('Personen') ?></h3>
			<?= $this->element('personsMultiTable', ['count' => true, 'persons' => $persons, 'offset' => (($this->Paginator->current('Persons')-1) * $this->Paginator->param('perPage'))])?>
			<div class="paginator">
				<ul class="pagination">
					<?= $this->Paginator->first('<< ' . __('Anfang')) ?>
					<?= $this->Paginator->prev('< ' . __('zurück')) ?>
					<?= $this->Paginator->numbers() ?>
					<?= $this->Paginator->next(__('vor') . ' >') ?>
					<?= $this->Paginator->last(__('Ende') . ' >>') ?>
				</ul>
				<p><?= $this->Paginator->counter(__('Seite {{page}} von {{pages}}, zeige {{current}} Person(en) von {{count}}')) ?></p>
			</div>
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

                <h4>Herunterladen dateien von das Adressbuch</h4>

                <p class="lorem">Zu das Dateien von der projekt ALPAGE, ihr könnt sie hier herunterladen </p>
                <a href="download/Export_arrondissements.zip"><button type="button">Export_arrondissement.zip</button></a>

                <p class="lorem">Zu das Dateien von Paris OpenData, ihr könnt sie hier herunterladen </p>
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
    </div>
</div>
