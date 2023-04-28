<?php

require_once '../db/connection.php';
class Stock
{

    private $id;
    private $product;
    private $stock;


    public function setID($id)
    {

        $this->id = $id;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    public function insert()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "INSERT INTO `stock`(`product_id`, `stock`) VALUES (?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->product, $this->stock]);
        $db->closeConnection();
    }
    public function displayAll()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "SELECT stock.id AS id, product.name as name, stock.stock as stock, stock.date_created as date_created, stock.date_updated as date_updated from stock INNER JOIN product on product.id = stock.product_id order by stock.date_created DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $db->closeConnection();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function search($sql)
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "SELECT stock.id AS id, product.name as name, stock.stock as stock, stock.date_created as date_created, stock.date_updated as date_updated from stock INNER JOIN product on product.id = stock.product_id where ".$sql;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $db->closeConnection();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(){
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "UPDATE `stock` SET `stock`= ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->stock,$this->id]);
        $db->closeConnection();

    }
    public function delete(){
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "DELETE FROM `stock` WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->id]);
        $db->closeConnection();

    }
}
