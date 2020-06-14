var leafletMap = null;

$('document').ready(function(){
    initializeMap();
    initializeMarkers();
});

function initializeMap(){
    leafletMap = L.map('mapBox', {
        center: [48.859289, 2.342122],
        maxBounds: [
            [48.813141, 2.234129],
            [48.908715, 2.422941]
        ],
        scrollWheelZoom: false,
        zoom: 11
    });

    L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: ['a','b','c']
    }).addTo(leafletMap);
}

function initializeMarkers(){
    var url = window.location;
    url = url + (window.location.search ? '&' : '?') + 'export=json';

    $.getJSON(url, function(json){
        if(json.person) mapPerson(json.person);
        if(json.company) mapCompany(json.company);
        if(json.persons) json.persons.forEach(mapPerson);
        if(json.companies) json.companies.forEach(mapCompany);
    });
}

function mapPerson(json) {
    console.log('person', json);

    // var lastName = json.surname;
    // var firstName = '';
    // var prof = '';

    json.addresses.forEach(function(addr){
        leafletAddrs.push(addr);
        var mapPin = L.marker(
            L.latLng(
                // take address coordinates if existing, otherwise take autodetected street coordinates
                addr.geo_lat || addr.street.geo_lat,
                addr.geo_long || addr.street.geo_long
            ),
            {id: json.id+'-'+addr.id}
        );

        mapPin.addTo(leafletMap);
        mapPin.bindPopup(
            '<span style="font-size:16pt;text-shadow:none">'
            +json.surname+', '+json.profession_verbatim
            +'<br>'+addr.street.name_old_clean+'</span>'
        );
    });
}

function mapCompany(json){
    console.log('company', json)
}


// function initializeMarkers(){

//     // fetch Json file with the data to be displayed on the map
//     var json = fetchJson();

//     console.log(json);

//     /*var personObj = getPersonFromJson(json);

//     for(int i = 0; i < personObj.addresses.length; i++){
//         var mapPin = L.marker(L.latLng(Number(personObj.addresses[i].geo_lat), Number(personObj.addresses[i].geo_long)), {id: personObj.id});
//         mapPin.addTo(map);
//         mapPin.bindPopup('<span style ="font-size:16pt;text-shadow:none">'+personObj.name+', '+personObj.profession+'<br>'+personObj.addresses[i].streetName+'</span>');
//     }*/

// }

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
