<?php

namespace NawafPluginFrz;

class Nawaf1b extends \pocketmine\plugin\PluginBase implements \pocketmine\event\Listener{
    
    public $freeze = array();
    
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function getClass(){
        return new Freezing();
    }
    
    public function onCommand(\pocketmine\command\CommandSender $sender, \pocketmine\command\Command $command, $label, array $args) {
        if($command->getName() == "freeze"){
           if($args[0] == "add"){
            if($args[1] == "@a"){
                foreach ($this->getServer()->getOnlinePlayers() as $p){
                    $this->getClass()->addFreeze($this->freeze,$p->getName());
                }
                    $sender->sendMessage("All Players Freezing");
             }
             if($args[1] !== "@a"){
             $this->getClass()->addFreeze($this->freeze,$args[1]);
             $sender->sendMessage("Now ".$args[1]." Freezing");
             }
              
           }
           if($args[0] == "remove"){
            if($args[1] == "@a"){
                foreach ($this->getServer()->getOnlinePlayers() as $p){
                    $this->getClass()->removeFreeze($this->freeze,$p->getName());
                }
                $sender->sendMessage("All Players is not Freezing");
             }
             if($args[1] !== "@a"){
             $this->getClass()->removeFreeze($this->freeze,$args[1]);
             $sender->sendMessage("Now ".$args[1]." is not Freezing");
             }
           }
        }
    }
    
    public function onMove(\pocketmine\event\player\PlayerMoveEvent $ev){
        
        if(in_array($ev->getPlayer()->getName(), $this->getClass()->freeze)){
            $ev->setCancelled();
            $ev->getPlayer()->getLevel()->addParticle(new \pocketmine\level\particle\DestroyBlockParticle($ev->getPlayer(), \pocketmine\block\Block::get(97)));
        }
    }
}
?>
