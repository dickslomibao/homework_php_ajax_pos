<?php

require_once '../db/connection.php';
class Category
{

    private $id;
    private $name;
    private $description;

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setDesc($desc)
    {
        $this->description = $desc;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function insert()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "INSERT INTO `category`(`name`, `description`) VALUES (?,?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->name, $this->description]);
        $db->closeConnection();;
    }

    public function displayAll()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "SELECT * FROM category order by date_created DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $db->closeConnection();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function search($sql)
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "SELECT * FROM category where $sql order by date_created DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $db->closeConnection();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSingleData()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "SELECT * FROM category where id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->id]);
        $db->closeConnection();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "UPDATE `category` SET `name`=?,`description`= ? WHERE id=?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->name, $this->description, $this->id]);
        $db->closeConnection();
    }
    public function delete()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "DELETE FROM category where id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->id]);
        $db->closeConnection();
    }
}
