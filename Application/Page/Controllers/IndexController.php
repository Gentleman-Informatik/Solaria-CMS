<?php

namespace Solaria\Application\Page\Controllers;

use Solaria\Framework\Application\Mvc\BaseController;
use Solaria\Application\Page\Forms\TestForm;

class IndexController extends BaseController {

    public function indexAction() {
        //var_dump($this->rbac->isGranted('Guest', 'sol.dp.view.page'));die;
        $this->view->set('carousel', true);
        $this->view->set('user', $this->session->get('user'));
    }

}
