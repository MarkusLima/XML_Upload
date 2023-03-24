<?php

require_once '../config/db.php';
require_once '../function/debug.php';
require_once '../function/validations.php';

class NFT
{

    private $db;
    private $db_table;

    public function __construct()
    {
        $this->db = new Database();
        $this->db_table = "nft";
        date_default_timezone_set('America/Sao_Paulo');
    }

    public function find(string $params)
    {
        try {

            $params = [
                ':id' => $params
            ];
    
            return $this->db->read("SELECT * FROM $this->db_table WHERE id = :id", $params);

        } catch (\Throwable $th) {
           
            ResponseAjaxJson::responseJson(array('msg' => $th));
            
        }
    }

    public function all()
    {
        try {

            $result['body'] = $this->db->read("SELECT * FROM $this->db_table");
            $result['msg'] = 'success';

            ResponseAjaxJson::responseJson($result);

        } catch (\Throwable $th) {
           
            ResponseAjaxJson::responseJson(array('msg' => $th));

        }
    }

    public function add($validations)
    {
        try {

            list($nNF, $dhEmi) = $validations->getNumberAndDateXml($validations->getFileXml());

            $insert = "INSERT INTO $this->db_table VALUES(0, :path_nf, :file_name, :number_nf, :date_emiter, :created_at)";
            $read = "SELECT * FROM $this->db_table WHERE path_nf = :path_nf AND number_nf = :number_nf";

            $parameter_read = [
                ':path_nf' => $validations->getPathUpload(),
                ':number_nf' => trim($nNF)
            ];

            $parameter_insert = [
                ':path_nf' => $validations->getPathUpload(),
                ':file_name' => $validations->getFileName(),
                ':number_nf' => trim($nNF),
                ':date_emiter' => trim($dhEmi),
                ':created_at' => date('Y-m-d H:i:s')
            ];

            $result = $this->db->read($read, $parameter_read);

            if (!empty($result)) {

                ResponseAjaxJson::responseJson(array('status' => 'Register already exists'));

            } else {

                $this->db->create($insert, $parameter_insert);
                ResponseAjaxJson::responseJson(array('status' => 'File successfully uploaded'));

            }

        } catch (\Throwable $th) {

            ResponseAjaxJson::responseJson(array('msg' => $th));

        }
    }

    public function delete(string $params)
    {
        try {

            $param = [
                ':id' => $params
            ];
    
            $this->db->delete("DELETE FROM $this->db_table WHERE id = :id", $param);

        } catch (\Throwable $th) {

        }
    }

}