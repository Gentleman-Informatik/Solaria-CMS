<?php
namespace Solaria\Application\Acp\Controllers;

use Solaria\Framework\Application\Mvc\BaseController;

use Solaria\Application\Models\User;
use Solaria\Plugins\SteamAPI\SteamAPI;

class UserController extends BaseController {

    public function singUpAction() {
        $steam = new SteamAPI();
        $steam->run();
    }

}
