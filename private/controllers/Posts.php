<?php

class Posts extends Controller {
    private $postModel;

    public function __construct() {
        if(!isset($_SESSION['user_id'])){
            header('location: ' . URLROOT . '/users/login');
        }

        $this->postModel = $this->model('Post');
    }

    public function index() {
        // nahrání příspěvků
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];

        $this->view('posts', $data);
    }
}