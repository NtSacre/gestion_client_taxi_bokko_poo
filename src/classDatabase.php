<?php
class Database
{
    public $host = "localhost";
    public $username = "root";
    public $password = "";
    public $database = "gestion_utilisateur_taxi_bokko";
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    public function getConnection()
    {
        return $this->conn;
    }
}
