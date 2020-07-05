<?php

// This functionalities for dual key rotation
function decrypt($entityBody) {
    $recipient_fingerprint_1 = "";
    $recipient_fingerprint_2 = "";
    putenv("GNUPGHOME=/etc/pki/tls/certs/");
    $res = gnupg_init();
    $techKey = array($recipient_fingerprint_1, $recipient_fingerprint_2);
    foreach ($techKey as $key => $value) {
        $info = gnupg_keyinfo($res, $value);
        if ($info['0']['expired'] == "") {
            $validkey[] = $value;
        }
    }

    foreach ($validkey as $kk => $vv) {
        gnupg_adddecryptkey($res, $vv, '');
    }

    $b = preg_replace('/_/', '/', $entityBody);
    $c = preg_replace('/-/', '+', $b);
    $request = gnupg_decrypt($res, base64_decode($c));
    return $request;
}

// This functionalities for dual key rotation
function encrypt($request) {
    $recipient_fingerprint_1 = "";
    $recipient_fingerprint_2 = ""; 
    $sender_fingerprint_1 = ""; 
    $sender_fingerprint_2 = "";

    putenv("GNUPGHOME=/etc/pki/tls/certs/");
    $res = gnupg_init();
    gnupg_setarmor($res, 0); // disable armored output;
    $techKey = array($sender_fingerprint_1, $sender_fingerprint_2);
    foreach ($techKey as $key => $value) {
        $info = gnupg_keyinfo($res, $value);
        if ($info['0']['expired'] == "") {
            $validkey1[] = $value;
        }
    }

    foreach ($validkey1 as $key2 => $value2) {
        gnupg_addsignkey($res, $value2, '');
    }

    $arrtojson = json_encode($request, JSON_UNESCAPED_SLASHES);
    $recpt = array($recipient_fingerprint_1, $recipient_fingerprint_2);
    foreach ($recpt as $key => $value) {
        $info = gnupg_keyinfo($res, $value);
        if ($info['0']['expired'] == "") {
            $validkey[] = $value;
        }
    }

    foreach ($validkey as $kk => $vv) {
        gnupg_addencryptkey($res, $vv);
    }

    $enc = gnupg_encryptsign($res, $arrtojson);
    $response = base64_encode($enc);
    $b = preg_replace('/\+/', '-', $response);
    $response = preg_replace('/\//', '_', $b);
    return $response;
}
