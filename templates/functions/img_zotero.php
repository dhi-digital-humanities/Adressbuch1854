<?php


//This function describes tag zotero for street view. This function generates HTML code for tag zotero of street view with $street_name, $street_new.

 					function zoterostreets($street_name, $no_old, $no_new,  $street_new){

		    	  	$code_span= '<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook&amp;rft.genre=bookitem&amp;rft.atitle=';
			        $code_span.=$street_name;
			        $code_span.='&amp;rft.description=Die Straße heute: ';
			        $code_span.=$street_new;
			        $code_span.='. Vor 1860, die Straße war in: ';
			        $code_span.=$no_old;
			        $code_span.=' Arrondissements. Nach 1860 die Straße ist in: ' ;
			        $code_span.=$no_new;
			     	  $code_span.=' Arrondissements.&amp;rft.btitle=Adressbuch%20der%20Deutschen%20in%20Paris%20f%C3%BCr%20das%20Jahr%201854&amp;rft.place=Paris&amp;rft.edition=Elektronische%20Edition&amp;rft.aufirst=F.&amp;rft.aulast=Kronauge&amp;rft.au=F.%20Kronauge&amp;rft.date=1854&amp;rft.language=Allemand">'; 
		        

        	return ($code_span);
                                      }

//This function describes tag zotero for person view. This function generates HTML code for tag zotero of person view with $name, $precision, $precision2, $military_status, $social_status, $occupation_status, $gender, $ldh, $begP.

         function zoteroperson($name, $precision, $precision2, $military_status, $social_status, $occupation_status, $gender, $ldh, $houseno, $addr_name, $addr_new,  $begP){

				    	  $code_span= '<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook&amp;rft.genre=bookitem&amp;rft.atitle=';
				        $code_span.=$name;
				        $code_span.='&amp;rft.description=Der Beruf ist: ';
				        $code_span.=$precision;
				        $code_span.=', und: ';
				        $code_span.=$precision2;
				        $code_span.=', militärischer Status: ';
				        $code_span.=$military_status;
				        $code_span.=', Sozialer Status: ';
				        $code_span.=$social_status;
				        $code_span.=', Beruflicher Status: ';
				        $code_span.=$occupation_status;
				        $code_span.=', Geschlecht: ';
				        $code_span.=$gender;
				        $code_span.=', Rang in der Ehrenlegion: ';
				        $code_span.=$ldh;
				        $code_span.=', Straße: ';
				        $code_span.='(';
				        $code_span.=$houseno;
				        $code_span.=') ';
				        $code_span.=$addr_name;
				        $code_span.=', die Straße heute: ';
				        $code_span.=$addr_new;
				        $code_span.='&amp;rft.btitle=Adressbuch%20der%20Deutschen%20in%20Paris%20f%C3%BCr%20das%20Jahr%201854&amp;rft.place=Paris&amp;rft.edition=Elektronische%20Edition&amp;rft.aufirst=F.&amp;rft.aulast=Kronauge&amp;rft.au=F.%20Kronauge&amp;rft.date=1854&amp;rft.pages=';
				        $code_span.=$begP;
				        $code_span.= '&amp;rft.language=Allemand">'; 
		        

        	return ($code_span);
                                      }

//This function describes tag zotero for arrondissement view. This function generates HTML code for tag zotero of arrondissement view with $noStr, $aar1.

            function zoteroarr($noStr, $arr1){

		    	$code_span= '<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook&amp;rft.genre=bookitem&amp;rft.atitle= Das Arrondissement ist : ';
		        $code_span.=$noStr;
		        $code_span.='&amp;rft.description= der code INSEE ist: ';
		        $code_span.=$arr1;
		        $code_span.='&amp;rft.btitle=Adressbuch%20der%20Deutschen%20in%20Paris%20f%C3%BCr%20das%20Jahr%201854&amp;rft.place=Paris&amp;rft.edition=Elektronische%20Edition&amp;rft.aufirst=F.&amp;rft.aulast=Kronauge&amp;rft.au=F.%20Kronauge&amp;rft.date=1854&amp;rft.language=Allemand">'; 
		        

        	return ($code_span);
        }

