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
            <div class="bouton_header">
                <a href="profil.php" >
                    <?php 
                        foreach ($_SESSION as $key => $value){
                            echo $_SESSION['user'][0] ;
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
                <!--formulaire-->
                <form action="" method="post">
                    <h1>Modifiez votre profil</h1>
                    <p>Changer l'identifiant et/ou le mot de passe</p>
                    <table>
                        <tr>
                            <td>Identifiant</td>
                            <td><input type="text" name="login" placeholder="Modifiez votre identifiant !" size="25"/></td>
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
                <!--Partie PHP-->
                <?php
                    //Récuperer l'identifiant connecté
                    foreach ($_SESSION as $key => $value) {
                        $user = $_SESSION['user'][0] ;
                    }
                    $modification_login = 0;
                    $modification_mdp = 0;
                    if (isset($_POST['login']) ){
                        //Si on modifie l'identifiant
                        if ($_POST['login']!=""){
                            $login=$_POST['login'];

                            //vérifier si l'identifiant existe déja
                            $request = $mysqli -> query('SELECT COUNT(*) FROM `utilisateurs` WHERE `login`="'.$login.'"');
                            $result_fetch_array = $request -> fetch_array();
                            if($result_fetch_array['COUNT(*)'] == 0){
                                //   requête pour appliquer les modifications
                                $mysqli->query('UPDATE `utilisateurs` SET `login`="'.$login.'" WHERE `login`="'.$user.'"');
                                $_SESSION['user'][0]= $_POST['login'];
                                //actualiser la page aprés 2 secondes 
                                header( "refresh:2;url=modif_profil.php" );
                                $user = $login;
                                $modification_login = 1;
                            }else{
                                echo "<p style='color:rgb(160, 0, 0);'>L'idetifiant existe déja !</p>";
                            }
                        }
                    }
                    if (isset($_POST['password']) && isset($_POST['password_confirmation'])){
                        //Si on modifie le mot de passe
                        if ($_POST['password']!="" ){
                            if ($_POST['password'] == $_POST['password_confirmation']){
                                $password=$_POST['password'];
                                $mysqli->query('UPDATE `utilisateurs` SET `password`="'.$password.'" WHERE `login`="'.$user.'"');
                                $modification_mdp = 1;
                            }else {
                                echo "<p style='color:rgb(160, 0, 0);'>Les mots de passes ne sont pas identiques</p>";
                            }
                        }
                    }
                    //si on modifie un champ ou plus un message s'affiche
                    if($modification_mdp === 1 || $modification_login === 1){
                        echo "<p style='color:rgb(0, 240, 44);'>Vos données ont été mis à jour !</p>";
                    }
                    
                ?>
            </div>
        </div>
    </body>

    <footer>
        <p><b>© Mohammed Yassine Dabboussi | La Plateforme | 2022-2023</b> </p>
    </footer>

</html>

