<?php
//Faire appel à la page connect où on trouve la connexion à la base de données
include 'connect.php';
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
                <a href="livre-or.php" >Livre d'or</a>
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
            <form action="" method="post">
                <h1>Commentaire</h1>
                <table>
                    <tr>
                        <td></td>
                        <td><textarea name="commentaire" cols="50" rows="10"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="ENVOYER" ></td>
                    </tr>
                </table>
            </form>
            <!--Partie PHP -->
            <?php 
                //Récuperer l'identifiant de l'utilisateur connecté
                foreach ($_SESSION as $key => $value) {
                    $user = $_SESSION['user'][0] ;
                }
                //Récuperer l'id de l'utilisateur connecté
                $request = $mysqli -> query('SELECT `id` FROM `utilisateurs` WHERE `login`="'.$user.'"');
                //utiliser la méthode assoc pour récuperer le résultat de la requête
                $result_fetch_assoc = $request -> fetch_assoc();
                $id = $result_fetch_assoc['id'];
                //quand on valide le formulaire
                if (isset($_POST['commentaire'])){
                    $commentaire = $_POST['commentaire'];
                    if($commentaire != ""){
                        //Requête pour ajouter le commentaire par l'utilisateur à la base des données  
                        $request = $mysqli -> query("INSERT INTO `commentaires`(`id`, `commentaire`, `id_utilisateur` ,`date`) VALUES (NULL, '$commentaire', '$id', NOW())");
                        header ('Location: livre-or.php');
                    }else{
                        echo "<p style='color:rgb(160, 0, 0);'>Aucun commentaire</p>";
                    }
                }
            ?>
            </div>
        </div>
    </body>

    <footer>
        <p><b>© Mohammed Yassine Dabboussi | La Plateforme | 2022-2023</b> </p>
    </footer>

</html>

