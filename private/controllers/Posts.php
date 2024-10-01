<?php

class Posts extends Controller
{
    private $postModel;

    public function __construct()
    {
        if (!isset($_SESSION['user_id'])) {
            header('location: ' . URLROOT . '/users/login');
        }

        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        // nahrání příspěvků
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];

        $this->view('posts', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitace POST pole
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // inicializace dat
            $data = [
                'title' => trim($_POST['title']),
                'text' => trim($_POST['text']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'text_err' => ''
            ];

            // validace title
            if (empty($data['title'])) {
                $data['title_err'] = 'Type something.';
            }
            // validace text
            if (empty($data['text'])) {
                $data['text_err'] = 'Type something.';
            }
            // check zda jsou errors prazdne
            if (empty($data['title_err']) && empty($data['text_err'])) {
                // validovano - v poradku

                if ($this->postModel->addPost($data)) {
                    header('location: ' . URLROOT . '/posts/index');
                } else {
                    die("Something went wrong");
                }
            } else {
                // nacte se view s errory
                $this->view('addPost', $data);
            }
        } else {
            $data = [
                'title' => '',
                'text' => ''
            ];
            $this->view('addPost', $data);
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitace POST pole
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // inicializace dat
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'text' => trim($_POST['text']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'text_err' => ''
            ];

            // validace title
            if (empty($data['title'])) {
                $data['title_err'] = 'Type something.';
            }
            // validace text
            if (empty($data['text'])) {
                $data['text_err'] = 'Type something.';
            }
            // check zda jsou errors prazdne
            if (empty($data['title_err']) && empty($data['text_err'])) {
                // validovano - v poradku

                if ($this->postModel->updatePost($data)) {
                    header('location: ' . URLROOT . '/posts/index');
                } else {
                    die("Something went wrong");
                }
            } else {
                // nacte se view s errory
                $this->view('editPost', $data);
            }
        } else {
            // $post
            $post = $this->postModel->getPostById($id);
            // kontrola, kdo je vlastníkem postu
            if ($post->id_user != $_SESSION['user_id']) {
                header('location: ' . URLROOT . '/posts/index');
            }

            $data = [
                'id' => $id,
                'title' => $post->title,
                'text' => $post->text
            ];
            $this->view('editPost', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $post
            $post = $this->postModel->getPostById($id);
            // kontrola, kdo je vlastníkem postu
            if ($post->id_user != $_SESSION['user_id']) {
                header('location: ' . URLROOT . '/posts/index');
            } else if (($post->id_user == $_SESSION['user_id']) && $this->postModel->deletePost($id))
 {
                header('location: ' . URLROOT . '/posts/index');
            } else {
                die("Something went wrong");
            }
        } else {
            header('location: ' . URLROOT . '/posts/index');
        }
    }
}
