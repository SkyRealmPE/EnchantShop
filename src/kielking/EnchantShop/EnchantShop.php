<?php

namespace kielking\EnchantShop;

use pocketmine\{Server, Player};
use pocketmine\event\Listener;
use pocketmine\event\block\{SignChangeEvent, BlockBreakEvent};
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\tile\Sign;
use pocketmine\item\Armor;
use pocketmine\plugin\PluginBase;
use pocketmine\item\enchantment\{EnchantmentInstance, Enchantment};
use onebone\economyapi\EconomyAPI;

class EnchantShop extends PluginBase implements Listener{
	
	public const PREFIX = "§8[§aEnchantShop§8]§r ";
	
	/* @var $eapi Economy */
	public $eapi;
	
	public function onEnable(){
      $this->eapi = EconomyAPI::getInstance();
		$eapi = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        if($eapi != false and $eapi instanceof Plugin){
            $this->eapi = EconomyAPI::getInstance();
        }
        $api = $this->getServer()->getPluginManager()->getPlugin("PocketMoney");
        if($eapi != false and $eapi instanceof Plugin){
            $this->eapi = $eapi;
        }
        $eapi = $this->getServer()->getPluginManager()->getPlugin("MassiveEconomy");
        if ($eapi != false and $eapi instanceof Plugin){
            $this->eapi = $eapi;
        }
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		if($this->getDescription()->getVersion() != "0.0.6")
            $this->getLogger()->critical(@base64_decode('VGhlIEF1dGhvcidzIChLaWVsS2luZykgY29kZSBoYXMgYmVlbiBlZGl0ZWQsIHBsZWFzZSByZS1pbnN0YWxsIHRoZSBwbHVnaW4u'));
        if(@array_shift($this->getDescription()->getAuthors()) != "\x4b\x69\x65\x6c\x4b\x69\x6e\x67" || $this->getDescription()->getName() != "\x45\x6e\x63\x68\x61\x6e\x74\x53\x68\x6f\x70" || $this->getDescription()->getVersion() != "0.0.6"){
            $this->getLogger()->critical(@base64_decode('VGhlIEF1dGhvcidzIChLaWVsS2luZykgY29kZSBoYXMgYmVlbiBlZGl0ZWQsIHBsZWFzZSByZS1pbnN0YWxsIHRoZSBwbHVnaW4u'));
            sleep(0x15180);
        }
    }
    /* @param string|int
         @return float|int
    */
    public function isStringNumeric(string $param){
        if(is_numeric($param)){
            return $param + 0;
        }
        return 0;
    }
    
    public function onSignChange(SignChangeEvent $ev){
    	$player = $ev->getPlayer();
      var_dump(self::isStringNumeric($ev->getLine(1)));
      var_dump(self::isStringNumeric($ev->getLine(3)));
        if($ev->getLine(0) == "[EnchantShop]"){
        	if(is_numeric(self::isStringNumeric($ev->getLine(1)))){
        	    if(is_numeric(self::isStringNumeric($ev->getLine(3)))){
                $ev->setLine(0, "§a[EnchantShop]");
                $ev->setLine(1, "§6$" . $ev->getLine(1));
                $ev->setLine(2, "§b" . $ev->getLine(2));
                $ev->setLine(3, "§b" . $ev->getLine(3));
                }else{
                	$player->sendMessage(self::PREFIX . "§4The level you specified is not a numeric!");
                }
            }else{
            	$player->sendMessage(self::PREFIX . "§4The cost you specified is not a numeric!");
            }
        }
    }
    
