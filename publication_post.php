<?php
//lancement d'une session pour garder les infos de connexion 
session_start();
// connexion à la bdd en pdo
require('connexion_bdd.php');




if (isset($_SESSION['user_id'])) {
    header('location:index.php');
    exit();
}

// verification des données post et session a mettre dans la table post de la bdd
if ((isset($_SESSION['id'])) && (isset($_POST['titre'])) && (isset($_POST['contenu']))) {
    $user_id = $_SESSION['id'];
    $titre = trim($_POST['titre']);
    $contenu = trim($_POST['contenu']);

    if(strlen($titre) >200 || strlen($contenu)>500){
        echo "Le titre(max200) ou le contenu(max500) est trop long";
        exit();
    }
    //  preparation de la requete pour l'inscription des données dans la bdd
    $stmt = $pdo->prepare('insert into posts (user_id,titre,contenu) values (?,?,?)');
    //ajout des variables de valeurs dans la requete
    $stmt->execute([$user_id, $titre, $contenu]);

    /* a revoir pb l'affichage du msg qd on raffraichi la page si non redirigé
    echo 'Félicitation votre Post est maintenant publié';*/
    header('location:index.php');
    exit();
    } 


    



  
