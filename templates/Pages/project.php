<?php
/*
Info Page Project
*/
?>
<div class="container3">
	<?= $this->Html->script('tab4.js'); ?>
	<!-- on met en place les tabs pour les onglets -->
<div id="tabs2">
    <ul>
        <li onClick="selView(1, this)" style="border-bottom:2px solid #ED8B00;"><?= __('Datenbank') ?></li>
        <li onClick="selView(2, this)"><?= __('Dokumentation') ?></li>
        <li onclick="selView(3, this)"><?= __('Publikationen') ?></li>
    </ul>
</div>
<div id='tabcontent'>
<div id='tab1' class='tabpanel' style='display:inline'>
<div class="row2">
    <div class="column-responsive column-80">
		<div class="content4">
			<br>
			<p><?= __('Dies ist die zwischen 2020 und 2022 vollständig überarbeitete Fassung des "Adressbuch der Deutschen in Paris von 1854". Die erste Version der Datenbank und ihrer Website war am DHIP mit der Software Filemaker erarbeitet und 2006 online gestellt worden. ') ?></p>

			<p><?= __('Vollständiger Datensatz bei Zenodo:')?><a href="https://doi.org/10.5281/zenodo.5524880"><img src="https://zenodo.org/badge/DOI/10.5281/zenodo.5524880.svg" alt="DOI"></a></p>

			<h4><?= __('Angaben aus dem Adressbuch') ?></h4>
			<p><?= __('Die Datenbank enthält alle Angaben aus dem "Adressbuch der Deutschen in Paris" von 1854: Name, Vorname (fehlt häufig oder ist abgekürzt), Straße, Hausnummer und Beruf.')?></p>

			<p><?= __('Ein den Namen in eckigen Klammern hinzugefügtes [NC] steht für „Notable commerçant“, also für diejenigen Kaufleute, die die Mitglieder der Handelsgerichte wählten. Ebenso ist vermerkt, ob die Personen Mitglied des Institut de France waren, ob sie das Adressbuch vorabonniert hatten (im Buch fett gedruckt) und ob sie einen Eintrag in der Geschäftsliste hatten. Manche Namen sind mit einem Stern versehen: Diese Person war Chevalier der Légion d’honneur (1). Weitere Abkürzungen für die Ränge der Ehrenlegion sind:') ?>
			<li><?= __('* Chevalier')?></li>
			<li><?= __('O. * Officier')?></li>
			<li><?= __('C. * Commandeur')?></li>
			<li><?= __('G. * Grand-Officier')?></li>
			<li><?= __('G. C. * Grand-Croix')?></li>
			</p>
			
			
			<p><?= __('Im Adressbuch selbst sind die Kennzeichen und Abkürzungen nicht erklärt. Sie wurden jedoch üblicherweise in den "Bottin du commerce" verwendet, den damaligen Adressbüchern für Handel und Wirtschaft.') ?></p> 
			
			<h4><?= __('Hinzugefügte Angaben') ?></h4>

			<p><?= __('Folgende Angaben wurden recherchiert und der Datenbank hinzugefügt:')?>
			<li><?= __('Zur Strukturierung der Berufe der "Berufliche Status" mit den Kategorien: Adel, Arbeiter, Angestellte, Beamte, Handwerk, Handel, Künstler, Militär, Rentier, Rentner, Selbständig, Sonstiges und keine Angaben. ')?></li>
			<li><?= __('Zur Identifikation der Straßen wurden sowohl das damalige und das aktuelle Arrondissement als auch der aktuelle Name der Straße mitangegeben (2). ')?></li>
			<li><?= __('Vermerkt wurde bei den Einträgen ebenfalls, ob es sich um einen Mann, eine Frau oder um einen Betrieb handelt.')?></li>
			</p>

			<p><?= __('Die Zuweisung der Berufe zu den Kategorien war nicht immer eindeutig. Ist als Beruf z.B. "Uhren" angegeben, so kann diese Person gleichermaßen dem Handel und dem Handwerk (Produktion) zugewiesen werden. Einige Personen gehören sowohl der Kategorie Adel als auch den Kategorien Militär oder Beamte an. Ein "ehemaliger Arzt" kann zu den Selbständigen oder zu den Rentnern gerechnet werden. Diese Kategorien dienen nur einer ersten groben Orientierung. Die eigene Überprüfung im Einzelfall können sie nicht ersetzen.') ?></p>

			<p><?= __('Das gilt auch für die Zuweisung des Geschlechts: Es war nicht immer eindeutig, ob Fr. die Abkürzung für Frau oder für einen männlichen Vornamen sein sollte. Beides kam vor. Einer Person wurde dann "weiblich" zugeordnet, wenn es eindeutig war, z.B. durch die Berufsbezeichnung (Bäckerin, Lehrerin o.ä.) bzw. wenn der Beruf es nahelegt (z.B. Weißzeug). Auch hier muss eine Prüfung im Einzelfall stattfinden.')?></p>

			<p><?= __('Manche Straßen konnten nicht identifiziert werden, in manchen Fällen konnte das Arrondissement nicht klar ermittelt werden, z.B. wenn eine Straße zwei Arrondissements voneinander trennt. In diesem Fall sind alle angrenzenden Arrondissements erwähnt. Ggf. muss anhand der Hausnummer in den "Calepins de Cadastre" (periodische Häuserbestandsaufnahmen) in den Archives de Paris die Zugehörigkeit ermittelt werden. Existiert eine Straße nicht mehr, so ist dies vermerkt. Konnte der neue Name nicht ermittelt werden oder wurde sie in zu viele neue Straßen aufgeteilt und eine Zuordnung war nicht möglich, so steht ein "?".')?></p>


			<h4><?= __('Editionsgrundsätze') ?></h4>
			<p><?= __('Die Rechtschreibung der Angaben im Adressbuch wurde beim Übertrag in die Datenbank in Teilen korrigiert und vereinheitlicht. Bei jeder Person ist das Digitalisat der entsprechenden Seite aus dem Adressbuch angegeben und die Angaben können dort überprüft werden. ') ?></p> 

			<h5><?= __('Geändert wurde') ?></h5>
			<li><?= __('Die Groß- und Kleinschreibung bei Straßennamen wurde vereinheitlicht: rue, boulevard, cour etc. immer klein geschrieben, Faubourg Saint-Antoine, wenn das Viertel gemeint ist, blieb groß geschrieben.') ?></li>
			<li><?= __(' Abkürzungen in Straßennamen wurden ergänzt, z.B. Nve = Neuve.') ?></li>
			<li><?= __('Fehlte bei den Straßennamen der Zusatz "rue de" oder "place de" so wurde dieser in eckigen Klammern ergänzt hinzugefügt.') ?></li>

			<h5><?= __('Nicht geändert wurde') ?></h5>
			<li><?= __('Die alte Schreibweise der Berufe wurde beibehalten.') ?></li>
			<li><?= __('Die Verwendung von "und", "u." oder "&"  ist im Buch und damit auch in der Datenbank unheitlich. Das gilt auch für Witwe, abgekürzt mit  "Wwe.", "Wwe",  "Wtw."') ?></li>
			<li><?= __('Der Zusatz [NC] ist auch im Buch in eckige Klammer gesetzt.') ?></li>
			<li><?= __('Leere Felder bedeuten, dass keine Angabe gemacht wurden.') ?></li>

			<h4><?= __('Karten')?></h4>
			
			<p> <?= __('Für die Visualisierung der Adressen wurde ein farbiger Stadtplan von Paris aus dem Bestand des französischen Generalstabs von 1820-1866 verwendet (3) und über eine aktuelle Karte und die heutigen Daten gelegt. ') ?></p>

			<h4><?= __('Erste Version der Datenbank') ?></h4>

			<p><?= __('An der 2006 veröffentlichten ersten Version der Datenbank haben neben der Projektleiterin Dr. Mareike König folgende Personen mitgewirkt: Gaël Cheptou (Wissenschaftliche Mitarbeit, Datenerfassung), Gaëtan Langhade und Sebastian Hamel (Technische Mitarbeit). Das Projekt wurde damals unterstützt durch die Gerda Henkel Stiftung (Düsseldorf) und die Gesellschaft der Freunde des DHIP.') ?></p>
			<br>
				
				<em>
					<p><?= __('(1) In der Datenbank LEONORE der Archives Nationales können die Namen der mit der Légion d’honneur ausgezeichneten Personen für eine weitere Recherche nachgeschlagen werden: ') ?><a target='blank' href='https://www.leonore.archives-nationales.culture.gouv.fr/ui/'>https://www.leonore.archives-nationales.culture.gouv.fr/ui/</a></p>
				</em>
				<em>
					<p><?=__('(2) Hillairet, Jacques, Dictionnaire historique des rues de Paris Paris, 1963.')?></p>
				</em>
				<em>
					<p><?= __('(3) Géoportail, carte de l’état-major (1820-1866), ') ?><a target='blank' href='https://www.geoportail.gouv.fr/donnees/carte-de-letat-major-1820-1866'>https://www.geoportail.gouv.fr/donnees/carte-de-letat-major-1820-1866</a></p>
				</em>
				  <br>
				  <hr>
			</div>
		</div>
	</div>
