<?php include "co.php";?>
<!DOCTYPE html>
<html>
    <head>
        <title>Intranet</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    </head>
    
    <body>
   
        <h1 > Profil </h1>
        <p><a href="deconnexion.php">Se déconnecter</a></p>
         <br>
        <div class="container admin">
            <div class="row">
                <h2><strong> User List   </strong></h2><div class="bouton"> <a href="inscription.php" class="bouton btn-lg"><span class="glyphicon glyphicon-plus"></span> Add</a> </div> 
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nom</th>
                      <th>prenom</th>
                      <th>mail</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        require 'db.php' ;
                        $db = Database::connect();
                        $statement = $db->query('SELECT *  FROM membres ');
                        while($item = $statement->fetch()) 
                        {
                        	
                            echo '<tr class="ligneTab">';
                            echo '<td>'. $item['id'] . '</td>';
                            echo '<td>'. $item['nom'] . '</td>';
                            echo '<td>'. $item['prenom'] . '</td>';
                           echo '<td>'. $item['mail'] . '</td>';
                            
                           
                            echo '<td width=300>';
                           
                            echo '<a class="btn " href="updateP.php?id=' . $item['id'] .'"><span class="glyphicon glyphicon-edit"></span> </a>';
                            echo ' ';
                            echo '<a class="btn " href="deleteP.php?id='.$item['id'].'"><span class="glyphicon glyphicon-trash"></span> </a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    
                        Database::disconnect();
                      ?>
                  </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
