<?php
namespace Solaria\Application\Forum\Controllers;

use Solaria\Framework\Application\Mvc\BaseController;
use Solaria\Application\Models\Post;
use Solaria\Application\Models\User;
use Solaria\Application\Models\Topic;

class PostController extends BaseController {

    public function indexAction($id) {
        $post = Post::find($id);
        if($post == null) {
            $this->di->get('SessionFlash')->error('The post that you requested, does not longer exist');
            $this->response->redirect('forum');
        } else {
            $this->view->set('post', $post);
        }
    }

    public function createPostAction() {
        if($this->request->isPost()) {
            $name = $this->request->getPost('post_title');
            $topicId = $this->request->getPost('id');
            $nameCheck = Post::findBy(array('title' => $name));
            if(count($nameCheck) == 0) {
                $post = new Post();
                $post->setTitle($name);
                $post->setContent($this->request->getPost('editor1'));
                $post->setUser(User::find(1));//@AS_TODO: Get this info from session
                $post->setTopic(Topic::find($topicId));
                $newPost = $post->save($post);
                $this->di->get('SessionFlash')->success('Post <b>'.$name.'</b> successfully created :)');
                $this->response->redirect('forum/post/'.$newPost->getId());
            } else {
                $this->di->get('SessionFlash')->error('A post with the name <b>' . $name . '</b> allready exists!');
                $this->response->redirect('forum/topic/'.$topicId);
            }
        } else {
            $this->response->redirect('forum');
        }
    }

}
