<?php
namespace Solaria\Application\Forum\Controllers;

use Solaria\Framework\Application\Mvc\BaseController;
use Solaria\Application\Models\Post;

class PostController extends BaseController {

    public function indexAction($id) {
        var_dump(Post::getLatestPost());
        $post = Post::find($id);
        if($post == null) {
            $this->di->get('SessionFlash')->error('The post that you requested, does not longer exist');
            $this->response->redirect('forum');
        } else {
            $this->view->set('post', $post);
        }
    }

}
