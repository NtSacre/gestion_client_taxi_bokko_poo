<?php
session_start();
require_once("../src/AllFunctions.php");
require_once("../src/classDatabase.php");
require_once("../src/ClassPersonne.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo 'il arrie apre post';
    // die();
    if (isset($_POST['envoi_inscription']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['telephone']) && isset($_POST['password'])) {

        if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['telephone'])) {
            $_SESSION['erreur_moyen'] = " Attention : les champs ne doivent pas etre vide";
            header('Location: ../Template/Vue_inscription.php');
            exit();
        } elseif (!checkstr($_POST['nom']) || !checkstr($_POST['prenom'])) {
            $_SESSION['erreur_str'] = "Attention : le nom et le prenom ont un probleme";
            // echo "il arrive au nom et prenom";
            // die();
            header('Location: ../Template/Vue_inscription.php');
            exit();
        } elseif (!verificationEmail($_POST['email'])) {
            $_SESSION['erreur_email'] = " Attention : ton adresse email n'est pas correcte";
            // echo "il arrive à email";
            // die();
            header('Location: ../Template/Vue_inscription.php');
            exit();
        } elseif (!checkphone($_POST['telephone'])) {
            $_SESSION['erreur_telephone'] = " Hum toi aussi ton numéro de telephone n'est pas correcte, utilise un code Sénégalais 77 ou 78 ou 70 ou 76 ";
            // echo "il arrive au telephone";
            // die();
            header('Location: ../Template/Vue_inscription.php');
            exit();
        } elseif (!longpassword($_POST['password'])) {
            $_SESSION['erreur_password'] = " Petit mot de passe là, tu vas l'enregistrer où ! ça doit au moins 8 caractère vraiment c'est pas possible ";
            //echo strlen($_POST['password']);

            header('Location: ../Template/Vue_inscription.php');
            exit();
        } else {


            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $telephone = $_POST["telephone"];
            $date = date("Y-m-d");
            $authentification = new Personne();
            // var_dump($authentification->authenticateUser($email, $telephone));
            // die();
            if ($authentification->authenticateUserRegister($email, $password)) {
                $_SESSION['email_telephone'] = "attention: l'email ou le numéro de telephone existe déjà";
                header('Location: ../Template/Vue_inscription.php');
                exit();
            }



            try {
                $authentification->registerUser($nom, $prenom, $email, $password, $telephone, $date);
                // $_SESSION['nom_prenom'] = " $nom $prenom";
                header('location: ../Template/Vue_connexion.php');
                exit();
            } catch (PDOException $th) {
                echo "Error : il y'a eu une erreur " . $th->getMessage();
            }
        }
    } else {
        $_SESSION['erreur_faible'] = "<script> alert(' Oups ! le formulaire n\'a pas été envoyés.essayez de nouveau') </scrip>";
        echo $_SESSION['erreur_faible'];
        die();
        // header('Location: ../Template/Vue_inscription.php');
        // exit();
    }
}
// } else {
//     $_SESSION['erreur_critique'] = "<script> alert('c\'est pas aujourd\'hui que tu vas me pirater, va apprendre encore Petit Maudia') </scrip>";
//     header('Location: ../Template/Vue_inscription.php');
//     exit();
// }
