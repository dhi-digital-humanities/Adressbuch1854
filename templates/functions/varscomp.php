  <?php 
 
//$nachname, $prof_category, $specification and $profession are 4 variables to save company's name, name of category's profession, specification verbatim and profession verbatim on zotero with zoterocomp's function.

			       	$nachname=$company->name;
			       	$prof_category=isset($company->prof_category->name) ? ($company->prof_category->name) : 'unbekannt';
			       	$specification=isset($company->specification_verbatim) ? ($company->specification_verbatim) : 'keine Angaben';
			       	$profession=isset($company->profession_verbatim) ? ($company->profession_verbatim) : 'unbekannt';
			       	

					$comp_street=$company->addresses;

						foreach ($comp_street as $street_name) {

							//print_r($company->addresses);
							//print('<br>');
							$street_old=$street_name['street']['name_old_clean'];
																}
						
					$addr_old=$street_old;	

						foreach ($comp_street as $street_name) {

							$street_new=isset($street_name['street']['name_new']) ? ($street_name['street']['name_new']) : 'Die name heute ist unbekant oder nicht existiert mehr';
																}	       	

					$addr_new=$street_new;

						foreach($comp_street as $street_nummer){

							$street_no=isset($street_nummer['houseno']) ? ($street_nummer['houseno']) : 'Der nummer ist unbekannt';
						}
					  

					$addr_no=$street_no;