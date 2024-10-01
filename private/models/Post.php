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

    public function getPostById($id){
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function updatePost($data)
    {
        $this->db->query('UPDATE posts SET title = :title, text = :text WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':text', $data['text']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deletePost($id){
        $this->db->query('DELETE FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
