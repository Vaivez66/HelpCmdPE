<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 05/03/2016
 * Time: 14:22
 */
namespace Vaivez66\HelpCmdPE;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as TF;

class HelpCmd extends PluginBase{

    public $cfg;

    public function onEnable(){
        $this->saveDefaultConfig();
        $this->getServer()->getLogger()->info(TF::GREEN . 'HelpCmdPE is ready!');
        $this->getServer()->getPluginManager()->registerEvents(new HelpCmdListener($this), $this);
        $this->cfg = new Config($this->getDataFolder() . 'config.yml', Config::YAML, array());
    }

    /**
     * @return HelpCmdFormat
     */

    public function getFormat(){
        return new HelpCmdFormat($this);
    }

    /**
     * @param $number
     * @return array
     */

    public function getPage($number){
        $i = (array) $this->cfg->get('page');
        return (array) $i[$number];
    }

    /**
     * @return array
     */

    public function getDefaultPage(){
        return (array) $this->getPage($this->cfg->get('default.page'));
    }

    /**
     * @param $number
     * @return bool
     */

    public function isExistPage($number){
        return array_key_exists($number, $this->cfg->get('page'));
    }

    /**
     * @return mixed
     */

    public function pageNotFound(){
        return $this->cfg->get('page.not.found');
    }

}