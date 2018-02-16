<?php

function string_xor($a,$b) {
	$retour = "";
	if (strlen($a)===strlen($b)) {
		for ($i=0;$i<strlen($a);$i++) {
			$retour .= ($a[$i] ^ $b[$i]);
		}
		return $retour;
	}
	return $retour;
}
function cypher($msg,$k) {
	$hmsg = sha1($msg);
	$hkey = sha1($k);
	echo "Msg : $hmsg\nKey : $hkey\n";

	return string_xor($hmsg,$hkey);
}

$message = "START";
$key = "ZEKEY";

$retour = bin2hex(cypher($message,$key));
echo "chiffré : ".	$retour."\n";
echo "clé retrouvée :".string_xor(sha1($message),hex2bin($retour))."\n";