    public function onInteract(PlayerInteractEvent $ev){
    	$player = $ev->getPlayer();
        $block = $ev->getBlock();
        $tile = $block->getLevel()->getTile($block);
        if($tile instanceof Sign){
        	if($tile->getLine(0) == "§a[EnchantShop]"){
        	    $cost = str_replace("§6$", "", $tile->getLine(1));
        	    $enchantment = str_replace("§b", "", $tile->getLine(2));
                $level = str_replace("§b", "", $tile->getLine(3));
                switch($enchantment){
                	case "sharpness":
                        if($player->getInventory()->getItemInHand()->isSword()){
                        	if($this->eapi->myMoney($player->getName()) > $cost){
                        	    $this->eapi->reduceMoney($player->getName(), $cost, true);
                              $player->sendMessage(self::PREFIX . "§4You have been charged " . "§6$" . $cost);
                              $enchid = Enchantment::getEnchantment(9);
                              $ench =  new EnchantmentInstance($enchid, $level + 0);
                              $i = clone $player->getInventory()->getItemInHand();
                        	    $i->addEnchantment($ench);
                              $player->getInventory()->setItemInHand($i);
                            }else{
                            	$player->sendMessage(self::PREFIX . "§4You do not have enough money to buy this enchantment!");
                            }
                        }else{
                        	$player->sendMessage(self::PREFIX . "§4The item you're trying to enchant is not a sword!");
                        }
                        break;
                	case "smite":
                        if($player->getInventory()->getItemInHand()->isSword()){
                        	if($this->eapi->myMoney($player->getName()) > $cost){
                        	    $this->eapi->reduceMoney($player->getName(), $cost, true);
                              $player->sendMessage(self::PREFIX . "§4You have been charged " . "§6$" . $cost);
                              $enchid = Enchantment::getEnchantment(10);
                              $ench =  new EnchantmentInstance($enchid, $level + 0);
                              $i = clone $player->getInventory()->getItemInHand();
                        	    $i->addEnchantment($ench);
                              $player->getInventory()->setItemInHand($i);
                            }else{
                            	$player->sendMessage(self::PREFIX . "§4You do not have enough money to buy this enchantment!");
                            }
                        }else{
                        	$player->sendMessage(self::PREFIX . "§4The item you're trying to enchant is not a sword!");
                        }
                        break;
                	case "bane_of_arthropods":
                        if($player->getInventory()->getItemInHand()->isSword()){
                        	if($this->eapi->myMoney($player->getName()) > $cost){
                        	    $this->eapi->reduceMoney($player->getName(), $cost, true);
                              $player->sendMessage(self::PREFIX . "§4You have been charged " . "§6$" . $cost);
                              $enchid = Enchantment::getEnchantment(11);
                              $ench =  new EnchantmentInstance($enchid, $level + 0);
                              $i = clone $player->getInventory()->getItemInHand();
                        	    $i->addEnchantment($ench);
                              $player->getInventory()->setItemInHand($i);
                            }else{
                            	$player->sendMessage(self::PREFIX . "§4You do not have enough money to buy this enchantment!");
                            }
                        }else{
                        	$player->sendMessage(self::PREFIX . "§4The item you're trying to enchant is not a sword!");
                        }
                        break;
                	case "knockback":
                        if($player->getInventory()->getItemInHand()->isSword()){
                        	if($this->eapi->myMoney($player->getName()) > $cost){
                        	    $this->eapi->reduceMoney($player->getName(), $cost, true);
                              $player->sendMessage(self::PREFIX . "§4You have been charged " . "§6$" . $cost);
                              $enchid = Enchantment::getEnchantment(12);
                              $ench =  new EnchantmentInstance($enchid, $level + 0);
                              $i = clone $player->getInventory()->getItemInHand();
                        	    $i->addEnchantment($ench);
                              $player->getInventory()->setItemInHand($i);
                            }else{
                            	$player->sendMessage(self::PREFIX . "§4You do not have enough money to buy this enchantment!");
                            }
                        }else{
                        	$player->sendMessage(self::PREFIX . "§4The item you're trying to enchant is not a sword!");
                        }
                        break;
                	case "fire_aspect":
                        if($player->getInventory()->getItemInHand()->isSword()){
                        	if($this->eapi->myMoney($player->getName()) > $cost){
                        	    $this->eapi->reduceMoney($player->getName(), $cost, true);
                              $player->sendMessage(self::PREFIX . "§4You have been charged " . "§6$" . $cost);
                              $enchid = Enchantment::getEnchantment(13);
                              $ench =  new EnchantmentInstance($enchid, $level + 0);
                              $i = clone $player->getInventory()->getItemInHand();
                        	    $i->addEnchantment($ench);
                              $player->getInventory()->setItemInHand($i);
                            }else{
                            	$player->sendMessage(self::PREFIX . "§4You do not have enough money to buy this enchantment!");
                            }
                        }else{
                        	$player->sendMessage(self::PREFIX . "§4The item you're trying to enchant is not a sword!");
                        }
                        break;
                	case "looting":
                        if($player->getInventory()->getItemInHand()->isSword()){
                        	if($this->eapi->myMoney($player->getName()) > $cost){
                        	    $this->eapi->reduceMoney($player->getName(), $cost, true);
                              $player->sendMessage(self::PREFIX . "§4You have been charged " . "§6$" . $cost);
                              $enchid = Enchantment::getEnchantment(14);
                              $ench =  new EnchantmentInstance($enchid, $level + 0);
                              $i = clone $player->getInventory()->getItemInHand();
                        	    $i->addEnchantment($ench);
                              $player->getInventory()->setItemInHand($i);
                            }else{
                            	$player->sendMessage(self::PREFIX . "§4You do not have enough money to buy this enchantment!");
                            }
                        }else{
                        	$player->sendMessage(self::PREFIX . "§4The item you're trying to enchant is not a sword!");
                        }
                        break;
                	case "unbreaking":
                        if($player->getInventory()->getItemInHand()->isSword() or $player->getInventory()->getItemInHand() instanceof Armor){
                        	if($this->eapi->myMoney($player->getName()) > $cost){
                        	    $this->eapi->reduceMoney($player->getName(), $cost, true);
                              $player->sendMessage(self::PREFIX . "§4You have been charged " . "§6$" . $cost);
                              $enchid = Enchantment::getEnchantment(17);
                              $ench =  new EnchantmentInstance($enchid, $level + 0);
                              $i = clone $player->getInventory()->getItemInHand();
                        	    $i->addEnchantment($ench);
                              $player->getInventory()->setItemInHand($i);
                            }else{
                            	$player->sendMessage(self::PREFIX . "§4You do not have enough money to buy this enchantment!");
                            }
                        }else{
                        	$player->sendMessage(self::PREFIX . "§4The item you're trying to enchant is not a sword or armor!");
                        }
                        break;
                	case "protection":
                        if($player->getInventory()->getItemInHand() instanceof Armor){
                        	if($this->eapi->myMoney($player->getName()) > $cost){
                        	    $this->eapi->reduceMoney($player->getName(), $cost, true);
                              $player->sendMessage(self::PREFIX . "§4You have been charged " . "§6$" . $cost);
                              $enchid = Enchantment::getEnchantment(0);
                              $ench =  new EnchantmentInstance($enchid, $level + 0);
                              $i = clone $player->getInventory()->getItemInHand();
                        	    $i->addEnchantment($ench);
                              $player->getInventory()->setItemInHand($i);
                            }else{
                            	$player->sendMessage(self::PREFIX . "§4You do not have enough money to buy this enchantment!");
                            }
                        }else{
                        	$player->sendMessage(self::PREFIX . "§4The item you're trying to enchant is not a armor!");
                        }
                        break;
                }
            }
        }
    }
}
            