</div>

<div id='tab2' class='tabpanel' style='display:none'>
	<div class="row2">
		<div class="column-responsive column-80">
		<div class="content4">
			<br>
			<p><?= __('Diese Dokumentation erklärt die Funktionsweise und den Aufbau der Datenbank und ihrer Website.') ?></p>
			<h4><?= __('Die neue Datenbank') ?></h4>
			<p><?= __('In einem ersten Schritt wurden die Daten bearbeitet, um eine breitere Nutzung zu ermöglichen. Die von Hand erfassten Daten wurden bereinigt und strukturiert, um sie mit Norm- und Metadaten anreichern zu können. Ein Ziel war, die zuvor unter Copyright gestellten Daten unter einer freien Lizenz zugänglich zu machen und damit den guten Praktiken des Umgangs mit Forschungsdaten zu entsprechen. ')?></p>


			<p><?= __('Eine Herausforderung bei der Strukturierung war die Berücksichtigung der Pariser Stadtgeschichte des 19. Jahrhundert, gab es doch zwischen 1854 und heute zahlreiche Veränderungen. So fand 1860 eine Erweiterung der Stadt um die anliegenden Viertel statt und die Anzahl der Arrondissements wurde von zwölf auf 20 Arrondissements erhöht und eine neue Zählung eingeführt. Einige der Straßen, die im Adressbuch aufgeführt sind, haben ihren Namen geändert oder sind verschwunden im Zuge der großen Stadtumbauten unter Präfekt Hausmann in den 1850/60er Jahren. Folglich musste die Modellierung der Daten so ausfallen, dass sie den historischen Veränderungen gerecht wird, während zugleich eine effiziente Navigation in der neuen Weboberfläche und insbesondere der interaktiven Karte ermöglicht werden sollte. Das Datenmodell wurde mit der Software Mocodo erstellt, ein Online-Tool für die Konzeption relationaler Datenbanken. Die Datenbank wurde mit MySQL programmiert und wird mit phpMyAdmin verwaltet. Sie enthält insgesamt 21 Tabellen, darunter die Datentabellen und die Assoziationstabellen. ')?></p>
			<h4><?= __('Die Extraktion und Bereinigung von Daten') ?></h4>
			<p><?= __('Das Bereinigen und Anreichern der Daten wurde mit der Open-Source-Software OpenRefine durchgeführt, die zugleich den Export in zahlreiche Formate ermöglicht, darunter SQL, was beim Einfügen von Daten in die Datenbank sehr nützlich war. Die ursprünglichen Daten wurden als CSV-Datei mit UTF-8 aus FileMaker extrahiert, um sie anschließend ohne proprietäre Software weiterverarbeiten zu können. Der UTF-8-Standard ermöglicht die Erkennung aller in der CSV-Datei enthaltenen Sonderzeichen und ist auch mit anderen Standards wie dem ASCII-Standard rückwärtskompatibel. Die Daten wurden mithilfe von regulären Ausdrücken der Sprache GREL bereinigt. Schließlich wurden die Straßennamen mit Wikidata angereichert. ')?></p>
			<h4><?= __('Die Karte') ?></h4>
			<p><?= __('Die Karte wurde mit der Open-Source-Software Leaflet erstellt. Diese ermöglicht es, eine interaktive Karte zu entwickeln und die im Adressbuch aufgeführten Personen zugleich auf einer historischen und modernen Karte zu lokalisieren. Mit dem Plugin Opacity-Controls können historische und moderne Karten übereinandergelegt werden und zeigen so die Veränderungen an. Die Daten werden von mehreren Vektordateien dargestellt wie den alten (vor 1860) und aktuellen Arrondissements sowie den Stadtvierteln von Paris, sie sind mit dem Plugin Leaflet-Shapefile implementiert.')?></p>
			<p><?= __('Die Daten zu den Straßen und den alten Arrondissements stammen aus dem ALPAGE-Projekt des LAMOP der Universität Paris 1 Panthéon Sorbonne. Die Daten zu den neuen Arrondissements stammen aus Paris OpenData. Die historische Karte stammt aus dem Katalog von Géoportail. Es handelt sich um eine Karte des französischen Generalstabs aus der Zeit zwischen 1820 und 1866. Die Marker auf der Karte für die einzelnen Adressen geben nicht die exakte Hausnummer an, da dies eine aufwändige Recherche nach der Haunummerierung von 1854 erfordert hätte. Stattdessen zeigen sie auf die Straßenmitte.') ?></p>
			<h4><?= __('Die Website') ?></h4>
			<p><?= __('Die Website ist mit der Open-Source-Software CakePHP programmiert') ?></p>
			
			<h4><?= __('Software')?></h4>
