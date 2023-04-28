<?php
require_once '../db/connection.php';
class Users
{
    private $id;
    private $name;
    private $email;
    private $username;
    private $pass;
    public function setId($id)
    {
        $this->id = $id;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }
    public function setPassword($pass)
    {
        $this->pass = $pass;
    }

    public function insert()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "INSERT INTO `users`(`name`, `email`, `username`, `password`) VALUES (?,?,?,?)";
        $stmt = $pdo->prepare($query);
        $result = $stmt->execute([
            $this->name,
            $this->email,
            $this->username,
            md5($this->pass),
        ]);
        $db->closeConnection();
        return $result;
    }
    public function insertGmail()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = "INSERT INTO `users`(`name`, `email`) VALUES (?,?)";
        $stmt = $pdo->prepare($query);
        $result = $stmt->execute([
            $this->name,
            $this->email
        ]);
        $db->closeConnection();
        return $result;
    }
    public function emailIsUsed()
    {

        $db = new Database;
        $pdo = $db->getConnection();
        $query = 'SELECT COUNT(*) as count FROM `users` where email = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->email]);
        $db->closeConnection();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function usernameIsUsed()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = 'SELECT COUNT(*) as count FROM `users` where username = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->username]);
        $db->closeConnection();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validateAccount()
    {
        $db = new Database;
        $pdo = $db->getConnection();
        $query = 'SELECT * FROM `users` where username = ? and `password` = ?';
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->username, md5($this->pass)]);
        $db->closeConnection();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
