<?php

if ($_GET && isset($_GET['cmd'])) {
	header("Content-Type: application/json");
	$cmd = $_GET['cmd'];
	if ($cmd==="START") {
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
	}
}
else system("whoami");
