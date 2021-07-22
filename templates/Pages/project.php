<?php
/*
Info Page Project
*/
?>

<div class="row">
    <?= $this->element('sideNav', ['mapBox' => false, 'export' => 'simple'])?>
    <div class="column-responsive column-80">
		<div class="content">

			<h4>Projekt</h4>

			<p>Alle Angaben aus dem "Adressbuch der Deutschen in Paris" von 1854 wurden in eine Datenbank eingegeben. Zur Strukturierung der Berufe wurden folgende Kategorien angelegt: Adel, Arbeiter, Angestellte, Beamte, Handwerk, Handel, Künstler, Militär, Rentier, Rentner, Selbständig, Sonstiges und keine Angaben.</p>

			<br><p>Um die Straßen zu identifizieren, wurden sowohl das damalige und das aktuelle Arrondissement als auch der aktuelle Name der Straße mitangegeben (1). Vermerkt wurde ebenfalls, ob es sich um einen Mann, eine Frau oder um einen Betrieb handelt.<p>

			<br><p>Die Datenbank kann entweder integral oder nach einem oder mehreren Suchbegriffen (Name, Vorname, Beruf und Straße) durchsucht werden. Es ist auch möglich, sich Ergebnislisten nach Kategorie (z.B. alle Eigentümer) oder nach Geschlecht (z.B. alle Frauen) anzeigen zu lassen. Die Ausgabe der Ergebnisse kann als Karteikarte oder als Tabelle erfolgen. Zwischen beiden Ansichten kann gewechselt werden.</p> 

			<br><p>Auf der Seite "Stadtpläne" befinden sich Links zu Pariser Stadtplänen im Internet, zu einem aktuellen Stadtplan von Paris, zu einer Datenbank der Nomenklatur der Straßennamen und zu einer Datenbank mit Fotos aller derzeit existierenden Häuser von Paris .<p>

			<br><h4>Editionsgrundsätze</h4>
			<p>Das es in diesem Projekt darum ging, eine benutzbare Datenbank mit Adressen von Deutschen aufzubauen und nicht um eine Quellenedition im klassischen Sinne, wurde die Rechtschreibung zum Teil vereinheitlicht und Rechtschreibfehler korrigiert. </p> 

			<br><h5>Geändert</h5>
			<ul>• Die Groß- und Kleinschreibung bei Straßennamen wurde vereinheitlicht: rue, boulevard, cour etc. immer  klein geschrieben, Faubourg Saint-Antoine, wenn das Viertel gemeint ist, blieb groß geschrieben.</ul>
			<ul>•  Abkürzungen in Straßennamen wurden ergänzt, z.B. Nve = Neuve.</ul>
			<ul>• Fehlte bei den Straßennamen der Zusatz "rue de" oder "place de" so wurde dieser in eckigen Klammern ergänzt hinzugefügt.</ul>

			<br><h5>Nicht geändert</h5>
			<ul>•  Die alte Schreibweise der Berufe wurde beibehalten.</ul>
			<ul>•  Die Verwendung von "und", "u." oder "&"  ist im Buch und damit auch in der Datenbank unheitlich. Das gilt auch für Witwe, abgekürzt mit  "Wwe.", "Wwe",  "Wtw."</ul>
			<ul>•  Der Zusatz [NC] ist auch im Buch in eckige Klammer gesetzt.</ul>
			<ul>•  Leere Felder bedeuten, dass keine Angabe gemacht wurden.</ul>

			<br><p>Die Zuweisung der Berufe zu den Kategorien war nicht immer eindeutig. Ist als Beruf z.B. "Uhren" angegeben, so kann diese Person gleichermaßen dem Handel und dem Handwerk (Produktion) zugewiesen werden. Einige Personen gehören sowohl der Kategorie Adel als auch den Kategorien Militär oder Beamte an. Ein "ehemaliger Arzt" kann zu den Selbständigen oder zu den Rentnern gerechnet werden. Diese Kategorien dienen nur einer ersten groben Orientierung. Die eigene Überprüfung im Einzelfall können sie nicht ersetzen.</p>

			<br><p>Das gilt auch für die Zuweisung des Geschlechts: Es war nicht immer eindeutig, ob Fr. die Abkürzung für Frau oder für einen männlichen Vornamen sein sollte. Beides kam vor. Einer Person wurde dann "weiblich" zugeordnet, wenn es eindeutig war, z.B. durch die Berufsbezeichnung (Bäckerin, Lehrerin o.ä.) bzw. wenn der Beruf es nahelegt (z.B. Weißzeug). Dadurch kann es zu Fehlern gekommen sein. Auch hier muss eine Prüfung im Einzelfall stattfinden.</p>

			<br><p>Manche Straßen konnten nicht identifiziert werden, in manchen Fällen konnte das Arrondissement nicht klar ermittelt werden, z.B. wenn eine Straße zwei Arrondissements voneinander trennt. In diesem Fall sind alle angrenzenden Arrondissements erwähnt. Ggf. muss anhand der Hausnummer in den "Calepins de Cadastre" (periodische Häuserbestandsaufnahmen) in den Archives de Paris die Zugehörigkeit ermittelt werden. Existiert eine Straße nicht mehr, so ist das vermerkt. Konnte der neue Name nicht ermittelt werden oder wurde sie in zu viele neue Straßen aufgeteilt und eine Zuordnung war nicht möglich, so steht ein "?".</p>

			<br>
				<em>
					<div class="csl-bib-body" style="line-height: 1.35; margin-left: 2em; text-indent:-2em;">
				  	<div class="csl-entry">(1) Hillairet, Jacques. <i>Dictionnaire historique des rues de Paris</i>. Paris, 1963.</div>
				  		<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook&amp;rft.genre=book&amp;rft.btitle=Dictionnaire%20historique%20des%20rues%20de%20Paris&amp;rft.place=Paris&amp;rft.aufirst=Jacques&amp;rft.aulast=Hillairet&amp;rft.au=Jacques%20Hillairet&amp;rft.date=1963">
				  			
				  		</span>
				  	</div>
				  </em>
		</div>
	</div>
</div>
