<?php

namespace NawafPluginFrz;

class Freezing implements API{

    public $freeze;

    public function __construct($freezing) {
        $this->freeze = $freezing;
    }
    
    public function addFreeze($name){
        return $this->freeze[$name] = $name;
    }
    
    public function removeFreeze($name){
        unset($this->freeze[$name]);
    }
    
}
?>
