<?php
namespace Solaria\Application\Forum\Controllers;

use Solaria\Framework\Application\Mvc\BaseController;
use Solaria\Application\Models\Topic;

class IndexController extends BaseController {

    public function indexAction() {
        $topic = Topic::findActiveTopic();
        $this->view->set('topic', $topic);
    }

}
