<?php
//Faire appel à la page connect où on trouve la connexion à la base de données
include 'connect.php';
//$request = $mysqli -> query("SELECT * FROM `commentaires` ORDER BY id DESC");
$request = $mysqli -> query("SELECT commentaires.commentaire, DATE_FORMAT(commentaires.date, '%d %M %Y') as date, utilisateurs.login 
                             FROM commentaires 
                             INNER JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id 
                             ORDER BY commentaires.id DESC");

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

            <div class="bouton_header"><a href="profil.php" ><?php foreach ($_SESSION as $key => $value) {
                                                         echo $_SESSION['user'][0] ;
                                                         } ?></a></div>
            <div class="bouton_header">
                <a href="commentaire.php" >Commentaire</a>
            </div>
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
                
            <?php
                while($result = $request -> fetch_assoc()){
                    echo "<table border : 1px >";                   
                    echo "<td>".$result['commentaire']."</td>";
                    echo "</table>";
                    echo "<table>";
                    echo "<td class = 'poste'>Posté par ".$result['login']." le ".$result['date']."</td>";
                    echo "</table>";
                }
                
            ?>
            
            <div class="bouton_header">
                <a href="commentaire.php" >Commentaire</a>
            </div>
            
        </div>
    </body>

    <footer>
        <p><b>© Mohammed Yassine Dabboussi | La Plateforme | 2022-2023</b> </p>
    </footer>

</html>