<table>
<tr>
		<td>
			Cake PHP, (4x). Windows, PHP, <a target="blank" href="https://cakephp.org/">https://cakephp.org/</a>
		</td>
	</tr>
	<tr>
		<td>
			Github, <a target="blank" href="https://github.com/dhi-digital-humanities/Adressbuch1854">https://github.com/DH-Cologne/Adressbuch1854</a>
		</td>
	</tr>
	<tr>
		<td>
			Leaflet, <a target='blank' href='https://leafletjs.com'>https://leafletjs.com</a>
		</td>
	</tr>
	<tr>
		<td>
			Leaflet-Shapefile, <a target='blank' href='https://github.com/calvinmetcalf/leaflet.shapefile'>https://github.com/calvinmetcalf/leaflet.shapefile</a>
		</td>
	</tr>
	<tr>
	</tr>

<td>
	Opacity-Controls, <a target='blank' href='https://github.com/lizardtechblog/Leaflet.OpacityControls'>https://github.com/lizardtechblog/Leaflet.OpacityControls</a>
</td>
</tr>
	<tr>
		<td>
			Open Refine, (3.4.1). Windows, Java, <a target="blank" href="https://openrefine.org/">https://openrefine.org/</a>
		</td>
	</tr>
	<tr>
		<td>
			phpMyAdmin, (5.1.1). Windows, PHP/Javascript, <a target="blank" href="https://www.phpmyadmin.net">https://www.phpmyadmin.net</a>
		</td>

