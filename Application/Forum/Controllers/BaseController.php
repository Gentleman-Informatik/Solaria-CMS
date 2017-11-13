<?php
namespace Solaria\Application\Forum\Controllers;

use Solaria\Framework\Application\Mvc\BaseController as Base;

class BaseController extends Base {

    public function __construct() {
        parent::__construct();
        $this->view->set('user', $this->session->get('user'));
    }

}
