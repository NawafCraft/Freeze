<?php

namespace NawafPluginFrz;

class Freezing implements API{

    public function addFreeze($var,$name){
        return $var[$name] = $name;
    }
    
    public function removeFreeze($var,$name){
        unset($var[$name]);
    }
    
}
?>
