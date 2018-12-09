<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quizz Itescia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="CSS/style.css" />
    <!--<script src="main.js"></script>-->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">


</head>

<body>
    <header>
        <img src="../Recrut-Itescia/images/logo.png" id="imgHeaderLeft">
        <img src="../Recrut-Itescia/images/banniere1.png" id="imgHeaderRight">
        <!--<div class="container">
            <h1>Questionnaire en ligne</h1>
        </div>-->
    </header>
    <main>
        <div class="container">
            <h2>Test ta motivation et tes connaissances sur le métier que tu as choisi !</h2>
            <p>Pour quelle filière souhaites-tu t'inscrire? </p>
            <ul>
                <li><strong>Nombres de questions: </strong>50</li>
                <li><strong>Type: </strong>Choix multiples</li>
                <li><strong>Temps imparti: </strong>20 minutes</li>
            </ul>
            <form method="post" action="questions.php" >
      <p>
       <br/>
       <select name="type">
        <option >Choix de la formation</option>
         <option value="BTS sio">BTS sio</option>
         <option value="BTS Comptabilité et Gestion">BTS Comptabilité et Gestion</option>
         <option value="DCG">DCG</option>
         <option value="DSCG">DSCG</option>
         <option value="RRH">RRH</option>
         <option value="Contrôle de gestion">Contrôle de gestion</option>
         <option value="QHSE">QHSE</option>
         <option value="MIQPE">MIQPE</option>
       </select>
       <br/>
       <br/>

       <input type="submit" name="choixFormation" value="Valider">
    </form>
            <a href="questions.php?n=1" class="start">C'EST PARTI !</a>
        </div>
    </main>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" methode="POST">
        <?php
   
        echo get_quizz_html();

        ?>
    </form>
    <footer>
        Copyright &copy;IsisTechnologie, 2018 Tests en ligne ITESCIA
    </footer>
</body>
</html>




<?php

$question="vrai ou faux?";
$option=array("vrai"=>"true", "faux"=>"false");
$correct_answer="true";
$selected_answer="";

//handle onchange event
if(isset($_POST["réponse"]))
{
    $selected_answer=$_POST["réponse"];
}

function get_quizz_html()
{
    global $question;
    global $options;
    global $selected_answer;
    global $correct_answer;

    $html='';

    $html.='<h3>' .$question. '</h3>';

    $html.="</br>";
    /*foreach ($options as $k=>$v)
    {
        $checked="";
        $class="";
        if($selected_answer==$v)
        {
            if($selected_answer==$correct_answer)
            {
                $checked="checked";
                $class="green";
            }
            else
            {
                $class="red";
            }
            
        }

        $html.='<span class="'.$class.'">'.$k.'<input name="réponse" '.$checked.' type="radio" value="'.$v.'" onchange="this.form.submit();"/></span>';

    }*/


    return $html;
}
?>



