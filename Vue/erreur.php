<?php $this->titre = "Jean Forteroche - Erreur"; ?>

<section class="main clearfix">
    <section class="top bgErreur">
        <div class="wrapper content_header clearfix">
            <h1 class="title">Erreur : la page demandée n'existe pas</h1>
        </div>
    </section><!-- end top -->

        <section class="wrapper">
            <div class="content">
                <p>Oops nous voulions vous montrer quelques choses mais il y a eu un petit problème, <a href="accueil">retour à l'accueil</a></p>
                <button class="repondre" id="details" data-to="erreur">Plus de détails</button>
                <p class="formRepondre" id="detailsErreur" data-to="erreur"><?= $msgErreur ?></p>
            </div><!-- end content -->
        </section>

</section>


