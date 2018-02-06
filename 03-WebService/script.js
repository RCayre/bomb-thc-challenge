
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
window.onload = function() {
	setInterval(function() {makeRequest("http://localhost/WebService/read.php?file=compteur");},500);
}
