<?php
class Post
{
    private $db;
    public function __construct()
    {
        $this->db = new DataBase;
    }
    public function getPosts()
    {
        $this->db->query('SELECT *,
                        posts.id_posts as IdPost,
                        user.id_user as IdUser 
                        FROM posts
                        INNER JOIN user
                        on posts.id_user = user.id_user
                        ORDER BY posts.created_at');
        $results = $this->db->resultSet();
        return $results;
    }


    //insert post in database
    public function addPost($data){
        $this->db->query('INSERT INTO `posts` (`id_user`, `title`, `body`) VALUES (:user_id, :title, :body) ');
        $this->db->bind(':user_id',$data['user_id']);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // get post by id
    public function getPostById($id){
        $this->db->query('SELECT * FROM posts WHERE id_posts = :id');
        $this->db->bind(':id',$id);
        $row = $this->db->single();
        return $row;
    }
    public function updatePost($data){
        $this->db->query('UPDATE `posts` SET title = :title , body = :body WHERE id_posts = :id');
        $this->db->bind(':id',$data['id']);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':body',$data['body']);

        
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
    public function deletePost($id){
        $this->db->query('DELETE FROM posts WHERE id_posts = :id  ');
        $this->db->bind(':id',$id);
        


        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }
}
