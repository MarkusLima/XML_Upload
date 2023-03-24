<?php

class ResponseAjaxJson
{

    static public function responseJson(array $array)
    {
        echo json_encode($array);
        die();
    }
}
