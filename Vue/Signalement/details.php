<?php $this->titre = 'Jean Forteroche - Détail du commentaire'; ?>

<section class="main clearfix">
    <section class="top bgAdmin">
        <div class="wrapper content_header clearfix ">
            <div class="work_nav">

                <ul class="btn clearfix">
                    <li><a href="signalement" class="previous" data-title="Retour"></a></li>
                    <li><a href="admin" class="grid" data-title="Administration"></a></li>
                </ul>

            </div><!-- end work_nav -->
            <h1 class="title">Détail du commentaire</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content contentAdmin">

            <?php if ($details['moderation'] == 1) : ?>
                <p><strong>Ce commentaire a été signalé <?= $details['signalement'] ?> fois et a déjà été approuvé.</strong></p>
            <?php else : ?>
                <p><strong>Ce commentaire a été signalé <?= $details['signalement'] ?> fois.</strong></p>
            <?php endif; ?>

            <p id="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Attention supprimer un commentaire supprimera également les réponses associées <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></p>

            <div id="auteur" class="details">
                <h4>Auteur</h4>
                <p><?= $this->nettoyageFailles($details['auteur'])?></p>
            </div>

            <div id="article" class="details">
                <h4>Titre de l'article concerné</h4>
                <p><?= $details['titre']?></p>
            </div>

            <div id="contenu" class="details">
                <h4>Commentaire</h4>
                <p><?= $this->nettoyageFailles($details['contenu']) ?>
                    <?php if ($details['reponse_id']) : ?>
                <hr/>
                En réponse à <strong><?= $this->nettoyageFailles( $reponse['auteur']) ?></strong>
                <hr>
                <?= $this->nettoyageFailles($reponse['contenu']) ?> <br />
                <?php endif; ?>
                </p>
            </div>

            <?php if ($details['moderation'] == 1) : ?>
                <p id="action"><a href="<?= "signalement/suppression/" . $details['id']?>"class="rouge"><i class="fa fa-times" aria-hidden="true"></i> Supprimer</a></p>
            <?php else : ?>
                <p id="actionR"><a href="<?= "signalement/approuver/" . $details['id']?>" class="vert"><i class="fa fa-check" aria-hidden="true"></i> Approuver</a></p>
                <p id="actionL"><a href="<?= "signalement/suppression/" . $details['id']?>" class="rouge"><i class="fa fa-times" aria-hidden="true"></i> Supprimer</a></p>
            <?php endif; ?>

        </div><!-- end content -->
    </section>
</section><!-- end main -->