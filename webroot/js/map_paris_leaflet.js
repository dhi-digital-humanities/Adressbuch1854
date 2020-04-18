// Map mit Leaflet

	var map;
	
	document.getElementById('mapBox').onload() = initializeMap(true);
	
	function initializeMarkers(useQuestionMark){
		
		// fetch Json file with the data to be displayed on the map
		var json = fetchJson(useQuestionMark);
		
		console.log(json.pers.surname);
		
		/*var personObj = getPersonFromJson(json);
		
		for(int i = 0; i < personObj.addresses.length; i++){
			var mapPin = L.marker(L.latLng(Number(personObj.addresses[i].geo_lat), Number(personObj.addresses[i].geo_long)), {id: personObj.id});
			mapPin.addTo(map);
			mapPin.bindPopup('<span style ="font-size:16pt;text-shadow:none">'+personObj.name+', '+personObj.profession+'<br>'+personObj.addresses[i].streetName+'</span>');
		}*/
		
	}
	
	function initializeMap(useQuestionMark) {
		
		
		var bounds=[[48.813141, 2.234129],[48.908715, 2.422941]];
		map = L.map('mapBox', {center: [48.859289, 2.342122], zoom: 11, maxBounds: bounds, scrollWheelZoom: false});
		L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
			subdomains: ['a','b','c']
		}).addTo( map );
		
		//var useQuestionMark = true;
		
		initializeMarkers(useQuestionMark);
	}
	
	function fetchJson(useQuestionMark){
		var url = window.location;
		
		if(useQuestionMark){
			url+='?';
		} else {
			url+='&';
		}
		
		url = url+'format=json&down=false';
		console.log(url);
		var json = $.getJSON(url);
		console.log(json);
		var parsedJson = JSON.parse(json);
		console.log(parsedJson);
		return parsedJson;
	}
	
	/*function getPersonFromJson(json){
		
		var addresses = json.person.addresses;
		var addressArray = new Array();
		addresses.forEach(getAddrObject());
		
		function getAddrObj(item, index){
			var i = 0;
			var longi = item.geo_long;
			var lati = item.geo_lat;
			
			if(longi != null && lati != null){
				longi = item.street.geo_long;
				lati = item.street.geo_lat;
			}
			
			var name = '';
			var streetOld = item.street.name_old_clean;
			var streetNew = item.street.name_new;
			var street;
			if(streetOld == streetNew){
				street = streetOld;
			} else {
				street = streetOld+' ('+streetNew+')';
			}
			
			var housNo = item.houseno;
			if(item.houseno_specification != null){
				housNo+=' '+item.houseno_specification;
			}
			
			var address = {streetName: street+' '+housNo, geo_long: longi, geo_lat: lati};
			
			addressArray[i] = address; 
			i++;
		}
		
		var persName = '';
		if(json.person.title != null){
			persName+=json.person.title+' ';
		}
		if(json.person.name_predicate != null){
			persName+=json.person.name_predicate+' ';
		}
		persName+=json.person.surname;
		if(json.person.first_name != null){
			persName+=', '+json.person.first_name;
		}
		
		var job;
		if(json.person.profession_verbatim != null){
			job = json.person.profession_verbatim;
		} else {
			job = '';
		}
		
		var idv = 'P-';
		idv += json.person.id;
		
		
		var person = {name: persName, profession: job, addresses: addressArray, id: idv};
		return person;
	}*/