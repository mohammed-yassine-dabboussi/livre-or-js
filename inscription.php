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
        <div class="bouton_header"><a href="index.php" >Accueil</a></div>
        <div class="bouton_header">
            <a href="livre-or_anonyme.php" >Livre d'or</a>
        </div>
        <div class="bouton_header"><a href="inscription.php" >Inscription</a></div>
        <div class="bouton_header"><a href="connexion.php" >Connexion</a></div>
    </div>
</header>

    <body>
        <!--div principale-->
        <div class="div_body">
        <!--div du milieu du body-->
            <div class="div_milieu">
                <!--formulaire--> 
                <form action="" method="post">
                    <h1>Inscription</h1>

                    <table>
                        <tr>
                            <td>Identifiant</td>
                            <td><input type="text" name="login" placeholder="Entrez votre identifiant !" size="25"/></td>
                        </tr>
                        <tr>
                            <td>Mot de Passe</td>
                            <td><input type="password" name="password" placeholder="Entrez votre mot de passe !" size="25"/></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="password" name="password_confirmation" placeholder="Confirmez votre mot de passe !" size="25"/></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="ENVOYER" ></td>
                        </tr>
                    </table>
                </form>
                <h2><a  href="connexion.php">&#10148;Connectez-vous:</a></h2> 
                <!--Partie PHP -->
                <?php
                    if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password_confirmation'])){
                        if ($_POST['login']!="" && $_POST['password']!="" && $_POST['password_confirmation']!="" ){
                            if ($_POST['password'] === $_POST['password_confirmation']){  
                                //recuperer le contenu du formulaire 
                                $login=$_POST['login'];
                                $password1=$_POST['password'];
                                $password2=$_POST['password_confirmation']; 

                                //vérifier si l'identifiant existe déja
                                $request = $mysqli -> query('SELECT COUNT(*) FROM `utilisateurs` WHERE `login`="'.$login.'"');
                                $result_fetch_array = $request -> fetch_array();
                                // Si l'identifiant n'existe pas 
                                if($result_fetch_array['COUNT(*)'] == 0){
                                    //   requête pour ajouter les données entré par l'utilisateur à la base des données  
                                     $request = $mysqli -> query("INSERT INTO `utilisateurs`(`id`, `login`, `password`) VALUES (NULL,'$login','$password1')");
                                     echo "<p style='color:rgb(0, 240, 44);'>Félicitations, vous êtes bien inscrit !</p>";
                                     echo "<h2><a  href='connexion.php'>&#10148;Connectez-vous:</a></h2>"; 

                                }else{
                                    echo "<p style='color:rgb(160, 0, 0);'>L'idetifiant existe déja !</p>";
                                }
                            }else{
                                echo "<p style='color:rgb(160, 0, 0);'>Les mots de passes ne sont pas identiques</p>";
                            }
                        }else{
                        echo "<p style='color:rgb(160, 0, 0);'>Veuillez remplir tout les champs !</p>";
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

