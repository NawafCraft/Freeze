<?php

namespace NawafPluginFrz;

class Freezing implements API{

    public $freeze = array();
    
    public function addFreeze($name){
        return $this->freeze[$name] = $name;
    }
    
    public function removeFreeze($name){
        unset($this->freeze[$name]);
    }
    
}
?>
