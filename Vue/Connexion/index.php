<?php $this->titre  = "Jean Forteroche - Administration : Connexion"?>

<section class="main clearfix">

    <section class="top bgAdmin">
        <div class="wrapper content_header clearfix">
            <div class="work_nav">

            </div><!-- end work_nav -->
            <div class="infoArticle">
                <h1 class="title">Administration</h1>
            </div>
        </div>
    </section><!-- end top -->
    <section class="wrapper">
        <div class="content contentAdmin">
            <p>Vous devez être connecté pour accéder à cette zone, veuillez vous identifier.</p>
            <?= $messageErreur ?>
            <form action="connexion/connecter" method="POST">
                <input type="text" name="login" placeholder="Entrez votre login" autofocus/>
                <input type="password" name="password" placeholder="Entrez votre mot de passe" />
                <button class="buttonRepondre" type="submit">Connexion</button>
            </form>
        </div><!-- end content -->
    </section>
</section><!-- end main -->