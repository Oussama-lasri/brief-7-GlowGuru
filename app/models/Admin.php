<?php
class Admin
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
 
 

  // login user
  public function login($email, $password)
  {
    $this->db->query("SELECT * from admin where email = :email");
    $this->db->bind(":email",$email);
    $row = $this->db->single();
    
    if($password == $row->password){
      return $row;
    }else{
      return false;
    }
  }


  // Find user by email
  public function findUserByEmail($email)
  {
    $this->db->query('SELECT * FROM admin WHERE email = :email');
    $this->db->bind(':email', $email);

    $row = $this->db->single();

    // Check row
    if ($this->db->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  // find user by ID 
  public function getUserById($id_user)
  {
    $this->db->query('SELECT * FROM Admin WHERE id_admin = :id');
    $this->db->bind(':id', $id_user);
    $row = $this->db->single();

    return $row;
  }
}
