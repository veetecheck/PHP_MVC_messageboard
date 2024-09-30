<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
        $this->db->query(
            "SELECT 
                posts.id AS post_id,
                posts.title,
                posts.text,
                users.id AS user_id,
                users.username,
                users.email
            FROM posts
            JOIN users ON users.id = posts.id_user
            "
        );

        return $this->db->resultSet();
    }

    public function addPost($data)
    {
        $this->db->query('INSERT INTO posts (title, id_user, text) VALUES (:title, :user_id, :text)');
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':text', $data['text']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
