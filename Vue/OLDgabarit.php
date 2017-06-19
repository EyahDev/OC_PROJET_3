<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <base href="<?= $racineWeb; ?>">
        <link rel="stylesheet" href="<?= $racineWeb ?>Contenu/style.css" />
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <title><?= $titre ?></title>
    </head>
    <body>
    <div id="global">
        <header>
            <a href="index.php"><h1 id="titreBlog">Mon Blog</h1></a>
            <p>Je vous souhaite la bienvenue sur ce modeste blog.</p>
        </header>

        <div id="contenu">
            <?= $contenu ?>
        </div> <!-- #contenu -->
        <footer id="piedBlog">
            <p>Blog réalisé avec PHP, HTML5 et CSS.</p>
            <?php
                if (isset($_SESSION['idUtilisateur'])){
                    echo '<a href="admin/">Administration</a>';
                } else {
                    echo '<a href="connexion/">Administration</a>';
                }
            ?>
        </footer>
    </div> <!-- #global -->
    </body>
</html>