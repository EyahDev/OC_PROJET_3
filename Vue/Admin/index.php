<?php $this->titre = "Jean Forteroche - Administration";?>

<section class="main clearfix">
    <section class="top bgAdmin">
        <div class="wrapper content_header clearfix infoCategorie">
            <h1 class="title">Administration</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content contentAdmin">

            <p>Bienvenu(e) sur votre espace d'administration, <?= $login ?></p>
            <?php if ($nbSignalement['count'] != 0) : ?>
                <?php if ($nbSignalement['count'] == 1) : ?>
                    <p><a href="signalement" class="alertSignalement"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?= $nbSignalement['count'] ?> commentaire a été signalé ! <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a></p>
                    <?php else : ?>
                    <p><a href="signalement" class="alertSignalement"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <?= $nbSignalement['count'] ?> commentaires ont été signalés ! <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a></p>
                <?php endif; ?>
            <?php endif;?>
            <?= $messageConfirmation ?>

                <a href="signalement" class="tuileAdmin">
                    <div class="contenuTuileAdmin">
                        <i class="fa fa-comments iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modération des commentaires</p>
                    </div>
                </a>

                <a href="NouvelArticle" class="tuileAdmin">
                    <div class="contenuTuileAdmin">
                        <i  class="fa fa-pencil iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Nouvel article</p>
                    </div>
                </a>

                <a href="gestionarticles" class="tuileAdmin">
                    <div class="contenuTuileAdmin">
                        <i class="fa fa-pencil-square-o iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Gerer les articles</p>
                    </div>
                </a>

                <a href="categorieadmin" class="tuileAdmin">
                    <div class="contenuTuileAdmin">
                        <i class="fa fa-tags iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Gerer les catégories</p>
                    </div>
                </a>

                <a href="profiladmin" class="tuileAdmin">
                    <div class="contenuTuileAdmin">
                        <i class="fa fa-user iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modifier son profil</p>
                    </div>
                </a>

                <a href="connexion/deconnecter" class="tuileDeco">
                    <div class="contenuTuileAdmin">
                        <i class="fa fa-sign-out iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Se deconnecter</p>
                    </div>
                </a>

        </div><!-- end content -->
    </section>

</section><!-- end main -->