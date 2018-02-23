<?php
$private_key = "TLS-SEC ";

function sanitize_user_input($input){
    $re = '/[^a-zA-Z0-9]/';
    $secured_input = preg_replace($re,"",$input);
    return $secured_input;
}

function session_kill(){
    $authValue = "";
    setcookie('auth',$authValue,time() - 10,"/");

}

function isValid($user){
    $re = '/^[a-zA-Z0-9]+$/';
    $valid = preg_match($re,$user);
    if ($valid === 1) {
        return TRUE;
    }
    return FALSE;
}

function encrypt($user){
    global $private_key;
    $remain = 8 - (strlen($user) % 8);
    if ($remain != 0) {
        $user .= str_repeat(" ",$remain);
    }
    $str_len = strlen($user);
    $ciphertext = "";
    /*
    for ($i = 0; $i < $str_len; $i++) {
        $ciphertext .= $user[$i] ^ $private_key[$i % 8];
        
    }
    */
    $ciphertext = mcrypt_encrypt(MCRYPT_DES, $private_key,
                                 $user, MCRYPT_MODE_ECB);
    return base64_encode($ciphertext);
}

function decrypt($ciphertext){
    global $private_key;
    $user_encrypted = base64_decode($ciphertext);
    $str_len = strlen($user_encrypted);
    $user = "";
    /*
    for ($i = 0; $i < $str_len; $i++) {
        $user .= $user_encrypted[$i] ^ $private_key[$i % 8];
    }
    */
    $user = mcrypt_decrypt(MCRYPT_DES, $private_key,
                                 $user_encrypted, MCRYPT_MODE_ECB);
    $user = trim($user);
    return $user;
}
/*
Test section

$user = "aaaaaaaa";
$cookie = encrypt($user);
echo $cookie . "\n";
$user = decrypt($cookie);
echo $user;
*/
?>
