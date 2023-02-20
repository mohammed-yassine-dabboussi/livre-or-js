<?php
//Faire appel à la page connect où on trouve la connexion à la base de données
include 'connect.php';
$request = $mysqli -> query("SELECT * FROM `utilisateurs` ");
//démarrer la session
session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_mc/style.css"/>
    <link rel="shortcut icon" href="" >
    <title>Livre d'or js</title>
</head>

    <header>
            <!--Partie gauche du header-->
            <div class="hGauche">
                <div class="bouton_header">Livre d'or | Mohammed Yassine Dabboussi</div>
            </div>
            <!--Partie droite du header-->
            <div class="hDroite">
                
                <div class="bouton_header"><a href="" ><?php foreach ($_SESSION as $key => $value) {
                                                                            echo $_SESSION['user'][0] ;
                                                                        } ?></a></div>
                <div class="bouton_header"><form action="" method="post"><input type="submit" value="Deconnexion" name="deconnexion"></form></div>
                <?php     if (isset($_POST['deconnexion'])) {   
                            session_destroy(); 
                            header('Location: index.php');
                        }?>
            </div>
    </header>

    <body>
        <!--div principale-->
        <div class="div_body">
        <!--div du milieu du body-->
            <div class="div_milieu"> 
                <h1>Livre d'or</h1>
                <table border : solid>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Login</th>
                            <th>Mot de passe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while(($result = $request -> fetch_array()) != null)
                            {
                                echo "<tr>";
                                echo "<td>".$result['id']."</td>";
                                echo "<td>".$result['login']."</td>";
                                echo "<td>"."*****"."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body> 

    <footer>
        <p><b>© Mohammed Yassine Dabboussi | La Plateforme | 2022-2023</b> </p>
    </footer> 

</html>

