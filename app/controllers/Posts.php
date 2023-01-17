<?php

class Posts extends Controller
{
    private $postModel ;
    private $userModel ;

    public function __construct()
    {
        if (!isLoggedIn()) {
            header('location:' . URLROOT . '/users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }
    public function index()
    {
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }



    // add a posts
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];
            // validate title 
            if (empty($data['title'])) {
                $data['title_err'] = 'please enter title';
            }
            // validate body 
            if (empty($data['body'])) {
                $data['body_err'] = 'please enter body text';
            }
            // if errors not existe
            if (empty($data['title_err']) && empty($data['body_err'])) {
                if ($this->postModel->addPost($data)) {
                    flash('post_added', 'Post Added', 'alert alert-success');
                    header('location:' . URLROOT . '/Posts/index');
                } else {
                    die('something went wrong');
                }
            } else {
                // load view with errors
                $this->view('posts/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'body' => '',
            ];
            $this->view('posts/add', $data);
        }
    }
    public function show($id){
        $post = $this->postModel->getPostById($id); 
        $user = $this->userModel->getUserById($post->id_user);

        $data = [
           'post' => $post ,
           'user' => $user
        ];
        $this->view('Posts/show', $data);

    }


    // add a post 
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $post = $this->postModel->getPostById($id);
            $data = [
                'id' => $id ,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];
            // validate title 
            if (empty($data['title'])) {
                $data['title_err'] = 'please enter title';
            }
            // validate body 
            if (empty($data['body'])) {
                $data['body_err'] = 'please enter body text';
            }
            // if errors not existe
            if (empty($data['title_err']) && empty($data['body_err'])) {
                if ($this->postModel->updatePost($data)) {
                    header('location:' . URLROOT . '/posts');
                    flash('post_edit','post edited','alert alert-success');
                } else {
                    die('something went wrong');
                }
            } else {
                // load view with errors
                $this->view('posts/edit ', $data);
            }
        } else {

            $post = $this->postModel->getPostById($id);
            if($post->id_user != $_SESSION['user_id']){
                header('location:' . URLROOT . '/posts');
            }
            // check for the user 
            $data = [
                'id' => $post->id_posts,
                'title' => $post->title,
                'body' => $post->body,
            ];
            $this->view('posts/edit', $data);
        }
    }
    

    // delete a post
    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->postModel->deletePost($id)){
                flash('post_delete','post deleted','alert alert-danger');
                header('location:' . URLROOT . '/posts');
            }
        }else{
            header('location:' . URLROOT . '/posts');
        }
    }
    
}
