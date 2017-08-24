<?php
/**
*
* Base class for all plugins
*
* @author Flavio Kleiber <flaverkleiber@yahoo.de>
* @copyright 2016-2017 Flavio Kleiber
*/
namespace Solaria\Plugins;

use Solaria\Framework\Core\DiClass;

abstract class BasePlugin extends DiClass{

    abstract public function run();
}
