<?php
//require_once("hashValues.php");

// on suppose que cmd est commandeZESECRET
if ($_GET && isset($_GET['cmd']) /*&& isset($_GET['prepend'])*/) {
	header("Content-Type: application/json");
	$cmd = $_GET['cmd'];
	//$prepend = $_GET['prepend'];
	$hash = hash("sha1", /*$prepend . */$cmd);
	$path = realpath("./onetimepad");
	exec($path . " " . $hash, $retour, $exit_code);
	//passthru($path . " " . $hash,$exit_code);
	if ($exit_code === 0){
		passthru("/usr/bin/python send.py " . $retour[0]);
		echo json_encode(["msg"=>"Command executed","success"=>true]);
	}
	elseif ($exit_code === 1) {
		echo json_encode(["msg"=>"Command disabled","success"=>false]);	
	}
	else {
		echo json_encode(["msg"=>"Internal error","success"=>false]);
	}

	/*
	if (array_search($hash, $hashValues)){
		//passthru("/usr/bin/python send.py ". $cmd);
		if ($hash === $hashValues['stop']){
			echo json_encode(["msg"=>"Command disabled","success"=>false]);
		}else {
			echo json_encode(["msg"=>"Command executed","success"=>true]);
		}
	}
	*/
	/*
	if ($cmd==="START") {
		//passthru("/usr/bin/python send.py START");
		echo json_encode(["msg"=>"Command executed","success"=>true]);
	}
	else if ($cmd==="STOP") {
		//passthru("/usr/bin/python send.py STOP");
		echo json_encode(["msg"=>"Command disabled","success"=>false]);
	}
	else if ($cmd==="CHANGE_BGCOLOR") {
		//passthru("/usr/bin/python send.py CHANGE_BGCOLOR");
		echo json_encode(["msg"=>"Command executed","success"=>true]);
	}
	else if ($cmd==="CHANGE_FGCOLOR") {
		//passthru("/usr/bin/python send.py CHANGE_FGCOLOR");
		echo json_encode(["msg"=>"Command executed","success"=>true]);
	}
	*/
}
else system("whoami");
