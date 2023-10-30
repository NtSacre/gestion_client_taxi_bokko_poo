<?php
session_start();
// session_unset();
if (!isset($_SESSION['email_connexion'])) {
    header('location: ../Template/Vue_inscription.php');
}
require_once("../src/classDatabase.php");
require_once("../src/ClassPersonne.php");
$auth = new Personne();
$tabEmailPhone = $auth->displayUser();

require_once("../Template/Vue_Homepage.php");
