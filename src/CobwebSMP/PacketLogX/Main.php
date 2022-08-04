<?php

declare(strict_types=1);

namespace CobwebSMP\PacketLogX;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\utils\Terminal;

class Main extends PluginBase implements Listener{
       public function onEnable(){
           $this->saveDefaultConfig();
           $this->getServer()->getPluginManager()->registerEvents($this, $this);
           file_put_contents($this->getDataFolder()."\log.log", "====================New session [".date('Y/m/d') ."] [".date('H:i:s') ."] UTC=====================\n",  FILE_APPEND);
       }

       public function onSend(DataPacketSendEvent $event){
           $p = $event->getPacket()->getName();
		   file_put_contents($this->getDataFolder()."\log.log", "[".date('H:i:s') ."] S server==>client " .$p. "\n", FILE_APPEND);
		   echo Terminal::$COLOR_AQUA."[".date('H:i:s') ."] ".Terminal::$COLOR_GREEN."server==>client " .Terminal::$COLOR_WHITE. $p. "\n";
       }

       public function onReceive(DataPacketReceiveEvent $event){
           $p = $event->getPacket()->getName();
		   file_put_contents($this->getDataFolder()."\log.log", "[".date('H:i:s') ."] R server<==client " .$p. "\n", FILE_APPEND);
		   echo Terminal::$COLOR_AQUA. "[".date('H:i:s') ."] ".Terminal::$COLOR_YELLOW."server<==client " .Terminal::$COLOR_WHITE. $p. "\n";
       }

}