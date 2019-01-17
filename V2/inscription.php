<?php
    include "db.php";

    $nom = $prenom  = $mail = $mail2 = $mdp = $mdp2   = "";
    

if(isset($_POST['forminscription'])) {
   $nom = htmlspecialchars($_POST['nom']);
   $prenom = htmlspecialchars($_POST['prenom']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);

   $isSuccess          = true;
   $isUploadSuccess    = false;

   if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail'])  AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $nomlength = strlen($nom);
      $prenomlength = strlen($prenom);
      if($nomlength <= 70) {
         if($prenomlength <= 70) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
              $db = Database::connect();
               $reqmail = $db->prepare("SELECT * FROM membres WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mdp == $mdp2) {
                    
                      
                     $insertmbr = $db->prepare("INSERT INTO membres(nom, prenom,  mail, motdepasse) VALUES ('".$nom."','". $prenom."','". $mail."', '".$mdp."')");
                     $insertmbr->execute(array($nom, $prenom, $mail, $mdp));
                     
                     Database::disconnect();
                    // header("Location: recru.php");
                     
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                     $isSuccess = false;
                  }
               } else {
                  $erreur = "Adresse mail déjà utilisée !";
                  $isSuccess = false;
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
               $isSuccess = false;
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
            $isSuccess = false;
         }

         } else {
         $erreur = "Votre prenom ne doit pas dépasser 70 caractères !";
         $isSuccess = false;
      }

      } else {
         $erreur = "Votre nom ne doit pas dépasser 70 caractères !";
         $isSuccess = false;
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
      $isSuccess = false;
   }Database::disconnect();


 }

   
    

    function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>
<html>
   <head>
      <title>Intranet</title>
      <meta charset="utf-8"/>
   </head>
   <body>
      <h1>Inscription</h1>
      <div align="center">
         
         <br /><br />
         <form method="POST" action="inscription.php" role="form" method="post" enctype="multipart/form-data">
            <table>
               <h3>Veuillez insérer  : </h3>
               <br>
               <tr>
                  <td align="right">
                     <label for="nom">nom :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Le nom" id="nom" name="nom"  />
                  </td>
               </tr>
               <tr>

                <tr>
                  <td align="right">
                     <label for="prenom">prenom :</label>
                  </td>
                  <td>
                     <input type="text" placeholder="Le prénom" id="prenom" name="prenom"  />
                  </td>
               </tr>
               
                  <td align="right">
                     <label for="mail">Mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Le mail" id="mail" name="mail"  />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mail2">Confirmation du mail :</label>
                  </td>
                  <td>
                     <input type="email" placeholder="Confirmez le mail" id="mail2" name="mail2"  />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp">Mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Le mot de passe" id="mdp" name="mdp" />
                  </td>
               </tr>
               <tr>
                  <td align="right">
                     <label for="mdp2">Confirmation du mot de passe :</label>
                  </td>
                  <td>
                     <input type="password" placeholder="Confirmez le mdp" id="mdp2" name="mdp2" />
                  </td>
               </tr><!--
               <tr>
                  <td align="right">
                     <label for="anniversaire">Votre date de naissance</label>
                  </td>
                  <td>
                     <input type="date" name="anniversaire">
                  </td>
               </tr>-->
               <tr>
                  <td></td>
                  <td align="center">
                     <br />
                     <input type="submit" name="forminscription" value="Accepter" />
                  </td>
               </tr>
            </table>
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
   </body>
</html>