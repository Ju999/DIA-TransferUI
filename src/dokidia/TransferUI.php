<?php

namespace dokidia;

use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityLevelChangeEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\entity\Effect;

use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\item\Item;
use pocketmine\lang\BaseLang;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\block\Block;
use pocketmine\math\Vector3;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

use jojoe77777\FormAPI;

use dokidia\TransferUI; 

use onebone\economyapi\EconomyAPI;

class TransferUI extends PluginBase implements Listener {

    /** @var TransferUI $instance */
    private static $instance;
	
	public $plugin;

	public function onEnable() : void{
	    self::$instance = $this;
        $this->getLogger()->info(TextFormat::GREEN . "DIA-TransferUI 활성화 완료 - Made by 도끼다이아");

	}
	
	public static function getInstance() : self{
	    return self::$instance;
	}
 

       
    public function onCommand(CommandSender $o, Command $kmt, string $label, array $array) : bool{
        if($kmt->getName() == "서버이동"){
            $this->TransferUI($o);
        }
        return true;
    }
    
    // 튜토리얼 1페이지
    public function TransferUI($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                $address = "dia24.ze.am";
                $port = "19133";
                $message = "서버이동 - 1서버";

                $sender->transfer($address, $port, $message);
                break;

                case 1:
                    $address = "dia24.ze.am";
                    $port = "19131";
                    $message = "서버이동 - 2서버";
    
                    $sender->transfer($address, $port, $message);
                    break;
                        

                }
            });
            $name = $sender->getName();
            $form->setTitle("§l§c다이아 어시스턴트 | 서버 목록");
            $form->setContent("§f안녕하세요, {$name}님\n이동하실 서버를 선택해 주세요.\n§f");
            $form->addButton("§b§l>§c [§0점검중§c]§0 1서버 - 미니게임 §b<\n§7dia24.ze.am :: 19133",0,"textures/ui/arrow_active");
            $form->addButton("§b§l>§0 2서버 - 인생게임 §b<\n§7dia24.ze.am :: 19131",0,"textures/ui/arrow_active");
            $form->sendToPlayer($sender);
            return $form;
    }
    
   

}

?>
