<?php

namespace Rysieeku;

/*
*  Author: Rysieeku
*  Version: 1.0
*/

use pocketmine\utils\TextFormat as TF;
use pocketmine\command\CommandExecutor;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\event\Listener;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\permission\ServerOperator;
use pocketmine\event\player\PlayerCommandPreprocessEvent;

class Main extends PluginBase implements Listener{

  public function onLoad(){
    $this->getLogger()->info(TF::YELLOW."Loading RAC by Rysieeku!");
  }
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info(TF::GREEN."RAC by Rysieeku loaded!");
  }
  
  public function onDisable(){
    $this->getLogger()->info(TF::RED."RAC by Rysieeku disabled!");
  }
  
  public function onCommand(CommandSender $sender, Command $command, $label, array $args){
    switch($command->getName()){
      case "console":
        if($sender->hasPermission("rac.use")){
          if(!(isset($args[0]))){
            $sender->sendMessage(TF::RED."Usage: /console <command>");
          return false;
          }
          $this->getServer()->dispatchCommand(new ConsoleCommandSender(), (implode(" ", $args)));
            $sender->sendMessage(TF::GREEN."Command has been run as console");
          return false;
        }
        else {
          $sender->sendMessage(TF::RED.$this->getPermissionMessage());
          }
        }
      }
    }
