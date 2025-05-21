<?php

namespace AnaliticsCommons;


class AnaliticsData{
    private function __clone() {}
    private function __construct() {}

    static function dump($obj){
        echo "<pre>";
        print_r($obj);
        echo "</pre>";
        exit;
    }
}