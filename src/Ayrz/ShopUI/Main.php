<?php

namespace Ayrz\ShopUI;

use pocketmine\Player;
use pocketmine\Server;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;

use pocketmine\item\Item;
use pocketmine\item\ItemFactory;

use onebone\economyapi\EconomyAPI;

use FormAPI\{CustomForm, SimpleForm};

class Main extends PluginBase implements Listener {
    
        public function onEnable(){
            $this->getLogger()->info("§8» §aShopier!");
            $this->getServer()->getPluginManager()->registerEvents($this, $this);
        }

    public function onCommand(CommandSender $p, Command $cmd, string $label, array $args): bool{
    switch ($cmd->getName()) {
        case "shop":
            $this->Form1($p);
        break;
    }
    return true;
}
	public function Form1($p){
		$form = new SimpleForm(function (Player $p, $data = null){
			$re = $data;
			if($re != null){
			}
			switch($re){       
				case 0: 
				    $this->ShopForm1($p);                  
                break;
			}
        });
        $swname = "SunucuAdı";
		$form->setTitle($swname);
		$form->addButton("Bloklar");    
		$form->sendToPlayer($p);
	}

	public function ShopForm1($p){
		$form = new SimpleForm(function (Player $p, $data = null){
			$re = $data;
			if($re != null){
			}
			switch($re){       
				case 0: 
				    $this->ShopForm2($p);                  
				break;
			}
        });
        $swname = "SunucuAdı";
		$form->setTitle($swname);
		$form->addButton("Çimen");
		$form->sendToPlayer($p);
	}



public function ShopForm2(Player $p){
    if ($p instanceof Player) {
        $form = new CustomForm(function (Player $p, $data) {
            $result = $data;
            if ($result == null) {
                return true;
            }     
            if ($result[1] == null) {
                $this->ShopForm2($p);                  
                return true;
            }    
            $fiyat = $data[1] * 5;
            if(EconomyAPI::getInstance()->myMoney($p) >= $fiyat){
                EconomyAPI::getInstance()->reduceMoney($p, $fiyat);
                $p->getInventory()->addItem(Item::get((int) 2, (int) 0, (int) $result[1]));
            }else{
                $p->sendMessage("§cYeterince paran yok");
            }
        });
        $swname = "SunucuAdı";
		$form->setTitle($swname);
        $form->addLabel("Yazı Yazabilirsin");
        $form->addInput("Miktar yaz");
        $form->sendToPlayer($p);
    } 
}



}

?>
