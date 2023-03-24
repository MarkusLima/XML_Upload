<?php

require_once './validations.php';
require_once './responseJson.php';
require_once '../config/db.php';
require_once '../entity/nft.php';

header('Content-Type: application/json');

if (isset($_POST['id']) && !empty($_POST['id'])) {

    $id = $_POST['id'];

    $nft = new NFT();
    $xml_db = $nft->find($id);

    $validations = new Validations($xml_db[0]->path_nf, $xml_db[0]->file_name, $xml_db[0]->file_name);
    $validations->setFileXml();

    $xml = $validations->getFileXml();

    ResponseAjaxJson::responseJson(array('content' => $xml));

} else {

    ResponseAjaxJson::responseJson(array('status' => 'Not Found!'));

}
