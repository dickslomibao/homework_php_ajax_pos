<?php
require_once '../db/connection.php';

class Product
{


    private $id;
    private $name;
    private $desc;
    private $category;
    private $price;



    public function setId($id)
    {
        $this->id  = $id;
    }
    public function setName($name)
    {
        $this->name  = $name;
    }
    public function setDesc($desc)
    {
        $this->desc  = $desc;
    }
    public function setCategory($category)
    {
        $this->category  = $category;
    }
    public function setPrice($price)
    {
        $this->price  = $price;
    }
    public function insert()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "INSERT INTO `product`(`name`, `description`, `category`,`price`) VALUES (?,?,?,?)";
        $smt = $pdo->prepare($query);
        $smt->execute([$this->name, $this->desc, $this->category,$this->price]);
    }

    public function displayAll()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "SELECT product.id as id, product.name as `name`, product.price as `price`,product.description as description, category.name as category, product.date_created as date_created,product.date_updated as date_updated FROM product,category where category.id = product.category order by product.date_created DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $db->closeConnection();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function forStock()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "SELECT product.id as id, product.name as `name`, product.price as `price`,product.description as description, category.name as category, product.date_created as date_created,product.date_updated as date_updated FROM product,category where category.id = product.category and product.id not in (SELECT product_id from stock) order by product.date_created DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $db->closeConnection();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function search($sql)
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "SELECT product.id as id, product.name as `name`, product.price as `price`,product.description as description, category.name as category, product.date_created as date_created,product.date_updated as date_updated FROM product INNER JOIN category on category.id = product.category where ".$sql;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $db->closeConnection();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function singleProduct()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "SELECT * from product WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->id]);
        $db->closeConnection();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "UPDATE `product` SET `name`=?,`description`=?,`category`=?,`price`=? WHERE id= ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->name,$this->desc,$this->category,$this->price,$this->id]);
        $db->closeConnection();
     
    }

    public function delete()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "DELETE from product WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->id]);
        $db->closeConnection();
      
    }

}
