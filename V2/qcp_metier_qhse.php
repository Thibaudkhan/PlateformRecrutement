<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quizz Itescia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="CSS/style.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="images/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">


    <!--<script src="main.js"></script>-->

</head>
<body>
    <header>
        <!--<img src="../Recrut-Itescia/images/banniere.jpg" id="imgHeader">-->
        <img src="../Recrut-Itescia/images/logo.png" id="imgHeaderLeft">
        <img src="../Recrut-Itescia/images/banniere1.png" id="imgHeaderRight">
        <div class="Début">
            <!--<h1>Alors?</h1>-->
        </div>
       
    </header>
        </br>
        <div id="navigation">
				    <button type="button" onclick="window.location.href='../Recrut-Itescia/questions.php'">Accueil</button>
				    <button type="button" onclick="window.location.href='../Recrut-Itescia/questions.php'">Mon profil</button>
				    <button type="button" onclick="window.location.href='../Recrut-Itescia/questions.php'">Mes échanges</button>
					<button type="button" onclick="window.location.href='../Recrut-Itescia/questions.php'">Contact</button>
				</div>
				<br />
    <div id="Accroche-Question">
        <p>Réponds au QCM ci-dessous dans le temps imparti. Fais le bon choix, une seule réponse par question est possible !</p>
    </div><br /><br />




    <p>Aujourd'hui nous sommes le <?php echo date('d/m/Y h:i:s'); ?>.</p><br /><br />
    <?php
    $age_du_visiteur = 17;
    echo 'Le visiteur a ' . $age_du_visiteur . ' ans';

    $question_culture_G = "";
    echo 'Réponds à cette question :' . $question_culture_G . ' dans le temps imparti';


    require_once 'db_connect.php';

    ?>

<?php
try
{
    $db=db_connect();

}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
// On récupère tout le contenu des réponses de la table answers
$reponse = $db->query('SELECT content FROM answers');
// On affiche chaque entrée une à une avec $donnees = $reponse->fetch()
while ($donnees = $reponse->fetch())
{
	echo $donnees['content'] . '<br />';
}

$reponse->closeCursor();

?>
