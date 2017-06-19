<?php $this->titre  = "Jean Forteroche - Modifier son profil"; ?>

<?php include 'Vue/nav.php'?>

<section class="main clearfix">
    <section class="top" style="background: url(Contenu/img/Design-tips-ebook-1-1032x581.png), no-repeat, center, fixed; background-size: cover">
        <div class="wrapper content_header clearfix infoCategorie">
            <div class="work_nav">
                <ul class="btn clearfix">
                    <li><a href="admin" class="previous" data-title="Retour"></a></li>
                </ul>
            </div><!-- end work_nav -->
            <h1 class="title">Modifier son profil</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content" style="margin-right: auto; margin-left: auto; text-align: center">
            <h3>Modifier les informations utilisateur</h3>
            <?= $messageConfirmation ?>

            <div class="tuileAdmin">
                <a href="profiladmin/utilisateur">
                    <div class="contenuTuileAdmin">
                        <i style="font-size: 50px;" class="fa fa-user iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modifier votre nom d'utilisateur</p>
                    </div>
                </a>
            </div>
            <div class="tuileAdmin">
                <a href="profiladmin/password">
                    <div class="contenuTuileAdmin">
                        <i style="font-size: 50px;" class="fa fa-key iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modifier votre mot de passe</p>
                    </div>
                </a>
            </div>
            <div class="tuileAdmin">
                <a href="profiladmin/auteur">
                    <div class="contenuTuileAdmin">
                        <i style="font-size: 50px;" class="fa fa-user-secret iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modifier votre nom d'auteur</p>
                    </div>
                </a>
            </div>

            <div class="tuileAdmin">
                <a href="profiladmin/apropos">
                    <div class="contenuTuileAdmin">
                        <i style="font-size: 50px;" class="fa fa-pencil-square-o iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modifier A propos</p>
                    </div>
                </a>
            </div>
        </div><!-- end content -->
    </section>
</section><!-- end main -->