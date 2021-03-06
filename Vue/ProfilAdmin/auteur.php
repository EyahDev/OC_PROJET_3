<?php $this->titre = "Jean Forteroche - Modifier votre nom d'auteur"?>

<section class="main clearfix">
    <section class="top bgAdmin">
        <div class="wrapper content_header clearfix infoCategorie">
            <div class="work_nav">
                <ul class="btn clearfix">
                    <li><a href="profiladmin" class="previous" data-title="Retour"></a></li>
                    <li><a href="admin" class="grid" data-title="Administration"></a></li>
                </ul>
            </div><!-- end work_nav -->
            <h1 class="title">Modifier votre nom d'auteur</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content contentAdmin">
            <h3>Modification de votre nom d'auteur</h3>
            <?= $messageFlash ?>
            <form action="profiladmin/modifierAuteur" method="POST">
                <input id="inlineInput" type="text" name="nvNomAuteur" value="<?= $this->nettoyageFailles($infoUtilisateur['pseudo_auteur']) ?>"/>
                <input type="hidden" name="idUtilisateur" value="<?= $infoUtilisateur['id']?>" />
                <input id="inlineButton" type="submit" value="Modifier" />
            </form>
        </div><!-- end content -->
    </section>
</section><!-- end main -->