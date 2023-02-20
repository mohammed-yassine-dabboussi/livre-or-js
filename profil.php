<?php 
//démarrer la session
session_start();
//Faire appel à la page connect où on trouve la connexion à la base de données
include 'connect.php';
//Récuperer l'identifiant connecté
foreach ($_SESSION as $key => $value) {
    $user = $_SESSION['user'][0] ;
}
//requête pour recuperer tout les données dont le login est l'utilisateur connecté
$request = $mysqli -> query("SELECT * FROM `utilisateurs` WHERE `login` = '".$user."' ");
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
            <div class="bouton_header">
                <a href="profil.php" > 
                    <?php 
                        foreach ($_SESSION as $key => $value) {
                            echo $_SESSION['user'][0];
                        } 
                    ?>
                </a>
            </div>
            <div class="bouton_header">
                <a href="livre-or.php" >Livre d'or</a>
            </div>
            <div class="bouton_header"><form action="" method="post"><input type="submit" value="Deconnexion" name="deconnexion"></form></div>
            <?php     
                if (isset($_POST['deconnexion'])){ 
                    //supprimer le contenu de session  
                    session_destroy(); 
                    header('Location: index.php');
                }
            ?>
        </div>
    </header>
    
    <body>
        <!--div principale-->
        <div class="div_body">
        <!--div du milieu du body-->
            <div class="div_milieu"> 
                <?php 
                    foreach ($_SESSION as $key => $value) {
                         echo "<h2 style='color:rgb(160, 0, 0);'>Bonjour ".$_SESSION['user'][0]."</h2>";
                    }
                ?>
                <h2><a href="modif_profil.php">&#10148;Modifiez votre profil:</a></h2> 
            </div>
        </div>
    </body> 

    <footer>
        <p><b>© Mohammed Yassine Dabboussi | La Plateforme | 2022-2023</b> </p>
    </footer> 

</html>

