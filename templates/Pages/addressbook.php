<?php
/*
Info Page Addressbook
*/
?>

<div class="container3">
	<?= $this->Html->script('tab4.js'); ?>
	<div id="tabs2">
    <ul>
        <li onClick="selView(1, this)"><?= __('Das Adressbuch') ?></li>
        <li onClick="selView(2, this)"><?= __('Herausgeber') ?></li>
        <li onclick="selView(3, this)"><?= __('Bedeutung') ?></li>
    </ul>
</div>
<div id="tabcontent">
<div id="tab1" class="tabpanel" style="display: inline;">
<div class="row2">
    <div class="column-responsive column-80">
		<div class="content4">
			<br>
			
					<p><?= __('Das "Adressbuch der Deutschen in Paris von 1854" ist ein gedrucktes Buch, in dem selbständige Deutsche, die 1854 in Paris und den angrenzenden Vororten ansässig waren, verzeichnet sind. ') ?>
					</p>

					<p><?= __('Alphabetisch geordnet findet man in diesen frühen "Gelben Seiten« 4.772 Adressen, ganz überwiegend Handwerker - Tischler, Schreiner, Schneider, Goldschmiede und Drucker, aber auch Unternehmer, Händler und Bankiers sowie freie Berufe wie Ärzte, Schriftsteller, Architekten, Künstler und Musiker. Auch 286 Frauen sind im Adressbuch verzeichnet, vor allem aus dem Bereich Handwerk und Handel (davon 103 für Mode, Kurzwaren, Weißzeug) sowie Adelige, Lehrerinnen und Hebammen. 
					') ?></p>

				<br>
					<p><?= __('Zu den bekannten Personen im Adressbuch gehören der Dichter Heinrich Heine, der Architekt Jakob Ignaz Hittorff (u.a. Gare du Nord), der Buchhändler Klincksieck und einige Mitglieder der Familien Rothschild und Oppenheim sowie nicht-deutsche Personen wie der polnische Dichter Adam Mickiewics und der französische Komponist Jean-Madeleine Schneitzhoeffer.') ?>
					</p>
				<br>
				<div class="image2">
				<a target='_blank' href=http://adressbuch1854.dh.uni-koeln.de/scans/HD/BHVP_703983_001.jpg>
				<img src='http://adressbuch1854.dh.uni-koeln.de/scans/SD/BHVP_703983_001.jpg' style="width:180px; float: left; clear: both;" alt="Seite der Adressbuch" title="IHA zur Nutzung der Seite" /></a>
				<a target='_blank' href=http://adressbuch1854.dh.uni-koeln.de/scans/HD/BHVP_703983_19.jpg>
				<img src='http://adressbuch1854.dh.uni-koeln.de/scans/SD/BHVP_703983_19.jpg' style="width:172px;" alt="Seite der Adressbuch" title="IHA zur Nutzung der Seite" /></a>
			</div>

					<blockquote class='displayed'>
						<ul>
							<strong><?= __('Titel') ?></strong>
							 <?= __(': Adressbuch der Deutschen in Paris für das Jahr 1854')?>
						</ul>
						<ul>
							<strong><?= __('Untertitel')?></strong>
							 <?= __(': Vollständiges Adressverzeichnis aller in Paris und seinen Vorstädten wohnenden selbständigen Deutschen in alphabetischer Ordnung. Nebst Angaben der Sehenswürdigkeiten und Wohnungen der Gesandten')?>
						</ul>
						<ul>
							<strong><?= __('Herausgeber')?></strong>
							 <?= __(': F. A. Kronauge, Vorsteher des Polyglottischen Instituts')?>
						</ul>
						<ul>
							<strong><?= __('Ort und Verlag') ?></strong>
						<?= __(': Paris, Selbstverlag des Verfassers, Druck vermutlich in Karlsruhe')?>
						</ul>
						<ul>
							<strong><?= __('Jahr')?></strong>
							 : 1854 
						</ul>
						<ul>
							<strong><?= __('Preis') ?></strong>
							 <?= __(': 5 Franken oder 1 Thaler 10 Groschen')?>
						</ul>
						<ul>
							<strong><?= __('Seitenzahl')?></strong>
						: <?= __('252 (Paginierungsfehler: auf S. 144 folgt S. 161)')?>
						</ul>
						<ul>
							<strong><?= __('Format')?></strong>
							 : 8-o
						</ul>
						<ul>
							<strong><?= __('Anzahl der Adressen') ?></strong>
						 : 4772</ul>
						<ul>
							<strong><?= __('Fundorte')?></strong>
							 : Bibliothèque historique de la Ville de Paris, Bibliothèque nationale de France <?= __('(2. Auflage, Exemplar stark beschädigt), Universitäts- und Landesbibliothek Düsseldorf, British Library')?>
						</ul><br>

				</blockquote>
			

				<br>
					<p><?= __('Das Buch ist in fünf Abschnitte unterteilt: Zuerst wird eine kurze Übersicht über Sehenswürdigkeiten von Paris und Wohnungen der Gesandten gegeben. Danach sind die Adressen abgedruckt, geordnet nach Zugehörigkeit zu einem Geschäftsbereich, nach Namen und nach Straßen. Am Ende des Buchs folgt eine dreiseitige "Geschäftsliste für In- und Ausland« sowie vier Seiten "Geschäftsempfehlungen«. ') ?>
					</p>

				<br>
					<p><?= __('Im Adressbuch sind Name, teilweise Vorname (häufig abgekürzt), Beruf, Straße(n) und Hausnummer(n) einer Person bzw. eines Betriebs vermerkt. Fettgedruckte Namen weisen darauf hin, dass gleichzeitig eine Anzeige im Adressbuch geschaltet wurde. ')?>
					</p>

				<br>
					<p><?= __('Mit der Zusammenstellung der Adressen beabsichtigte der Herausgeber F. A. Kronauge, "unseren Landsleuten usw. ein Mittel darzubieten, durch welches sie sich wieder finden und sich gegenseitig bekannt machen können« (1). Dies sollte gleichermaßen für Geschäftsleute in Paris und in Deutschland wie für Reisende gelten. Auch sollten Nachteile durch die Unkenntnis der französischen Sprache ausgeglichen werden. ')?>
					</p>

				<br>
						<p><?= __('Die Aufnahme in das Adressbuch war kostenlos, nur Anzeigen mussten bezahlt werden (2). Das Buch selbst kostete 5 Francs und wurde in Paris und in Leipzig vertrieben. Es war so erfolgreich, dass bald eine zweite Auflage erschien. Eine Jahreszahl ist in der zweiten Auflage nicht vermerkt, doch wird es vermutlich ebenfalls 1854 oder kurz darauf gewesen sein, denn bis hin zu einem Paginierungsfehler sind beide Ausgaben inhaltlich identisch. Lediglich die Anzahl der Werbeseiten hat sich erhöht. ') ?>
						</p>

				<br>
						<p><?= __('Die Bedeutung des Adressbuchs liegt in der großen Anzahl der Adressen. In der Volkszählung von 1851 wurden in Paris 12.245 Deutsche und 	Österreicher gezählt. Wenn beide Zahlen stimmen, so sind im Adressbuch fast 40% der deutschsprachigen Bevölkerung von Paris aus dem Jahr 1854 erfasst (3). Darüber hinaus stammt das Adressbuch aus der - was die deutsche Einwanderung betrifft - bisher wenig erforschten zweiten Hälfte des 19. Jahrhunderts und ist als umfassende nominative Quelle ein Ausgangspunkt für weitere Forschungen.')?>
						</p>
						<p><?= __('Bei manchen Namen steht ein in eckigen Klammern hinzugefügtes [NC], das für „Notable commerçant« steht, also für diejenigen Kaufleute, die die Mitglieder der Handelsgerichte wählten. Manche Namen sind mit einem Stern versehen: Diese Person war Chevalier der Légion d’honneur. Dies waren übliche Abkürzungen in den „Bottin du commerce«, den damaligen Adressbüchern für Handel und Wirtschaft. Weitere Abkürzungen für die Ränge der Ehrenlegion sind:') ?>
							<br>
							<ul>O. * Officier</ul>
							<ul>C. * Commandeur</ul> 
							<ul>G. * Grand-Officier</ul>
							<ul>G. C. * Grand-Croix</ul>
							<br>
							<?= __('In der Datenbank LEONORE der Archives Nationales können die Namen für eine weitere Recherche nachgeschlagen werden: ') ?> <a target='blank' href='https://www.leonore.archives-nationales.culture.gouv.fr/ui/.'>https://www.leonore.archives-nationales.culture.gouv.fr/ui/</a></p>
						<p><?= __('Laut WorldCat sind vier Ausgaben des Adressbuchs in Bibliotheken zugänglich: in Paris in der Bibliothèque nationale de France und in der Bibliothèque historique de la ville de Paris, in der British Library in London sowie in Bonn in der Bibliothek der Friedrich Ebert Stiftung. Als Grundlage für diese Datenbank und die Scans diente das Exemplar der Bibliothèque historique de la ville de Paris (Signatur 703983).') ?></p>
						<br>
											<em>
						<ul>(1) <?= __('Vorrede zur zweiten Auflage')?>.</ul> 
						<ul>(2 <?= __('Insertionsgebühren für ein Jahr: die gespaltene Zeile 1 Franken; die viertel Seite 25 Franken; die halbe Seite 50 Franken; die ganze Seite 100 Franken.') ?></ul>
						<ul>
							<div class="csl-bib-body" style="line-height: 1.35; margin-left: 2em; text-indent:-2em;">
							<div class="csl-entry">(3) König, Mareike. «&nbsp;Georg Kibler, Möbelbauer, Rue de Charonne 39: Adreßbuch der Deutschen in Paris für das Jahr 1854&nbsp;». <i>Francia 30/3 (2003)</i>, 2004, 143‑56.</div>
								<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Ajournal&amp;rft.genre=article&amp;rft.atitle=Georg%20Kibler%2C%20M%C3%B6belbauer%2C%20Rue%20de%20Charonne%2039%3A%20Adre%C3%9Fbuch%20der%20Deutschen%20in%20Paris%20f%C3%BCr%20das%20Jahr%201854&amp;rft.jtitle=Francia%2030%2F3%20(2003)&amp;rft.aufirst=Mareike&amp;rft.aulast=K%C3%B6nig&amp;rft.au=Mareike%20K%C3%B6nig&amp;rft.date=2004&amp;rft.pages=143-156&amp;rft.spage=143&amp;rft.epage=156&amp;rft.language=fr">
									
								</span>
							</div> 

						</ul>
					</em>
					</div>
				</div>
			</div>
		</div>
		<div id="tab2" class="tabpanel" style="display:none">
			<div class="row2">
				<div class="column-responsive column-80">
					<div class="content5">
						<br>
						<p><?= __('F. A. Kronauge gründete 1852 ein Spracheninstitut, das „Institut polyglotte«, bei dem man Unterricht in „allen Sprachen« nehmen und Übersetzungen anfertigen lassen konnte. Das Institut lag im 2. Arrondissement, 57 rue de Richelieu, und hatte zu einem späteren Zeitpunkt die Adresse 222 ancienne rue de Rivoli. Über dieses Institut lief die Veröffentlichung des Adressbuchs und die darin enthaltenen Anzeigen. Weitere Informationen über den Herausgeber konnten nicht gefunden werden. Vermutlich handelt es sich um ein Pseudonym. ') ?></p>
					</div>
				</div>
			</div>
		</div>
		<div id="tab3" class="tabpanel" style="display: none;">
			<div class="row2">
				<div class="column-responsive column-80">
					<div class="content5">
						<br>
						<p><?= __('Die Bedeutung des Adressbuchs liegt in der großen Anzahl der darin enthaltenen Adressen. In der Volkszählung von 1851 wurden in Paris 12.245 Deutsche und Österreicher gezählt. Wenn beide Zahlen stimmen, so sind im Adressbuch fast 40% der deutschsprachigen Bevölkerung von Paris aus dem Jahr 1854 erfasst (3). Darüber hinaus stammt das Adressbuch aus einer - was die deutsche Einwanderung betrifft - bisher wenig erforschten Periode und stellt als umfassende nominative Quelle einen Ausgangspunkt für weitere Forschungen dar. ') ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>