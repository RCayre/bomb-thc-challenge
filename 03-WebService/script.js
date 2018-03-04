
/*
*  Fonction makeRequest
*  --------------------------
*  Envoyer des requêtes http et mettre à jour l'affichage
*/
    function makeRequest(url) {

        var httpRequest = false;

        httpRequest = new XMLHttpRequest();

        if (!httpRequest) {
            alert('Abandon :( Impossible de créer une instance XMLHTTP');
            return false;
        }
        httpRequest.onreadystatechange = function() { alertContents(httpRequest); };
        httpRequest.open('GET', url, true);
        httpRequest.send(null);

    }

    function alertContents(httpRequest) {

        if (httpRequest.readyState == XMLHttpRequest.DONE) {
            if (httpRequest.status == 200) {
                oldvalue = document.querySelector('#compteur').innerHTML;
		newvalue = httpRequest.responseText;
		if (oldvalue!=newvalue) {
			document.querySelector('#compteur').innerHTML = newvalue;
		}
            } else {
                console.log('Un problème est survenu avec la requête.');
            }
        }

    }
// Chaque 500 milliseconde, demander le fichier compteur pour mettre à jour l'affichage du temps.
window.onload = function() {
	setInterval(function() {makeRequest("read.php?file=compteur");},500);
}
