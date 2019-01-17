<?php

require_once 'db_connect.php';

if(isset($_POST['save_question'])){
    $type_question = $_POST['type_question'];
    $question = $_POST['question'];
    /*$answer_1 = $_POST['answer_1'];
    $answer_2 = $_POST['answer_2'];
    $answer_3 = $_POST['answer_3'];
    $answer_4 = $_POST['answer_4'];
    $answer_5 = $_POST['answer_5'];*/

    $db = db_connect();

    $req = $db->prepare('INSERT INTO questions (type, content) VALUES(:type, :content)');
    $req->execute(array('type' => $type_question, 'content' => $question));

    $id_question = $db->lastInsertId();

    $req->closeCursor();

    for($i=1; $i <=5; $i++){
        $req = $db->prepare('INSERT INTO answers (question_id, content) VALUES(:question_id, :content)');
        $req->execute(array('question_id' => $id_question, 'content' => $_POST['answer_' . $i]));

        $req->closeCursor();
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
 
    <div class="questionsForm" align="center">
        <form method="post" action="form.php">
            <label for="type_question">Type de question</label>
            <select id="type_question" name="type_question">
                <option value="culture">Culture générale</option>
                <option value="psy">Psychotechnique</option>
                <option value="personalite">Personnalité</option>
                <option value="metier">Métier</option>
            </select></br></br>
            
            <table class="tableForm">
            <tr class="ligneForm">

            <label for="question">  Question : </label>
            <textarea id="question" name="question"></textarea></br>


            <label for="answer_1"> Réponse 1 </label>
            <textarea id="answer_1" name="answer_1"></textarea></br>

            <label for="answer_2"> Réponse 2 </label>
            <textarea id="answer_2" name="answer_2"></textarea></br>

            <label for="answer_3"> Réponse 3 </label>
            <textarea id="answer_3" name="answer_3"></textarea></br>

            <label for="answer_4"> Réponse 4 </label>
            <textarea id="answer_4" name="answer_4"></textarea></br>

            <label for="answer_5"> Réponse 5 </label>
            <textarea id="answer_5" name="answer_5"></textarea></br></br>

            <button name="save_question" type="submit">Enregistrer la question</button>
            </tr>
            </table>
        </form>
    </div>

    
    <footer>
        Copyright &copy;IsisTechnologie, 2018 Tests en ligne ITESCIA
    </footer>
</body>
</html>

