<?php $this->titre = 'Jean Forteroche - Détail du commentaire'; ?>

<?php include 'Vue/nav.php'?>

<section class="main clearfix">
    <section class="top" style="background: url(Contenu/img/Design-tips-ebook-1-1032x581.png), no-repeat, center, fixed; background-size: cover">
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
        <div class="content" style="margin-right: auto; margin-left: auto; text-align: center">

            <?php if ($details['moderation'] == 1) : ?>
                <p><strong>Ce commentaire a été signalé <?= $details['signalement'] ?> fois et a déjà été modéré.</strong></p>
            <?php else : ?>
                <p><strong>Ce commentaire a été signalé <?= $details['signalement'] ?> fois.</strong></p>
            <?php endif; ?>

            <div id="auteur" class="details">
                <h4>Auteur</h4>
                <p><?= $details['auteur']?></p>
            </div>

            <div id="billet" class="details">
                <h4>Titre du billet concerné</h4>
                <p><?= $details['titre']?></p>
            </div>

            <div id="contenu" class="details">
                <h4>Commentaire</h4>
                <p><?= $details['contenu']?></p>
            </div>

            <?php if ($details['moderation'] == 1) : ?>
                <p style="display: inline-block;"><a href="<?= "signalement/suppression/" . $details['id']?>" style="color: red;"><i class="fa fa-times" aria-hidden="true"></i> Supprimer</a></p>
            <?php else : ?>
                <p style="display: inline-block; margin-right: 15px"><a href="<?= "signalement/approuver/" . $details['id']?>" style="color: green;"><i class="fa fa-check" aria-hidden="true"></i> Approuvé</a></p>
                <p style="display: inline-block; margin-left: 15px"><a href="<?= "signalement/suppression/" . $details['id']?>" style="color: red;"><i class="fa fa-times" aria-hidden="true"></i> Supprimer</a></p>
            <?php endif; ?>

        </div><!-- end content -->
    </section>
</section><!-- end main -->