<?php
require 'db.php' ;

$db = Database::connect();


//class connexion{

   //public  function __construct() {
      if(isset($_POST['formconnexion'])) {
         $mailconnect = htmlspecialchars($_POST['mailconnect']);
         $mdpconnect = sha1($_POST['mdpconnect']);
         if(!empty($mailconnect) AND !empty($mdpconnect)) {
            $statement = $db->prepare("SELECT * FROM membres WHERE mail = ? AND motdepasse = ?");
            $statement->execute(array($mailconnect, $mdpconnect));
            $userExist = $statement->rowCount();
            if($userExist == 1) {
               $userInfo = $statement->fetch();
               session_start();
               $_SESSION['id'] = $userInfo['id'];
               $_SESSION['nom'] = $userInfo['nom'];
               $_SESSION['prenom'] = $userInfo['prenom'];
               $_SESSION['mail'] = $userInfo['mail'];
               
               header("Location: recru.php?id=".$_SESSION['id']  );

            } else {
               $error = "Mauvais mail ou mot de passe !";
            }
         } else {
            $error = "Tous les champs doivent être complétés !";
         }
      }
   //}
//}


Database::disconnect();

?>
<html>
   <head>
      <title>Itescia</title>
      <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <link rel="stylesheet" type="text/css" href="css/style2.css">
      <link rel="stylesheet" type="text/css" href="css/connexion.css">
      
      <link rel="icon" href="images/Bullet.ico" />

   </head>
   <body>
      <header>
            
          
      </header>
      <p><?php echo date('l j F Y'); ?></p>
      <div class="backImage">
      <div align="center">
         <h2>Connexion</h2>
         <br>
         <form method="POST" action="">
            <input type="email" name="mailconnect" placeholder="Mail" />
            <input type="password" name="mdpconnect" placeholder="Mot de passe" />
            <br /><br />
            <input type="submit" name="formconnexion" value="Se connecter !" />
         </form>
         <?php
         if(isset($error)) {
            echo '<font color="red">'.$error."</font>";
         }
         ?>
      </div>
   </div>
   </body>
</html>