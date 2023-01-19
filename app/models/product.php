<?php
class product
{
    private $db;
    public function __construct()
    {
        $this->db = new DataBase;
    }

    public function getProducts()
    {
        $this->db->query('SELECT * FROM `Produit`');
        $result = $this->db->resultSet();
        return $result;
    }

    public function addproduct($data)
    {
        // die(print_r($data));

        foreach ($data as $product) {
            $this->db->query('INSERT INTO `produit` (`nom_produit`,`date_creation`,`prix`,`description`) values (:nom_produit,current_timestamp(),:prix,:description)');
            $this->db->bind(':nom_produit', $product['nom_produit']);
            $this->db->bind(':prix', $product['prix_produit']);
            $this->db->bind(':description', $product['description']);
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function getProductById($id_produit)
    {
        $this->db->query('SELECT * FROM `produit` WHERE id_produit = :id_produit');
        $this->db->bind(':id_produit', $id_produit);
        $row = $this->db->single();
        if ($this->db->execute()) {
            return $row;
        } else {
            return false;
        }
    }
    public function updateProduct($data)
    {
        // die('update');
        $this->db->query('UPDATE `produit` SET nom_produit = :nom_produit, prix = :prix_produit , description = :description  WHERE id_produit = :id_produit');
        // Bind values
        $this->db->bind(':id_produit', $data['id_produit']);
        $this->db->bind(':nom_produit', $data['nom_produit']);
        $this->db->bind(':prix_produit', $data['prix_produit']);
        $this->db->bind(':description', $data['description']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteProduct($id_produit){
        $this->db->query('DELETE FROM produit WHERE id_produit = :id_produit');
            // Bind values
            $this->db->bind(':id_produit', $id_produit);
            // Execute
            if($this->db->execute()){
              return true;
            } else {
              return false;
            }
    }
}
