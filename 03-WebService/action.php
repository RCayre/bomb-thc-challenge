<?php

// on suppose que cmd est commandeZESECRET
$authorizedCommands = ["974a38236b1d9e6383d9ead3b4ca0a8d8117c0f4","22982f3eb0b0516cdef93053eae620c55f73d93f","2ec1adfb530ecbbce6d23b2cca46f4e41ce5d54c"];

if ($_GET && isset($_GET['cmd'])) {
	header("Content-Type: application/json");
	$cmd = hash("sha1",$_GET['cmd']);
	if (in_array($cmd,$authorizedCommands)) {
		$path = realpath("./onetimepad");
		$retour = shell_exec("$path $cmd");
		passthru("/usr/bin/python send.py $retour");
		echo json_encode(["msg"=>"Command executed","success"=>true]);
	}
	else echo json_encode(["msg"=>"Command disabled","success"=>false]);
	/*if ($cmd==="START") {
		passthru("/usr/bin/python send.py START");
		echo json_encode(["msg"=>"Command executed","success"=>true]);
	}
	else if ($cmd==="STOP") {
		passthru("/usr/bin/python send.py STOP");
		echo json_encode(["msg"=>"Command disabled","success"=>false]);
	}
	else if ($cmd==="CHANGE_BGCOLOR") {
		passthru("/usr/bin/python send.py CHANGE_BGCOLOR");
		echo json_encode(["msg"=>"Command executed","success"=>true]);
	}
	else if ($cmd==="CHANGE_FGCOLOR") {
		passthru("/usr/bin/python send.py CHANGE_BGCOLOR");
		echo json_encode(["msg"=>"Command executed","success"=>true]);
	}*/
}
else system("whoami");
