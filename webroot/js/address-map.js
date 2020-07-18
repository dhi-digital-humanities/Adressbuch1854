var leafletMap = null;
var oms = null;
var markers = null;

$('document').ready(function(){
    initializeMap();
    initializeMarkercluster();
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

    if(document.getElementById('mapBox').parentElement.className == 'bigMap'){
        var legend = L.control({position: 'bottomright'});

        legend.onAdd = function (map) {

            var div = L.DomUtil.create('div', 'info legend');
            div.innerHTML += '<h4>Legende</h4>'
                + 'Personen <img src="'+createCanvasMarker('#5F9ea0', '#2F4F4F', null)+'" alt="blau"><br>'
                + 'Unternehmen <img src="'+createCanvasMarker('#FF8C00', '#8B4513', null)+'" alt="orange"><br>'
                + 'Beide <img src="'+createCanvasMarker('#8B008B', '#4B0082', null)+'" alt="violett"><br>';

            return div;
        };

        legend.addTo(leafletMap);
    }
}

// use via Leaflet plugin https://github.com/Leaflet/Leaflet.markercluster
function initializeMarkercluster(){
    markers = L.markerClusterGroup({
        maxClusterRadius: 1,
        iconCreateFunction: function(cluster) {
            var types = new Map();

            cluster.getAllChildMarkers().forEach(function a(marker){
                types.set((marker.options.id.includes('P')? 'P' : 'C'), true);
            });

            switch(types.size){
                case 1:
                    if(types.has('P')){
                        // return customHtmlIcon('#5F9ea0', '#2F4F4F', '12pt', '#FFFFFF', '<b>'+cluster.getChildCount()+'</b>');
                        return customCanvasIcon('#5F9ea0', '#2F4F4F', cluster.getChildCount());
                        break;
                    } else if(types.has('C')){
                        // return customHtmlIcon('#FF8C00', '#8B4513', '12pt', '#FFFFFF', '<b>'+cluster.getChildCount()+'</b>');
                        return customCanvasIcon('#FF8C00', '#8B4513', cluster.getChildCount());
                        break;
                    }
                default:
                // return customHtmlIcon('#8B008B', '#4B0082', '12pt', '#FFFFFF', '<b>'+cluster.getChildCount()+'</b>');
                return customCanvasIcon('#8B008B', '#4B0082', cluster.getChildCount());
            }
        },
        zoomToBoundsOnClick: false,
        showCoverageOnHover: false
    });

    markers.on('clusterclick', function (a) {
        a.layer.spiderfy();
        if(leafletMap.getZoom() < 14) a.layer.zoomToBounds({padding: [20, 20], maxZoom: 14});
    });
}

function initializeMarkers(){
    var url = window.location;
    url = url + (window.location.search ? '&' : '?') + 'export=json';

    $.getJSON(url, function(json){
        if(json.person) mapPerson(json.person);
        if(json.company) mapCompany(json.company);
        if(json.persons) json.persons.forEach(mapPerson);
        if(json.companies) json.companies.forEach(mapCompany);

        leafletMap.addLayer(markers);
    });
}

function clickZoom(e) {
    if(leafletMap.getZoom() < 14) leafletMap.setView(e.target.getLatLng(),14);
}

function mapPerson(json) {
    var name = '';
    if(json.title && !json.title.trim().length == 0){
        name+=json.title+' ';
    }
    if(json.name_predicate && !json.name_predicate.trim().length == 0){
        name+=json.name_predicate+' ';
    }
    name+=json.surname;
    if(json.first_name && !json.first_name.trim().length == 0){
        name+=', '+json.first_name;
    }

    makePinPerAddress(json.addresses, name, json.profession_verbatim, json.id, true);
}

function mapCompany(json){
    var name = json.name;
    if(json.specification_verbatim && !json.specification_verbatim.trim().length == 0){
        name += ', '+json.specification_verbatim ;
    }

    makePinPerAddress(json.addresses, name, json.profession_verbatim, json.id, false);
}

function makePinPerAddress(addressArray, name, prof, id, isPerson){
    addressArray.forEach(function(addr){

        var addrFull = addr.street.name_old_clean;
		if(addrFull != addr.street.name_new) addrFull += ' ('+addr.street.name_new+')';
		if(addr.houseno) addrFull += ' '+addr.houseno;
		if(addr.houseno_specification) addrFull += addr.houseno_specification;
		if(addr.address_specification_verbatim) addrFull += ', '+addr.address_specification_verbatim;

        var link ='/Adressbuch1854/';
        link += isPerson ? 'persons' : 'companies';
        link += '/view/'+id;

        var mapPin = L.marker(
            L.latLng(
                // take address coordinates if existing, otherwise take autodetected street coordinates
                addr.geo_lat || addr.street.geo_lat,
                addr.geo_long || addr.street.geo_long
            ),
            {
                // specify the icons (if unspecified, the default blue leaflet marker is used)

                // customized HTML-icons
                // icon: isPerson ? customHtmlIcon('#5F9ea0', '#2F4F4F', null, null, null) : customHtmlIcon('#FF8C00', '#8B4513', null, null, null),

                // customized HTML canvas icons
                icon: isPerson ? customCanvasIcon('#5F9ea0', '#2F4F4F', null) : customCanvasIcon('#FF8C00', '#8B4513', null),

                // markers resembling the original leaflet markers but having different colours
                // icon: isPerson ? colourMarker('blue') : colourMarker('orange'),

                id: (isPerson ? 'P' : 'C')+'-'+id+'-'+addr.id,
                riseOnHover: true
            }
        );

        markers.addLayer(mapPin);

        if(document.getElementById('mapBox').parentElement.className == 'smallMap'){
            mapPin.bindPopup(
                '<span style="font-size:10pt;text-shadow:none">'
                +addrFull+'<br></span>',
                {
                    maxWidth: document.getElementById('mapBox').offsetWidth - 40
                }
            );
            mapPin.bindTooltip(addr.street.name_old_clean);
        } else{
            mapPin.bindPopup(
                '<span style="font-size:12pt;text-shadow:none"><h5>'
                +name
                + (prof ? '<br>'+prof : '')+'</h5>'
                +addrFull+'<br>'
                +'<a href="'+link+'">Zeige Datensatz</a>'+'</span>'
            );
            mapPin.bindTooltip(name);
        }

        mapPin.on('click', clickZoom);
    });
}

// options for customizd icons

// 1. paint a marker with HTML5 canvas
// got inspiration from https://gist.github.com/viktorkelemen/1451945
function customCanvasIcon(colour, borderColour, text){
    return new L.Icon({
        iconUrl: createCanvasMarker(colour, borderColour, text),
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41],
    });
}