</table>
		<h4><?= __(' Datenlieferanten') ?></h4>
<table>
<tr>
		<td>
			ALPAGE, <a target='blank' href='https://alpage.huma-num.fr/'>https://alpage.huma-num.fr/</a>
		</td>
	</tr>
	<tr>
			<td>
			Géoportail, carte de l’état-major (1820-1866), <a href="https://www.geoportail.gouv.fr/donnees/carte-de-letat-major-1820-1866">https://www.geoportail.gouv.fr/donnees/carte-de-letat-major-1820-1866</a>
			</td>
		</tr>
		<tr>
			<td>
			Paris Open Data, <a href="https://opendata.paris.fr/explore/dataset/arrondissements/map/?disjunctive.c_ar&disjunctive.c_arinsee&disjunctive.l_ar&basemap=jawg.dark&location=12,48.85889,2.34692">https://opendata.paris.fr/explore/dataset/arrondissements/</a>
			</td>
		</tr>
		<tr>
			<td>
			Wikidata, <a href="https://www.wikidata.org/wiki/Wikidata:Main_Page">https://www.wikidata.org/wiki/Wikidata:Main_Page</a>
			</td>
		</tr>
</table>
	</div>
</div>
</div>
</div>
<div id="tab3" class="tabpanel" style="display: none;">
	<div class="container">
	<div class="row2">
		<div class="content4">
		<br>	
	<table>
		<tr>
		<td>
			<div class="csl-bib-body" style="line-height: 1.35; margin-left: 2em; text-indent:-2em;">
 			<div class="csl-entry">Hillairet, Jacques: Dictionnaire historique des rues de Paris. Paris, 1963.</div>
  			<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook&amp;rft.genre=book&amp;rft.btitle=Dictionnaire%20historique%20des%20rues%20de%20Paris&amp;rft.place=Paris&amp;rft.aufirst=Jacques&amp;rft.aulast=Hillairet&amp;rft.au=Jacques%20Hillairet&amp;rft.date=1963"></span></div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="csl-bib-body" style="line-height: 1.35; margin-left: 2em; text-indent:-2em;">
  			<div class="csl-entry">König, Mareike: Adressbuch der Deutschen in Paris von 1854, in: Das 19. Jahrhundert in Perspektive (blog) <a href="https://19jhdhip.hypotheses.org/20">https://19jhdhip.hypotheses.org/20</a>.</div>
  			<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Adc&amp;rft.type=blogPost&amp;rft.title=Adressbuch%20der%20Deutschen%20in%20Paris%20von%201854&amp;rft.description=Im%20Rahmen%20des%20Projektes%20%E2%80%9EDeutsche%20Einwanderer%20in%20Paris%20im%2019.%20Jahrhundert%E2%80%9C%20wurde%20in%20den%20Jahren%202002%2F03%20das%20%E2%80%9EAdressbuch%20der%20Deutschen%20in%20Paris%E2%80%9C%20aus%20dem%20Jahr...&amp;rft.identifier=https%3A%2F%2F19jhdhip.hypotheses.org%2F20&amp;rft.aufirst=Mareike&amp;rft.aulast=K%C3%B6nig&amp;rft.au=Mareike%20K%C3%B6nig&amp;rft.language=de-DE"></span></div>
		</td>
	</tr>
	<!--<tr>
		<td>
			<div class="csl-bib-body" style="line-height: 1.35; margin-left: 2em; text-indent:-2em;">
			<div class="csl-entry">König, Mareike «&nbsp;Bibliotheken deutscher Einwanderer in Paris (1850-1914) : Benutzer und Bestände&nbsp;». Institut für Bibliotheks- und Informationswissenschaft der Humboldt-Universität zu Berlin Bis 2005: Bibliothekswissenschaft der Humboldt-Universität zu Berlin <a href="http://www.ib.hu-berlin.de/~kumlau/handreichungen/h205/">http://www.ib.hu-berlin.de/~kumlau/handreichungen/h205/</a>.</div>
  			<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Adc&amp;rft.type=webpage&amp;rft.title=Bibliotheken%20deutscher%20Einwanderer%20in%20Paris%20(1850-1914)%20%3A%20Benutzer%20und%20Best%C3%A4nde&amp;rft.description=Im%2019.%20Jahrhundert%20lebte%20eine%20gro%C3%9Fe%20Anzahl%20von%20deutschsprachigen%20Migranten%20aus%20unterschiedlichen%20sozialen%20Schichtungen%20in%20Paris.%20Eine%20Vielzahl%20von%20deutschen%20Lesekabinetten%20und%20Bibliotheken%20von%20und%20f%C3%BCr%20diese%20Einwanderer%20sorgte%20daf%C3%BCr%2C%20dass%20%C3%BCber%20die%20Literatur%20der%20Kontakt%20zum%20Heimatland%20und%20zur%20Muttersprache%20nicht%20abbrach.%20Die%20vorliegende%20Arbeit%20beschreibt%20anhand%20von%20exemplarischen%20Einzelf%C3%A4llen%20Grundz%C3%BCge%20der%20Entwicklung%20dieser%20Bibliotheken.%20Untersucht%20werden%20konfessionelle%20Bibliotheken%2C%20die%20Bibliothek%20des%20Vereins%20deutscher%20%C3%84rzte%20und%20die%20Bibliothek%20des%20Sozialdemokratischen%20Leseklubs%20Paris.%20Zweck%20und%20Aufgabe%20der%20Bibliotheken%20vor%20ihrem%20historischen%20Entstehungshintergrund%2C%20die%20Ausrichtung%20ihrer%20Best%C3%A4nde%20sowie%20ihre%20Nutzergruppen%20stehen%20im%20Mittelpunkt%20des%20Interesses.%20Diese%20Ver%C3%B6ffentlichung%20geht%20zur%C3%BCck%20auf%20eine%20Masterarbeit%20im%20postgradualen%20Fernstudiengang%20Master%20of%20Arts%20(Library%20and%20Information%20Science)%20an%20der%20Humboldt-Universit%C3%A4t%20zu%20Berlin%2C%202006.&amp;rft.identifier=http%3A%2F%2Fwww.ib.hu-berlin.de%2F~kumlau%2Fhandreichungen%2Fh205%2F&amp;rft.aufirst=Mareike&amp;rft.aulast=K%C3%B6nig&amp;rft.au=Mareike%20K%C3%B6nig&amp;rft.language=de"></span></div>
		</td>
	</tr>-->
	<tr>
		<td>
			<div class="csl-bib-body" style="line-height: 1.35; margin-left: 2em; text-indent:-2em;">
			<div class="csl-entry">König, Mareike: Deutsche Handwerker, Arbeiter und Dienstmädchen in Paris: eine vergessene Migration im 19. Jahrhundert. Pariser historische Studien, Bd. 66. München: Oldenbourg, 2003.</div>
  			<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_id=urn%3Aisbn%3A978-3-486-56761-8&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook&amp;rft.genre=book&amp;rft.btitle=Deutsche%20Handwerker%2C%20Arbeiter%20und%20Dienstm%C3%A4dchen%20in%20Paris%3A%20eine%20vergessene%20Migration%20im%2019.%20Jahrhundert&amp;rft.place=M%C3%BCnchen&amp;rft.publisher=Oldenbourg&amp;rft.series=Pariser%20historische%20Studien&amp;rft.aufirst=Mareike&amp;rft.aulast=K%C3%B6nig&amp;rft.au=Mareike%20K%C3%B6nig&amp;rft.date=2003&amp;rft.tpages=203&amp;rft.isbn=978-3-486-56761-8&amp;rft.language=ger%20fre"></span></div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="csl-bib-body" style="line-height: 1.35; margin-left: 2em; text-indent:-2em;">
  			<div class="csl-entry">König, Mareike: Georg Kibler, Möbelbauer, Rue de Charonne 39: Adreßbuch der Deutschen in Paris für das Jahr 1854, in: Francia 30/3 (2003), 2004, 143‑56.</div>
  			<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Ajournal&amp;rft.genre=article&amp;rft.atitle=Georg%20Kibler%2C%20M%C3%B6belbauer%2C%20Rue%20de%20Charonne%2039%3A%20Adre%C3%9Fbuch%20der%20Deutschen%20in%20Paris%20f%C3%BCr%20das%20Jahr%201854&amp;rft.jtitle=Francia%2030%2F3%20(2003)&amp;rft.aufirst=Mareike&amp;rft.aulast=K%C3%B6nig&amp;rft.au=Mareike%20K%C3%B6nig&amp;rft.date=2004&amp;rft.pages=143-156&amp;rft.spage=143&amp;rft.epage=156&amp;rft.language=fr"></span></div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="csl-bib-body" style="line-height: 1.35; margin-left: 2em; text-indent:-2em;">
  			<div class="csl-entry">Noizet Hélène, Boris Bove, et Laura Costa (Hg.): Paris de parcelles en pixels. Analyse géomatique de l’espace parisien médiéval et moderne. Paris: Presses universitaires de Vincennes - Comité d’histoire de la ville de Paris, 2013.</div>
  			<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook&amp;rft.genre=book&amp;rft.btitle=Paris%20de%20parcelles%20en%20pixels.%20Analyse%20g%C3%A9omatique%20de%20l'espace%20parisien%20m%C3%A9di%C3%A9val%20et%20moderne&amp;rft.place=Paris&amp;rft.publisher=Presses%20universitaires%20de%20Vincennes%20-%20Comit%C3%A9%20d'histoire%20de%20la%20ville%20de%20Paris&amp;rft.aufirst=H%C3%A9l%C3%A8ne&amp;rft.aulast=Noizet&amp;rft.au=H%C3%A9l%C3%A8ne%20Noizet&amp;rft.au=Boris%20Bove&amp;rft.au=Laura%20(dir.)%20Costa&amp;rft.date=2013"></span></div>
		</td>
	</tr>
</table>
</div>
</div>
</div>
</div>
</div>
			</div>