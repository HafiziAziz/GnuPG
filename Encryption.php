<?php
    ob_start();
    header("Content-Type: application/octet-stream; charset=utf-8");
    $FIXPATH = ""; // Declare your Path
    require_once( $FIXPATH."inc/GnuPG.php" );

    // Dummy Data
    $request = "123456789";

    // Encryption
    $encrypt = encrypt($request);
    ob_end_clean();

    // Output 
    header('Content-Type: application/octet-stream');
    echo $encrypt;
    exit;