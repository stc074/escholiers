function deleteMessage(idMessage) {
    if(confirm('Voulez vous vraiment effacre ce message ?')) {
        window.location.href='delete-message-'+idMessage+'.html';
    }
}

function deleteSpectacle(idSpectacle) {
    if(confirm('Voulez vous vraiment effacer ce spectacle ?')) {
        window.location.href='delete-spectacle-'+idSpectacle+'.html';
    }
}

function deleteReservation(idEvent) {
    window.location.href="delete-reservation-"+idEvent+".html";
}

function clickRes(idEvent) {
   if(document.getElementById("listRes"+idEvent).style["display"]=="none") {
        document.getElementById("listRes"+idEvent).style["display"]="block";
    } else {
        document.getElementById("listRes"+idEvent).style["display"]="none";
    }
}

function testDelDate(idSpectacle, idEvent) {
    if(confirm("Voulez vous vraiment supprimer cette date ?")) {
        window.location.href="delete-date-"+idSpectacle+"-"+idEvent+".html";
    }
}

function salleUp(idSpectacle, idSalle) {
    window.location.href="salle-up-"+idSpectacle+"-"+idSalle+".html";
}

function salleDown(idSpectacle, idSalle) {
    window.location.href="salle-down-"+idSpectacle+"-"+idSalle+".html";
}

function salleDel(idSpectacle, idSalle) {
    if(confirm("Voulez vous effacer cette salle ?\n (Ainsi que toutes les dates associées quelque soit le spectacle ?)")) {
        window.location.href="salle-del-"+idSpectacle+"-"+idSalle+".html";
    }
}

function delSpectacle(idSpectacle) {
    if(confirm("Voulez vous effacer ce spectacle ? \n (Ainsi que toutes les dates le concernant?)")) {
        window.location.href="del-spectacle-"+idSpectacle+".html";
    }
}
function changeSpectAct(box, idSpectacle) {
    if(box.checked) {
        window.location.href="change-spectacle-actuel-"+idSpectacle+"-1.html";
    } else if (!box.checked) {
        window.location.href="change-spectacle-actuel-"+idSpectacle+"-0.html";
    }   
}

function testDelPers() {
        return confirm("Voulez vous vraiment effacer cette personne ?");
}

function upPersonne(idPersonne, idGroupe) {
    window.location.href="up-personne-"+idPersonne+"-"+idGroupe+".html";
}

function downPersonne(idPersonne, idGroupe) {
    window.location.href="down-personne-"+idPersonne+"-"+idGroupe+".html";
}

function testDelGroup(idGroup) {
    if(confirm("Voulez vous vraiment effacer ce groupe ? \n (Donc toutes les personnes de ce groupe ?)")) {
        window.location.href="delete-group-"+idGroup+".html";
    }
}

function upLibelle(id) {
    window.location.href="up-libelle-"+id+".html";
}

function downLibelle(id) {
    window.location.href="down-libelle-"+id+".html";
}

function deleteGalerie(idGalerie) {
    if(confirm("Voulez vous effacer cette galerie ?\n(donc toutes les images qu'elle contient)")) {
        window.location.href="delete-galerie-"+idGalerie+".html";
    }
}
function upGalerie(idGalerie) {
    window.location.href="up-galerie-"+idGalerie+".html";
}

function downGalerie(idGalerie) {
    window.location.href="down-galerie-"+idGalerie+".html";
}

function deleteVideo(idVideo) {
    if(confirm("Voulez vous vraiment effacer cette video ?")) {
        window.location.href="delete-video-"+idVideo+".html";
    }
}
function testSubmDelPage() {
    var checke=false;
    for(k=0; k<formu.idPage.length; k++) {
        if(formu.idPage[k].checked) {
            checke=true;
        }
    }
    if(checke) {
        return confirm("Voulez vous vraiment effacer cette page ?");
    } else {
        return false;
    }
}

function testDelImage(idPhoto, idGalerie) {
    if(confirm("Voulez vous vraiment effacer cette photo ?")) {
        window.location.href="delete-image-"+idPhoto+"-"+idGalerie+".html";
    }
}

function imageUp(idPhoto, idGalerie) {
    window.location.href="image-up-"+idPhoto+"-"+idGalerie+".html";
}

function imageDown(idPhoto, idGalerie) {
    window.location.href="image-down-"+idPhoto+"-"+idGalerie+".html";
}

function downVideo(idVideo) {
    window.location.href="down-video-"+idVideo+".html";
}

function upVideo(idVideo) {
    window.location.href="up-video-"+idVideo+".html";
}
