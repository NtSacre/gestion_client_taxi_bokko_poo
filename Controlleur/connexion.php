<?php
session_start();
include_once("../src/AllFunctions.php");
include_once("../src/classDatabase.php");
include_once("../src/ClassPersonne.php");


//include_once("style.css");

// echo "<div class='.container-fluid'>";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['envoi_connexion']) && isset($_POST['email']) && isset($_POST['password'])) {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $_SESSION['email_password'] = "les champs ne doivent pas etre vide";
            header("Location: ../Template/Vue_connexion.php");
            exit();
        }
        $email = verificationEmail($_POST['email']) ? $_POST['email'] : false;
        // header('Location: Vue_connexion.php');
        // exit();
        if ($email != false) {
            $authentification = new Personne();


            // if ($users == false) {
            //     $_SESSION['erreur_email_connexion'] = "adresse mail n'existe pas va t'inscrire d'abord";
            //     header('Location: ../Template/Vue_connexion.php');
            //     exit();
            // }
            // var_dump($users);
            $mot_de_passe = longpassword($_POST['password']) ? $_POST['password'] : false;
            if ($mot_de_passe == false) {
                $_SESSION['erreur_password_connexion'] = " mot de passe incorrecte au moins 8 caractères";
                header('Location: ../Template/Vue_connexion.php');
                exit();
            }
            // echo "<br /><br /><br /><br />";
            // var_dump($mot_de_passe);
            // die();

            if ($authentification->authenticate($email, $mot_de_passe)) {
                $_SESSION['email_connexion'] = $users['nom'] . " " . $users["prenom"];
                // echo $_SESSION['email_connexion'];
                // die();
                header('Location:index.php');
                exit();
            } else {
                $_SESSION['erreur_password_connexion'] = "Adresse eamil ou  mot de passe n'existe pas";

                header('Location: ../Template/Vue_connexion.php');
                exit();
            }
        }
    } else {
        $_SESSION['erreur_email_connexion'] = " Oups ! adresse email incorrecte Ex: exemple@gmail.com ";
        header('Location: ../Template/Vue_connexion.php');
        exit();
    }
}
