<?php

if ($_GET && isset($_GET['cmd'])) {
	header("Content-Type: application/json");
	$cmd = $_GET['cmd'];
	if ($cmd==="START") {
		shell_exec("/usr/bin/python send.py START");
		echo json_encode(["msg"=>"Command executed","success"=>true]);
	}
	else if ($cmd==="STOP") {
		shell_exec("/usr/bin/python send.py STOP");
		echo json_encode(["msg"=>"Command disabled","success"=>false]);
	}
	else if ($cmd==="CHANGE_BGCOLOR") {
		shell_exec("/usr/bin/python send.py CHANGE_BGCOLOR");
		echo json_encode(["msg"=>"Command executed","success"=>true]);
	}
	else if ($cmd==="CHANGE_FGCOLOR") {
		shell_exec("/usr/bin/python send.py CHANGE_GGCOLOR");
		echo json_encode(["msg"=>"Command executed","success"=>true]);
	}
}
else phpinfo();
