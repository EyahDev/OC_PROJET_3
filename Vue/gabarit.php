<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?= $titre ?></title>
        <meta charset="utf-8">
        <base href="<?= $racineWeb; ?>">
        <meta name="author" content="www.adriendesmet.com">
        <meta name="description" content="Projet 3 de la formation Openclassrooms pour le parcours de chef de projet multimédia option développement"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="pragma" content="no-cache" />
        <link rel="stylesheet" type="text/css" href="<?= $racineWeb ?>Contenu/css/reset.css">
        <link rel="stylesheet" type="text/css" href="<?= $racineWeb ?>Contenu/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?= $racineWeb ?>Contenu/css/table.css">
        <link rel="stylesheet" href="<?= $racineWeb ?>Contenu/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?= $racineWeb ?>Contenu/css/custom.css">
        <script src="<?= $racineWeb ?>Contenu/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="<?= $racineWeb ?>Contenu/js/jquery.js"></script>
        <script type="text/javascript" src="<?= $racineWeb ?>Contenu/js/main.js"></script>
        <script type="text/javascript" src="<?= $racineWeb ?>Contenu/js/custom.js"></script>
    </head>

    <body>
        <?php include '__nav.php'?>
        <?= $contenu ?>

        <footer>
            <div class="footer clearfix">
                <ul class="social clearfix">
                    <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=https://projet3.adriendesmet.com" class="fb" data-title="Facebook" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a></li>
                    <li><a target="_blank" href="https://plus.google.com/share?url=https://projet3.adriendesmet.com" class="google" data-title="Google +" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a></li>
                    <li><a target="_blank" href="https://twitter.com/share?url=https://projet3.adriendesmet.com" class="twitter" data-title="Twitter" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a></li>
                </ul><!-- end social -->

                <div class="rights">
                    <p><a href="mentionslegales">Mentions légales</a> - Copyright © Jean Forteroche - 2017 </p>
                    <p>Template by <a href="http://pixelhint.com/" target="_blank">Pixelhint.com</a> modifié par <a href="http://adriendesmet.com" target="_blank">Adrien Desmet</a></p>
                </div><!-- end rights -->
            </div ><!-- end footer -->
        </footer>
    </body>
</html>