<?php

require_once './responseJson.php';

class Validations
{

    private $path_upload;
    private $file_name;
    private $file_name_temp;
    private $xml;

    public function __construct($path_upload, $file_name, $file_name_temp)
    {
        $this->path_upload = $path_upload;
        $this->file_name = $file_name;
        $this->file_name_temp = $file_name_temp;
    }

    public function getFileName()
    {
        return $this->file_name;
    }

    public function getfileNameTemp()
    {
        return $this->file_name_temp;
    }

    public function getPathUpload()
    {
        return $this->path_upload;
    }
    
    public function getFileXml()
    {
        return $this->xml;
    }

    public function setFileXml()
    {
        $file = file_get_contents($this->path_upload);
        $this->xml =  new SimpleXMLElement($file);
    }

    public function verificationExtensionFile()
    {
        try {

            $extensao = pathinfo(self::getFileName(), PATHINFO_EXTENSION);
    
            if ($extensao != "xml") {
                ResponseAjaxJson::responseJson(array('status' => 'Invalid extension!'));
            }

        } catch (\Throwable $th) {
            
            unlink(self::getPathUpload());
            ResponseAjaxJson::responseJson(array('status' => $th));

        }
    }

    public function moveUploadedFile()
    {
        try {

            if (file_exists(self::getPathUpload())) {
                ResponseAjaxJson::responseJson(array('status' => 'File already exists!'));
            } 

            $move_upload_rs = move_uploaded_file(self::getfileNameTemp(), "../upload/" . self::getFileName());
    
            if (!$move_upload_rs) {
                ResponseAjaxJson::responseJson(array('status' => 'Sending fail!'));
            } else {
                self::setFileXml();
            }

        } catch (\Throwable $th) {
           
            unlink(self::getPathUpload());
            ResponseAjaxJson::responseJson(array('status' => $th));

        }
    }

    public function verificationEmitCNPJ()
    {
        try {

            self::isEmptyEmitCNPJ(self::getFileXml());
            self::isValidEmitCNPJ(self::getFileXml());

        } catch (\Throwable $th) {
           
            unlink(self::getPathUpload());
            ResponseAjaxJson::responseJson(array('status' => $th));

        }

    }

    public function verificationNPROT()
    {
        try {

            $return = self::getFileXml();
    
            if(empty($return->protNFe->infProt->nProt)){

                unlink(self::getPathUpload());
                ResponseAjaxJson::responseJson(array('status' => 'campo "nProt" invalid!'));

            }

        } catch (\Throwable $th) {
            
            unlink(self::getPathUpload());
            ResponseAjaxJson::responseJson(array('status' => $th));
            
        }
    }

    private function isEmptyEmitCNPJ($xml)
    {
        $emit_CNPJ = false;
    
        if ((!empty($xml->infNFe->emit->CNPJ)) && ($xml->infNFe->emit->CNPJ != "")){
            $emit_CNPJ = true;
        }

        if((!empty($xml->NFe->infNFe->emit->CNPJ)) && ($xml->NFe->infNFe->emit->CNPJ != "")){
            $emit_CNPJ = true;
        }

        if ($emit_CNPJ == false) {
            
            unlink(self::getPathUpload());
            ResponseAjaxJson::responseJson(array('status' => 'CNPJ emitter empty!'));

        }
    }

    private function isValidEmitCNPJ($xml)
    {
        $valid_CNPJ = false;

        if(!empty($xml->NFe->infNFe->emit->CNPJ) && ($xml->NFe->infNFe->emit->CNPJ == "09066241000884")){
            $valid_CNPJ = true;
        }
        if((!empty($xml->infNFe->emit->CNPJ)) && ($xml->infNFe->emit->CNPJ == "09066241000884")){
            $valid_CNPJ = true;
        }

        if ($valid_CNPJ == false) {
            unlink(self::getPathUpload());
            ResponseAjaxJson::responseJson(array('status' => 'CNPJ invalid!'));
        }
    }

    public function getNumberAndDateXml($xml)
    {
        try {

            $nNF = '';
            $dhEmi = '';
    
            if((!empty($xml->infNFe->ide->nNF) && ($xml->infNFe->ide->nNF != ""))){
                $nNF = $xml->infNFe->ide->nNF->__toString();
            }

            if(!empty($xml->NFe->infNFe->ide->nNF) && ($xml->NFe->infNFe->ide->nNF != "")){
                $nNF = $xml->NFe->infNFe->ide->nNF->__toString();
            }

            if((!empty($xml->infNFe->ide->dhEmi)) && ($xml->infNFe->ide->dhEmi != "")){
                $dhEmi = $xml->infNFe->ide->dhEmi->__toString();
            }

            if(!empty($xml->NFe->infNFe->ide->dhEmi) && ($xml->NFe->infNFe->ide->dhEmi != "")){
                $dhEmi = $xml->NFe->infNFe->ide->dhEmi->__toString();
            }

            return [$nNF, $dhEmi];

        } catch (\Throwable $th) {

            unlink(self::getPathUpload());
            ResponseAjaxJson::responseJson(array('status' => $th));
            
        }
    }

    public function deleteFile()
    {
        try {

            unlink(self::getPathUpload());

        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
