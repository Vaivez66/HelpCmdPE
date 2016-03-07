<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 05/03/2016
 * Time: 14:29
 */
namespace Vaivez66\HelpCmdPE;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\utils\TextFormat as TF;

class HelpCmdListener implements Listener{

    public function __construct(HelpCmd $plugin){
        $this->plugin = $plugin;
    }

    public function onCmd(PlayerCommandPreprocessEvent $event){
        $p = $event->getPlayer();
        $args = explode(' ', $event->getMessage());
        if(strtolower($args[0]) == ('/help' || '/?')){
            if($p->hasPermission('help.cmd.pe')) {
                $event->setCancelled(true);
                if (isset($args[1])) {
                    if ($this->plugin->isExistPage($args[1])) {
                        $page = str_replace('{player}', $p->getName(), implode("\n", $this->plugin->getPage($args[1])));
                        $p->sendMessage($this->plugin->getFormat()->translate($page));
                    }
                    else {
                        $notFound = str_replace('{player}', $p->getName(), $this->plugin->pageNotFound());
                        $p->sendMessage($this->plugin->getFormat()->translate($notFound));
                    }
                }
                else {
                    $page = str_replace('{player}', $p->getName(), implode("\n", $this->plugin->getDefaultPage()));
                    $p->sendMessage($this->plugin->getFormat()->translate($page));
                }
            }
        }
    }

}