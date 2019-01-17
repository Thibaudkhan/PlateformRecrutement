<?php
   session_start();
   $nom = htmlentities(trim($_SESSION['nom']));
   $prenom = htmlentities(trim($_SESSION['prenom']));
   $mail = htmlentities(trim($_SESSION['mail']));
   if (!isset($_SESSION['id'])){
    header ('Location: recru.php');
     exit();
   }
?>