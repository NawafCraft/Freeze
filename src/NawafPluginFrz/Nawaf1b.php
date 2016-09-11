<?php

namespace NawafPluginFrz;

class Nawaf1b extends \pocketmine\plugin\PluginBase implements \pocketmine\event\Listener{
    
    public $freeze = array();
    
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onCommand(\pocketmine\command\CommandSender $sender, \pocketmine\command\Command $command, $label, array $args) {
        if($command->getName() == "freeze"){
        //if($sender->isOp()){
           if($args[0] == "add"){
            if($args[1] == "@a"){
                foreach ($this->getServer()->getOnlinePlayers() as $p){
                    $this->freeze[strtolower($p->getName())] = strtolower($p->getName());
                }
                    $sender->sendMessage("All Players Freezing");
             }
             if($args[1] !== "@a"){
             $this->freeze[strtolower($args[1])] = strtolower($args[1]);
             $sender->sendMessage("Now ".$args[1]." Freezing");
             }
              
           }
           if($args[0] == "remove"){
            if($args[1] == "@a"){
                foreach ($this->getServer()->getOnlinePlayers() as $p){
                    unset($this->freeze[strtolower($p->getName())]);
                }
                $sender->sendMessage("All Players is not Freezing");
             }
             if($args[1] !== "@a"){
             unset($this->freeze[strtolower($args[1])]);
             $sender->sendMessage("Now ".$args[1]." is not Freezing");
             }
           }
        }
    }
    //}
    
    public function onMove(\pocketmine\event\player\PlayerMoveEvent $ev){
        
        if(in_array(strtolower($ev->getPlayer()->getName()), $this->freeze)){
            $ev->setCancelled();
            //$ev->getPlayer()->sendMessage("You Freezing");
        }
    }
}
?>
