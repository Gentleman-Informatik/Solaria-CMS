<?php
namespace Solaria\Application\Acp\Controllers;

use Solaria\Framework\Application\Mvc\BaseController;

use Solaria\Application\Models\User;
use Solaria\Plugins\SteamAPI\SteamAPI;
use Solaria\Application\Acp\Forms\SingUpForm;

class UserController extends BaseController {

    public function singUpAction() {
        $steam = new SteamAPI();
        $steam->run();
        $this->view->set('register_form', new SingUpForm());
    }

}
