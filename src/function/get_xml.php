<?php

require_once './validations.php';
require_once './responseJson.php';
require_once '../config/db.php';
require_once '../entity/nft.php';

header('Content-Type: application/json');

try {

    $nft = new NFT();
    $nft->all();

} catch (\Throwable $th) {
    //throw $th;
}