function createCanvasMarker(colour, borderColour, text) {

    var width = 25;
    var height = 30;
    var radius = 15;

    var canvas, context;

    canvas = document.createElement("canvas");
    canvas.width = width;
    canvas.height = height;

    context = canvas.getContext("2d");

    context.clearRect(0,0,width,height);

    context.fillStyle = colour;
    context.strokeStyle = borderColour;

    context.beginPath();
    context.moveTo(radius, 0);
    context.lineTo(width - radius, 0);
    context.quadraticCurveTo(width, 0, width, height / 2);
    context.lineTo(width / 2, height);
    context.lineTo(0, height  / 2)
    context.quadraticCurveTo(0, 0, radius, 0);
    context.closePath();

    context.fill();
    context.stroke();

    if(text){
        context.font = "bold 8pt Arial";
        context.fillStyle = "white";
        context.textAlign = "center"
        context.fillText(text, width/2, height/2);
    }

    return canvas.toDataURL();
  }

// 2. create a marker by formatting an HTML div accordingly
// inspiration source https://stackoverflow.com/a/40870439
function customHtmlIcon(colour, borderColour, fontSize, fontColour, text){

    var markerHtmlStyles =
        'background-color: '+colour+';'
        + 'width: 3rem;'
        + 'height: 3rem;'
        + 'display: block;'
        + 'left: -3rem;'
        + 'top: -0.5rem;'
        // uncomment the following lines to have on edge markers pointing down to the geopoint (the tip of the marker is the lowest point)
        // problem: it also rotates any text contained
        // + 'left: -1.5rem;'
        // + 'top: -1.5rem;'
        // + 'transform: rotate(45deg);'
        + 'position: relative;'
        + 'border-radius: 3rem 3rem 0;'
        + 'border: 1px solid '+borderColour+';';
    var textStyles =
        'font-size: '+(fontSize ? fontSize : '12pt')+';'
        + 'color: '+(fontColour ? fontColour : 'black')+';'
        + 'position = absolute;'
        + 'padding: 1rem;'
        //+ 'transform: rotate(45deg);'
        + 'text-align: center;';

    return L.divIcon({
        className: "mapPin",
        iconAnchor: [0, 24],
        labelAnchor: [-6, 0],
        popupAnchor: [0, -36],
        html: '<div style="'+markerHtmlStyles+'"><span style="'+textStyles+'">'+(text? '<b>'+text+'</b>' : '')+'</span></div>'
    });
}

// 3. use icon-images such as provided by this github project. Problem: they don't except any HTML-properties, thus the markercluster
// can't write the number of markers automatically
// from https://github.com/pointhi/leaflet-color-markers
function colourMarker(colour){
    return new L.Icon({
        iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-'+colour+'.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
  });
}

// 4. Creating your own markers using personalized picture files (could pose same problem as 3.)
