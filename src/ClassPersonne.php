<?php
class Personne
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function registerUser($nom, $prenom, $email, $motDePasse, $tel, $date)
    {
        $conn = $this->db->getConnection();
        $hashedPassword = password_hash($motDePasse, PASSWORD_DEFAULT);

        $sql = "INSERT INTO clients (nom, prenom, email, password, telephone, date) VALUES (:nom, :prenom, :email, :motDePasse, :tel, :date)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':motDePasse', $hashedPassword);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':date', $date);


        $stmt->execute();
    }
    public function authenticateUserRegister($email, $telephone)
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT email, telephone,date FROM clients WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // return $user;
        // die();

        if ($user && in_array($telephone, $user)) {
            return true;
        } else {
            return false;
        }
    }
    public function authenticate($email, $password)
    {
        $conn = $this->db->getConnection();

        $sql = "SELECT email,password FROM clients WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // return $user;
        // die();

        if ($user && in_array($password, $user)) {
            return true;
        } else {
            return false;
        }
    }
    public function displayUser()
    {
        $conn = $this->db->getConnection();
        $stmt = $conn->prepare("SELECT * FROM clients ");

        $stmt->execute();
        $tabEmailPhone = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tabEmailPhone;
    }
}