//This function describes tag zotero for company view. This function generates HTML code for tag zotero of company view with $nachname, $prof_category, $begP:

        function zoterocomp($nachname, $prof_category, $specification, $profession, $addr_no, $addr_old, $addr_new, $begP){

    	$code_span= '<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Abook&amp;rft.genre=bookitem&amp;rft.atitle=';
    	$code_span.=$nachname;
    	$code_span.='&amp;rft.description=Der Berufskategorie ist :';
    	$code_span.=$prof_category;
    	$code_span.=' und : ';
    	$code_span.=$specification;
    	$code_span.=', der Beruf ist :';
    	$code_span.=$profession;
    	$code_span.=', Die Straße ist: (';
    	$code_span.=$addr_no;
    	$code_span.=') ';
    	$code_span.=$addr_old;
    	$code_span.=', die Straße heute ist: ';
    	$code_span.=$addr_new;
    	$code_span.='&amp;rft.btitle=Adressbuch%20der%20Deutschen%20in%20Paris%20f%C3%BCr%20das%20Jahr%201854&amp;rft.place=Paris&amp;rft.edition=Elektronische%20Edition&amp;rft.aufirst=F.&amp;rft.aulast=Kronauge&amp;rft.au=F.%20Kronauge&amp;rft.date=1854&amp;rft.pages=';
      $code_span.=$begP;
      $code_span.= '&amp;rft.language=Allemand">';
        

        return ($code_span);
                                      }

//This function describes tag image for person view and company view. This function generates tag image to see Adressbuch's pages in HD with $path, $size, $id, $begP.

					function image($path, $size, $id, $begP)
						{
							$code_html_image = "<a target='_blank' href=/../scans/HD/BHVP_703983_$begP.jpg>";
							$code_html_image.=" <img src='";
							$code_html_image.= $path;
							$code_html_image.= $size;
							$code_html_image.= $id;
							$code_html_image.= $begP;
							$code_html_image.= ".jpg'";
							$code_html_image.= " width = '100'";
							$code_html_image.= "title= 'IHA zur Nutzung der Seite $begP'";


						return ($code_html_image); 
						}

				function text($path, $id, $begP)
						{
							$code_text = "<object data='";
							$code_text.= $path;
							$code_text.= $id;
							$code_text.= $begP;
							$code_text.= ".txt'/>";

						
						return ($code_text);
					}

				function scan_zotero($begP)

					{
						$code_scan='<span class="Z3988" title="url_ver=Z39.88-2004&amp;ctx_ver=Z39.88-2004&amp;rfr_id=info%3Asid%2Fzotero.org%3A2&amp;rft_val_fmt=info%3Aofi%2Ffmt%3Akev%3Amtx%3Adc&amp;rft.type=artwork&amp;rft.title=Zeite%20';
						$code_scan.=$begP;
						$code_scan.='%20von%20das%20Adressbuch%20der%20Deutschen%20f%C3%BCr%20das%20Jahr%201854&amp;rft.description=Numerisation%20au%20format%20JPEG%2C%20metadat%20disponible%20ici%20%3A%20https%3A%2F%2Fdoi.org%2F10.5281%2Fzenodo.5524880%2C%20c%C3%B4te%3A%20BHVP_703983_';
						$code_scan.=$begP;
						$code_scan.='&amp;rft.identifier=http%3A%2F%2Fadressbuch1854.dh.uni-koeln.de%2Fscans%2FSD%2FBHVP_703983_';
						$code_scan.=$begP;
						$code_scan.='.jpg&amp;rft.aufirst=F&amp;rft.aulast=Kronauge&amp;rft.au=F%20Kronauge&amp;rft.date=1854&amp;rft.language=deu%20fra"></span>';

						return($code_scan);
					}