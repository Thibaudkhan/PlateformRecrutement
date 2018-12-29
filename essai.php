<?php
//Ne marche pas

//$db new PDO("mysql:host=$127.0.0.1;dbname=$ItesciaRecrut","root","");

//$db = new PDO("mysql:host=$host;dbname=$ItesciaRecrut", $user, "");

require_once 'db_connect.php';

$db=db_connect();


if(isset($_POST['forminscription']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

   if(!empty($_POST['pseudo']) and !empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2']))
   {
       $pseudolenght = strlen($pseudo);
       if ($pseudolenght <= 255)
       {
            if ($mail == $mail2)
            {
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                    {
                        $reqmail = $db->prepare("SELECT * FROM Candidates WHERE mail = ?");
                        $reqmail->execute(array($mail));
                        $mailexist = $reqmail->rowCount();
                            if($mailexist == 0)
                            {
                                if ($mdp == $mdp2)
                                {
                                    $insertcand = $db->prepare("INSERT INTO candidates(pseudo, mail_candidate, mdp_candidate) VALUES(?, ?, ?)");
                                    $insertcand ->execute(array($pseudo, $mail, $mdp));
                                    $erreur = "Votre compte a bien été créé !";
                                    //$_SESSION['comptecree'] = "Votre compte a bien été créé !";
                                    //header('Location: essai.php');
                                }
                                else
                                {
                                    $erreur = "Vos mots de passe ne correspondant pas !";
                                }
                            }
                            else
                            {
                                $erreur = "Cette adresse mail est déjà utilisée !";
                            }
                        }
                        else
                        {
                            $erreur = "Votre adresse mail n'est pas valide !";
                        }
                
                    }
        
            else
            {
                $erreur = "Vos adresses mails ne correspondent pas !";
            }
            }
        else
        {
            $erreur = "Votre pseudo ne doit pas excéder 255 caractères !";
        }
        }
    else
    {
        $erreur = "Tous les champs doivent être complétés !";
    }

}


?>

<!DOCTYPE <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Quizz Itescia</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="CSS/style.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <script src="main.js"></script>


    </head>
        <body>
            <header>
            <img src="../Recrut-Itescia/images/logo.png" id="imgHeaderLeft">
            <img src="../Recrut-Itescia/images/banniere1.png" id="imgHeaderRight">
            </header>
            <div id="Accroche-Inscription">
            <h2>Fais les tests et postule directement en ligne !</h2>
            </div>
            <div class="inscription" align="center" >
                <h2>INSCRIPTION AUX TESTS </h2>
                <br /><br />
                <form method="POST" action="">
                    <table>
                        <tr>
                            <td align="right">
                                <label for="pseudo">Pseudo :</label>
                            </td>
                            <td>
                                <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo;}?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="mail">Mail :</label>
                            </td>
                            <td>
                                <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail;}?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="mail2">Confirmation du mail :</label>
                            </td>
                            <td>
                                <input type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2;}?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="mdp">Votre mot de passe :</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp"/>
                            </td>
                        </tr>
                        <tr>
                            <td align="right">
                                <label for="mdp2">Confirmez le mot de passe :</label>
                            </td>
                            <td>
                                <input type="password" placeholder="Confirmez le mot de passe" id="mdp2" name="mdp2"/>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td align="center">
                            <br />
                            <input type="submit" name="forminscription" value="Je m'inscris"/>
                            </td>
                        </tr>
                    </table>
                   
                </form>
                <?php
                if(isset($erreur))
                {
                    echo '<font color="red">'.$erreur."</font>";
                }
                ?>
            </div>

        </body>
</html>