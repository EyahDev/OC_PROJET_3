<?php $this->titre  = "Jean Forteroche - Modifier son profil"; ?>

<section class="main clearfix">
    <section class="top bgAdmin">
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
        <div class="content contentAdmin">
            <h3>Modifier les informations utilisateur</h3>
            <?= $messageConfirmation ?>

                <a href="profiladmin/utilisateur" class="tuileAdmin">
                    <div class="contenuTuileAdmin">
                        <i class="fa fa-user iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modifier votre nom d'utilisateur</p>
                    </div>
                </a>

                <a href="profiladmin/password" class="tuileAdmin">
                    <div class="contenuTuileAdmin">
                        <i class="fa fa-key iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modifier votre mot de passe</p>
                    </div>
                </a>

                <a href="profiladmin/mail"class="tuileAdmin">
                    <div class="contenuTuileAdmin" >
                        <i class="fa fa-envelope iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modifier votre adresse mail</p>
                    </div>
                </a>

                <a href="profiladmin/auteur" class="tuileAdmin">
                    <div class="contenuTuileAdmin">
                        <i class="fa fa-user-secret iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modifier votre nom d'auteur</p>
                    </div>
                </a>

                <a href="profiladmin/apropos" class="tuileAdmin">
                    <div class="contenuTuileAdmin">
                        <i class="fa fa-pencil-square-o iconeAdmin" aria-hidden="true"></i>
                        <p class="titreFonction">Modifier A propos</p>
                    </div>
                </a>
        </div><!-- end content -->
    </section>
</section><!-- end main -->