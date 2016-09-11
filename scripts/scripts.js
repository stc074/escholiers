window.onload=function() {
if(document.getElementById('signLDO')) {
    document.getElementById('formLDO').style['display']='none';
}
};

function initialize(lati, longi) {
    //var addy=address;
    map=new google.maps.Map(document.getElementById("mapCanvas"), {
        zoom: 17,
        center: new google.maps.LatLng(lati, longi),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var myLatlng = new google.maps.LatLng(lati,longi);
    //var myMarkerImage = new google.maps.MarkerImage('images/favicon.png');
    var myMarker = new google.maps.Marker({
	// Coordonnées
	position: myLatlng,
	map: map,
        //icon: myMarkerImage,
	title: "Les Escholiers"
        });  
        
        // Options de la fenêtre
        var myWindowOptions = {
	content: '<h6>Les Escholiers</h6>'
        };
 
        // Création de la fenêtre
        var myInfoWindow = new google.maps.InfoWindow(myWindowOptions);
        // Affichage de la fenêtre au click sur le marker
        google.maps.event.addListener(myMarker, 'click', function() {
	myInfoWindow.open(map,myMarker);
        });
    }

function showPers(idGrp) {
    var disp=document.getElementById('hid'+idGrp).style["display"];
    if(disp=="none") {
        document.getElementById("hid"+idGrp).style["display"]="block";
    } else {
        document.getElementById("hid"+idGrp).style["display"]="none";
    }
}

function signLDO() {
    var objForm=document.getElementById('formLDO');
    var objSign=document.getElementById('signLDO');
    if(objForm.style['display']=='none') {
        objSign.innerHTML='<h2>Cacher le formulaire</h2>';
        objForm.style['display']='block';
    } else {
        objSign.innerHTML='<h2>Signer le livre d\'or</h2>';
        objForm.style['display']='none';
    }
}
