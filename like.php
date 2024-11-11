<?php

session_start();
require ("connexion_bdd.php");

// insertion des likes dans la table likes
if((isset($_POST['add_like'])) && (isset($_SESSION['id'])) && (isset($_POST['post_id']))){
   
    $user_id=$_SESSION['id'];
    $post_id=$_POST['id'];

  

    $stmt=$pdo->prepare('insert into likes (user_id,post_id) value (?,?)');
    $stmt->execute([$user_id,$post_id]);

    header('location:index.php');
    exit();
}else{
    echo "Le like a echoué";
}
 



