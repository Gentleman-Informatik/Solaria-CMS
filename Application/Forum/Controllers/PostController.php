<?php
namespace Solaria\Application\Forum\Controllers;

use Solaria\Application\Forum\Controllers\BaseController;
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
            $nameCheck = Post::findBy(array('title' => $name, 'topic_id' => $topicId));
            if(count($nameCheck) == 0) {
                $post = new Post();
                $user = User::find($this->session->get('user')[0]->getId());//DIRTY HACK NEED TO BE CHANGED!
                $post->setTitle($name);
                $post->setContent($this->request->getPost('editor1'));
                $post->setUser($user);//@AS_TODO: Get this info from session
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

    public function answerPostAction() {
        if($this->request->isPost()) {
            $postId = $this->request->getPost('id');
            $oldPost = Post::find($postId);
            if($oldPost != null) {
                $post = new Post();
                $post->setTitle($oldPost->getTitle());
                $post->setContent($this->request->getPost('editor1'));
                $post->setUser(User::find(1));//@AS_TODO: Get this info from session
                $post->setTopic($oldPost->getTopic());
                $post->setResponse($oldPost);
                $post->save($post);
                $this->response->redirect('forum/post/'.$oldPost->getId());
            } else {
                $this->response->redirect('forum');
            }
        } else {
            $this->response->redirect('forum');
        }
    }

}
