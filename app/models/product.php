<?php
class product{
    private $db;
    public function __construct()
    {
        $this->db = new DataBase;
    } 

    public function getProducts(){
        $this->db->query('SELECT * FROM `Produit`');
        $result = $this->db->resultSet();
        return $result;
    }

    public function addproduct($data){
        
        $this->db->query('INSERT INTO `produit` (`id_produit`,`nom_produit`,`date_creation`,`prix`,`description`) values (NULL,:nom_produit,current_timestamp(),:prix,:description)');
        $this->db->bind(':nom_produit',$data['nom_produit']);
        $this->db->bind(':prix',$data['prix_produit']);
        $this->db->bind(':description',$data['description']);
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}