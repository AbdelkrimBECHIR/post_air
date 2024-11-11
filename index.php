<?php  
session_start();
require('connexion_bdd.php');
    //recuperation des posts join avec les noms des posteur dans l'ordre de date decroissant
$post = $pdo->query("select * from posts join users on posts.user_id =users.id ORDER BY date_post DESC ");
$posts = $post->fetchAll(PDO::FETCH_ASSOC);

//recuperation des likes join avec les noms des posteur 
$like = $pdo->query("select * from users join likes on users.id =likes.user_id");
$likes = $like->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POST'AIR</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class='header'>
        <div class='titre_header'>
            <!-- a remplacer par le logo -->
            <h1>POST'R le site contre l'ennui</h1>
        </div>

        <div class='header_lien'>
            <a href="profil.php">Mon profil</a>
            <a href='logout.php'>Se déconnecter</a>
        </div>

    </header>
    <main>
        <h1>Bienvenue
            <?php echo htmlentities($_SESSION['nom']); ?>
            chez POST'R</h1>

        <div class='main_page'>

            <div class='publi_contenu'>
                <form class='form' method='post' action='publication_post.php'>
                    <label for="titre">Choisissez un titre :</label>
                    <select class='colonne_form' name="titre">
                        <option value="Devinette">Devinette</option>
                        <option value="Charade">Charade</option>
                        <option value="Blague">Blague</option>
                        <option value="Blague pourrie">Blague pourrie</option>
                    </select>
                    <textarea class='form_contenu' name='contenu' placeholder="votre post" required></textarea>
                    <button class='colonne_form' class='bouton' type='submit'>Poster</button>
                </form>
            </div>


            
                
                <div class='posts' action='publication_post.php'>
                    <?php foreach ($posts as $post): ?>
                        <div class='post'>
                            <p><strong><?php echo htmlentities($post['titre']); ?></strong></p>
                            <p><br></p>
                            <p><?php echo htmlentities($post['contenu']); ?></p>
                            <p><br></p>
                            <p>Publié par <?php echo htmlentities($post['nom']); ?> </p>
                            <br>
                           
                        </div>
                        <form action="like.php" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $post['user_id']; ?>"> 
                            <?php  // a terminer
                            if(isset($likes)){
                                echo  "<button class='colonne_form' class='bouton' name='add_like' type='submit'>Ajouter like</button>";
                               " <br><br>";
                             }else{
                            echo "<button class='colonne_form' class='bouton' name='delete_like' type='submit'>Supprimer like</button>";
                             }
                           ?>
                            </form>
                    <?php endforeach; ?>
                </div>
           

    </main>

    <footer class='footer'>

        <p>created by Abdelkrim 10/24</p>
    </footer>

</body>

</html>