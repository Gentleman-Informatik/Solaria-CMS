<?php
namespace Solaria\Application\Forum\Controllers;

use Solaria\Application\Forum\BaseController;
use Solaria\Application\Models\Topic;
use Solaria\Application\Models\Post;

class TopicController extends BaseController {

    public function indexAction($id) {
        $topic = Topic::find($id);
        if($topic == null) {
            $this->di->get('SessionFlash')->error('The topic that you requested, does not longer exist');
            $this->response->redirect('forum');
        } else {
            $this->view->set('topic', $topic);
        }
    }

    public function createTopicAction() {
        if($this->request->isPost()) {
            $name = $this->request->getPost('topic_name');
            $nameCheck = Topic::findBy(array('name' => $name));
            if(count($nameCheck) == 0) {
                $topic = new Topic();
                $topic->setName($name);
                $newTopic = $topic->save($topic);
                $this->di->get('SessionFlash')->success('Topic <b>'.$name.'</b> successfully created :)');
                $this->response->redirect('forum/topic/'.$newTopic->getId());
            } else {
                $this->di->get('SessionFlash')->error('A topic with the name <b>' . $name . '</b> allready exists!');
                $this->response->redirect('forum');
            }
        } else {
            $this->response->redirect('forum');
        }
    }

}
