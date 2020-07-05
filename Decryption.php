<?php
    ob_start();
    header("Content-Type: application/octet-stream; charset=utf-8");
    $FIXPATH = ""; // Declare your Path
    require_once( $FIXPATH."inc/GnuPG.php" );

    // Incoming
    $entityBody = file_get_contents('php://input');

    // Decyrption Function
    $request = decrypt($entityBody);
    $arr_req = json_decode($request);

    # Mapping Incoming
    // Write Code here

    ob_end_clean();
    header("Content-Type: application/json;");
    echo json_encode($arr_req);
    exit();
