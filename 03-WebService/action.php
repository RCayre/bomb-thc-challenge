<?php

// $authorizedCommands contient tous les hachés authorisés de cmd 
$authorizedCommands = ["974a38236b1d9e6383d9ead3b4ca0a8d8117c0f4","22982f3eb0b0516cdef93053eae620c55f73d93f","2ec1adfb530ecbbce6d23b2cca46f4e41ce5d54c"];

/*
* si le haché du "cmd" est dans $authorizedCommands, 
* le command va être chiffré et envoyer vers andruino pour executer.
*/
if ($_GET && isset($_GET['cmd'])) {
	header("Content-Type: application/json");
	$cmd = hash("sha1",$_GET['cmd']);
	if (in_array($cmd,$authorizedCommands)) {
		$path = realpath("./onetimepad");
		$retour = shell_exec("$path $cmd"); // note : $retour contient le output du command à executer (ici le chiffré du $cmd)
		passthru("/usr/bin/python send.py $retour"); // note : envoyer le chiffré vers l'andruino
		echo json_encode(["msg"=>"Command executed","success"=>true]);
	}
	else echo json_encode(["msg"=>"Command disabled","success"=>false]);
}
else echo "Aucun message reçu !";
