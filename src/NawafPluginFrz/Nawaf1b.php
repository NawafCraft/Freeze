<?php

namespace NawafPluginFrz;

class Nawaf1b extends \pocketmine\plugin\PluginBase implements \pocketmine\event\Listener{
    
    public $freeze = array();

    public $name = "";
    
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function getClass(){
        return new Freezing($this->freeze);
    }
    
    public function onCommand(\pocketmine\command\CommandSender $sender, \pocketmine\command\Command $command, $label, array $args) {
        if($command->getName() == "freeze"){
           if($args[0] == "add"){
            if($args[1] == "@a"){
                foreach ($this->getServer()->getOnlinePlayers() as $p){
                    $this->getClass()->addFreeze($p->getName());
                    $this->name = $p->getName();
                }
             }
             
             if($args[1] == "name"){
             $this->getClass()->addFreeze($args[2]);
             $this->name = $args[2];
              }
           }
           if($args[0] == "remove"){
            if($args[1] == "@a"){
                foreach ($this->getServer()->getOnlinePlayers() as $p){
                    $this->getClass()->removeFreeze($p->getName());
                }
             }
             
             if($args[1] == "name"){
             $this->getClass()->removeFreeze($args[2]);
              }
           }
        }
    }
    
    public function onMove(\pocketmine\event\player\PlayerMoveEvent $ev){
        
        if(in_array($this->name, $this->freeze)){
            $ev->setCancelled();
            $ev->getPlayer()->getLevel()->addParticle(new \pocketmine\level\particle\DestroyBlockParticle($ev->getPlayer(), \pocketmine\block\Block::get(97)));
        }
    }
}

?>
