<?php
#please edit here nothing!
namespace Eliah;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerJoinEvent;

class Healz extends PluginBase implements Listener {

  public $message;

  public function onEnable() {
    $this->getLogger()->info("§8[§cHealz§8] §f"."The plugin was loaded!");
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
    $this->saveResource("message.yml");
    $this->message = new Config($this->getDataFolder()."message.yml", Config::YAML);
    $this->saveDefaultConfig();
    $this->getLogger()->notice("§8[§cHealz§8] §f"."Plugin is made by Eliah.");
  }

  public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
    if($cmd == "heal") {

      $hself = $this->message->get("Heal_self");
      $hother = $this->message->get("Heal_other");
      $pic = $this->message->get("Player_isCreative");
      $sic = $this->message->get("Self_isCreative");
      $pnf = $this->message->get("Player_not_found");
      $pwh = $this->message->get("Player_was_healed");
      $np = $this->message->get("No_Permissions");
      $ri = $this->message->get("Run_Ingame");

      if (count($args) >= 1) {
        if($sender->hasPermission("healz.heal.other")) {
          $player = $this->getServer()->getPlayer($args[0]);
          if(!$player instanceof Player) {
            $sender->sendMessage("§8[§cHealz§8] §f".$pnf);
            return true;
          }
          if($player->isCreative()) {
            $sender->sendMessage("§8[§cHealz§8] §f".$pic);
            return true;
          }
        $player->setHealth($sender->getMaxHealth());
        $sender->sendMessage("§8[§cHealz§8] §f".$hother." ".$player->getName());
        $player->sendMessage("§8[§cHealz§8] §f".$pwh." ".$sender->getName());
      } else {
        $sender->sendMessage("§8[§cHealz§8] §f".$np);
      }
      } else {
        if($sender->hasPermission("healz.heal")) {
          if(!$sender instanceof Player) {
            $sender->sendMessage("§8[§cHealz§8] §f".$ri);
            return true;
          }
          if($sender->isCreative()) {
            $sender->sendMessage("§8[§cHealz§8] §f".$sic);
            return true;
          }
          $sender->setHealth($sender->getMaxHealth());
          $sender->sendMessage("§8[§cHealz§8] §f".$hself);
        } else {
          $sender->sendMessage("§8[§cHealz§8] §f".$np);
        }
      }
    }
    if($cmd == "feed") {

      $hself = $this->message->get("Feed_self");
      $hother = $this->message->get("Feed_other");
      $pic = $this->message->get("Player_isCreative");
      $sic = $this->message->get("Self_isCreative");
      $pnf = $this->message->get("Player_not_found");
      $pwh = $this->message->get("Player_was_feed");
      $np = $this->message->get("No_Permissions");
      $ri = $this->message->get("Run_Ingame");

      if (count($args) >= 1) {
        if($sender->hasPermission("healz.feed.other")) {
          $player = $this->getServer()->getPlayer($args[0]);
          if(!$player instanceof Player) {
            $sender->sendMessage("§8[§cHealz§8] §f".$pnf);
            return true;
          }
          if($player->isCreative()) {
            $sender->sendMessage("§8[§cHealz§8] §f".$pic);
            return true;
          }
        $player->setFood($sender->getMaxFood());
        $sender->sendMessage("§8[§cHealz§8] §f".$hother." ".$player->getName());
        $player->sendMessage("§8[§cHealz§8] §f".$pwh." ".$sender->getName());
      } else {
        $sender->sendMessage("§8[§cHealz§8] §f".$np);
      }
      } else {
        if($sender->hasPermission("healz.feed")) {
          if(!$sender instanceof Player) {
            $sender->sendMessage("§8[§cHealz§8] §f".$ri);
            return true;
          }
          if($sender->isCreative()) {
            $sender->sendMessage("§8[§cHealz§8] §f".$sic);
            return true;
          }
          $sender->setFood($sender->getMaxFood());
          $sender->sendMessage("§8[§cHealz§8] §f".$hself);
        } else {
          $sender->sendMessage("§8[§cHealz§8] §f".$np);
        }
      }
    }
    if($cmd == "healz") {
      $sender->sendMessage("----------+§8[§cHealz§8]§f+----------\n§2/heal §fHeal yourself or someone else.\n§2/feed §fFeed yourself or someone else.\n\nReport bugs to Discord!\n§9Discord: §fEliah#9443");
    }
    return true;
  }

  public function onJoin(PlayerJoinEvent $event) {
  $player = $event->getPlayer();
  if($player->isOp()) {
    $player->sendMessage("§8[§cHealz§8] §f"."Plugin made by Eliah. §9Discord: §fEliah#7620 §bTwitter: §f@EliahJs §7GitHub: §fEliah9443");
  }
}

  public function onDisable() {
    $d = $this->message->get("plugin_disable");
    $this->getLogger()->info("§8[§cHealz§8] §f".$d);
  }
}
