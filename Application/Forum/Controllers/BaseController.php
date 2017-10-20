<?php
namespace Solaria\Application\Forum\Controllers;

use Solaria\Framework\Application\Mvc\BaseController;

class BaseController extends BaseController {

    public function __construct() {
        parent::__construct();
        $this->view->set('user', $this->session->get('user'));
    }

}
