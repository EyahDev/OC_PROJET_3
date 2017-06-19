<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?= $titre ?></title>
        <meta charset="utf-8">
        <base href="<?= $racineWeb; ?>">
        <meta name="author" content="pixelhint.com">
        <meta name="description" content="Magnetic is a stunning responsive HTML5/CSS3 photography/portfolio website template"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
        <link rel="stylesheet" type="text/css" href="<?= $racineWeb ?>Contenu/css/reset.css">
        <link rel="stylesheet" type="text/css" href="<?= $racineWeb ?>Contenu/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?= $racineWeb ?>Contenu/css/table.css">
        <link rel="stylesheet" href="<?= $racineWeb ?>Contenu/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?= $racineWeb ?>Contenu/css/custom.css">
        <script src="<?= $racineWeb ?>Contenu/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript" src="<?= $racineWeb ?>contenu/js/jquery.js"></script>
        <script type="text/javascript" src="<?= $racineWeb ?>contenu/js/main.js"></script>
        <script type="text/javascript" src="<?= $racineWeb ?>contenu/js/custom.js"></script>
    </head>

    <body>

        <div id="accueil"></div>

        <?= $contenu ?>

        <footer>
            <div class="footer clearfix">
                <ul class="social clearfix">
                    <li><a target="_blank" href="http://www.facebook.com/sharer.php?u=https://www.google.fr/" class="fb" data-title="Facebook" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a></li>
                    <li><a target="_blank" href="https://plus.google.com/share?url=https://facebook.com" class="google" data-title="Google +" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a></li>
                    <li><a target="_blank" href="https://twitter.com/share?url=https://simplesharebuttons.com" class="twitter" data-title="Twitter" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a></li>
                </ul><!-- end social -->

                <div class="rights">
                    <p><a href="#">Mentions légales</a> - Copyright © Jean Forteroche - 2017 </p>
                    <p>Template by <a href="http://pixelhint.com/" target="_blank">Pixelhint.com</a> modifié par <a href="http://adriendesmet.com" target="_blank">Adrien Desmet</a></p>
                </div><!-- end rights -->
            </div ><!-- end footer -->
        </footer>
    </body>
    <script>
        // Affichage du formulaire de contact après clic sur répondre (details articles)
        $('button.repondre').click(function(){
            $(".formRepondre[data-to='"+$(this).data('to')+"']").show(0);
        });
    </script>
</html>