<?php

class Debug
{

    static public function dd($params, $stop = false)
    {
        echo '<pre style="color:#fff; background-color:#000">';
        echo print_r($params);
        echo '</pre>';

        if ($stop) {
            die;
        }
    }

}