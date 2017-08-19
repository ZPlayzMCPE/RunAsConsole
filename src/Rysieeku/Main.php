<?php

namespace Rysieeku;

/*
*  Author: Rysieeku
*  Version: 1.1
*  API: 3.0.0-ALPHA6
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
    $this->getLogger()->info(TF::YELLOW."Loading...");
  }
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info(TF::GREEN."RunAsConsole by Rysieeku loaded!");
  }
  
  public function onDisable(){
    $this->getLogger()->info(TF::RED."RunAsConsole disabled!");
  }
  
  public function onCommand(CommandSender $sender, Command $command, $label, array $args){
    switch($command->getName()){
      case "console":
        if(!$sender instanceof Player){
          $sender->sendMessage("Use this command in-game!");
          return true;
        }
        else {
        if($sender->hasPermission("rac.use")){
          if(!(isset($args[0]))){
            $sender->sendMessage(TF::RED."Usage: /console <command>");
          return true;
          }
          $this->getServer()->dispatchCommand(new ConsoleCommandSender(), (implode(" ", $args)));
            $sender->sendMessage(TF::GREEN."Command has been run as console");
          return true;
        }
        else {
          $sender->sendMessage(TF::RED."You don't have permission to perform this command! (rac.use)");
          return true;
          }
        }
      }
    }
  }
