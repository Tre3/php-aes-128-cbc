<?php

function encrypt($plain_text, $passphrase) {
    $random_salt = openssl_random_pseudo_bytes(8);
    
    $key_data = $passphrase . $random_salt;
    $raw_key = md5($key_data, true);

    $iv_data = $raw_key . $passphrase . $random_salt;
    $iv = md5($iv_data, true);

    $encrypted = openssl_encrypt($plain_text, 'aes-128-cbc', $raw_key, OPENSSL_RAW_DATA, $iv);
    echo base64_encode("Salted__".$random_salt.$encrypted) . "\n";
}

?>
