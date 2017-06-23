<?php $this->titre = "Jean Forteroche - Modifier l'adresse mail"?>

<section class="main clearfix">
    <section class="top bgAdmin">
        <div class="wrapper content_header clearfix infoCategorie">
            <div class="work_nav">
                <ul class="btn clearfix">
                    <li><a href="profiladmin" class="previous" data-title="Retour"></a></li>
                    <li><a href="admin" class="grid" data-title="Administration"></a></li>
                </ul>
            </div><!-- end work_nav -->
            <h1 class="title">Modifier votre adresse mail</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content contentAdmin">
            <h3>Modification de votre mot de passe</h3>
            <?= $messageFlash ?>
            <form action="profiladmin/modifierMail" method="POST">
                <p>Saisissez votre nouvelle adresse mail</p>
                <input type="email" name="nvMail" value="<?= $this->nettoyageFailles($infoUtilisateur['mail']) ?>"/>
                <input type="hidden" name="idUtilisateur" value="<?= $infoUtilisateur['id'] ?>" />
                <button class="buttonRepondre" type="submit" value="Modifier" />Modifier</button>
            </form>
        </div><!-- end content -->
    </section>

</section><!-- end main -->