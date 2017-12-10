<?php
namespace Rysieeku\RunAsConsole;

/*
*  Author: Rysieeku
*  Version: 1.4-B1
*  API: 3.0.0-ALPHA10
*/

use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\command\SimpleCommandMap;
use pocketmine\event\Listener;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;

class Main extends PluginBase implements Listener{
  
  public function onEnable(){
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->getLogger()->info(TF::BOLD.TF::GREEN."RunAsConsole".TF::RESET.TF::YELLOW." by Rysieeku loaded!");
  }
  
  public function onDisable(){
    $this->getLogger()->info(TF::BOLD.TF::GREEN."RunAsConsole".TF::RESET.TF::RED." disabled!");
  }
  
  public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
    switch($command->getName()){
      case "console":
        if(!$sender instanceof Player){
          $sender->sendMessage("Use this command in-game!");
          return true;
        }
        else {
          if($sender->hasPermission("runasconsole.use") || $sender->hasPermission("runasconsole.*") || $sender->isOp()){
            if(!(isset($args[0]))){
              $sender->sendMessage(TF::GRAY."[".TF::YELLOW."RAC".TF::GRAY."]".TF::RED." Usage: ".TF::YELLOW."/console <command>".TF::RED."!");
              return true;
            }
              if($this->getServer()->getCommandMap()->getCommand(strtolower($args[0])) instanceof Command) {
                $this->getServer()->dispatchCommand(new ConsoleCommandSender(), (implode(" ", $args)));
                $sender->sendMessage(TF::GRAY."[".TF::YELLOW."RAC".TF::GRAY."]".TF::GRAY." Command has been executed as console!");
                return true;
              }
              else {
                $sender->sendMessage(TF::GRAY."[".TF::YELLOW."RAC".TF::GRAY."]".TF::RED." Command does not exist!");
                return true;
              }
        }
        else {
          $sender->sendMessage(TF::GRAY."[".TF::YELLOW."RAC".TF::GRAY."]".TF::RED." You don't have permission to perform this command!");
          return true;
        }
      }
      break;
      case "runasconsole":
        if($sender->hasPermission("runasconsole.info") || $sender->hasPermission("runasconsole.*") || $sender->isOp()){
          $sender->sendMessage(TF::GRAY."You are using ".TF::YELLOW."RunAsConsole ".$this->getDescription()->getVersion().TF::GRAY." developed by ".TF::YELLOW."Rysieeku".TF::GRAY."!");
          return true;
        }
        else {
          $sender->sendMessage(TF::GRAY."[".TF::YELLOW."RAC".TF::GRAY."]".TF::RED." You don't have permission to perform this command!");
          return true;
        }
      }
    }
  }
