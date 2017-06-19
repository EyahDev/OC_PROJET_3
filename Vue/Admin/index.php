<?php $this->titre = "Jean Forteroche - Administration";?>

<?php include 'Vue/nav.php'?>

<section class="main clearfix">
    <section class="top" style="background: url(Contenu/img/Design-tips-ebook-1-1032x581.png), no-repeat, center, fixed; background-size: cover">
        <div class="wrapper content_header clearfix infoCategorie">
            <h1 class="title">Administration</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content" style="margin-right: auto; margin-left: auto; text-align: center">

            <p>Bienvenu(e) sur votre espace d'administration, <?= $login ?></p>
            <?php if ($nbSignalement['count'] != 0) : ?>
                <?php if ($nbSignalement['count'] == 1) : ?>
                    <p><a href="signalement" style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?= $nbSignalement['count'] ?> commentaire a été signalé ! <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a></p>
                    <?php else : ?>
                    <p><a href="signalement" style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?= $nbSignalement['count'] ?> commentaires ont été signalés ! <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a></p>
                <?php endif; ?>
            <?php endif;?>
            <?= $messageConfirmation ?>

            <div class="tuileAdmin">
                <a href="signalement">
                    <div class="contenuTuileAdmin">
                        <i style="font-size: 50px;" class="fa fa-comments iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modération des commentaires</p>
                    </div>
                </a>
            </div>

            <div class="tuileAdmin">
                <a href="nouveauBillet">
                    <div class="contenuTuileAdmin">
                        <i style="font-size: 50px;" class="fa fa-pencil iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Nouvel article</p>
                    </div>
                </a>
            </div>


            <div class="tuileAdmin">
                <a href="gestionbillets">
                    <div class="contenuTuileAdmin">
                        <i style="font-size: 50px;" class="fa fa-pencil-square-o iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Gerer les articles</p>
                    </div>
                </a>
            </div>

            <div class="tuileAdmin">
                <a href="categorieadmin">
                    <div class="contenuTuileAdmin">
                        <i style="font-size: 50px;" class="fa fa-tags iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Gerer les catégories</p>
                    </div>
                </a>
            </div>

            <div class="tuileAdmin">
                <a href="profiladmin">
                    <div class="contenuTuileAdmin">
                        <i style="font-size: 50px;" class="fa fa-user iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modifier son profil</p>
                    </div>
                </a>
            </div>

            <div class="tuileAdmin" style="display: block; margin-left: auto; margin-right: auto">
                <a href="connexion/deconnecter">
                    <div class="contenuTuileAdmin">
                        <i style="font-size: 50px;" class="fa fa-sign-out iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Se deconnecter</p>
                    </div>
                </a>
            </div>
        </div><!-- end content -->
    </section>

</section><!-- end main -->