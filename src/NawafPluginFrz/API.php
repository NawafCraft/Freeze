<?php

namespace NawafPluginFrz;

interface API{
    
    public function addFreeze($var,$name);
    
    public function removeFreeze($var,$name);
    
}
?>
