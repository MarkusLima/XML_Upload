<?php

require_once './validations.php';
require_once './responseJson.php';
require_once '../config/db.php';
require_once '../entity/nft.php';

header('Content-Type: application/json');

if (isset($_FILES['meu_arquivo']) && !empty($_FILES['meu_arquivo']['name'])) {

    $path_upload = "../upload/" . $_FILES['meu_arquivo']['name'];
    $file_name = $_FILES['meu_arquivo']['name'];
    $file_name_temp = $_FILES['meu_arquivo']['tmp_name'];

    $validations = new Validations($path_upload, $file_name, $file_name_temp);

    #verifica a extensao do arquivo
    $validations->verificationExtensionFile();

    /*Arquivo está sendo enviado para pasta UPLOAD */
    $validations->moveUploadedFile();

    #verifica o campo <emit><CNPJ>
    $validations->verificationEmitCNPJ();

    #verifica o campo <nProt> 
    $validations->verificationNPROT();

    #salva no banco 
    $nft = new NFT();
    $nft->add($validations);

} else {

    ResponseAjaxJson::responseJson(array('status' => 'Sending fail!'));

}
