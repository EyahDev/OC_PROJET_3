<?php $this->titre = "Jean Forteroche - " . $this->nettoyageFailles($affichageBillet['titre']); ?>

<?php include 'Vue/nav.php'?>

<section class="main clearfix">

    <section class="top" style="background: url(<?= $affichageBillet['url_img_pres'] ?>), no-repeat, fixed, center; background-size: cover">
        <div class="wrapper content_header clearfix">
            <div class="work_nav">

                <ul class="btn clearfix">

                    <?php if ($prev == false) : ?>
                    <?php else : ?>
                        <li><a href="<?= 'billet/index/'.$prev ?>" class="previous" data-title="Précédent"></a></li>
                    <?php endif; ?>

                    <li><a href="<?= 'categorie/index/' .$affichageBillet['categorie_id']?>" class="grid" data-title="Billets de la catégorie"></a></li>

                    <?php if ($next == false) : ?>
                    <?php else : ?>
                        <li><a href="<?= 'billet/index/'.$next ?>" class="next" data-title="Suivant"></a></li>
                    <?php endif; ?>

                </ul>

            </div><!-- end work_nav -->
            <div class="infoBillet">
                <h1 class="title">
                    <?= $this->nettoyageFailles($affichageBillet['titre']); ?>
                    <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                        <a style="font-size: 18px" href="<?= "gestionbillets/modification/" .$affichageBillet['id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <?php endif; ?>
                </h1>
                <p>
                    <i class="fa fa-calendar-o" aria-hidden="true"></i> <?= $affichageBillet['billet_date']?>
                    <a style="text-decoration: none" href="index.php#aPropos"><i style="padding-left: 10px;" class="fa fa-user" aria-hidden="true"></i> <?= $affichageBillet['pseudo_auteur'] ?></a>
                    <a href="<?= 'billet/index/' .$affichageBillet['id']?>#commentaires"><i style="padding-left: 10px;" class="fa fa-comment" aria-hidden="true"></i> <?= $affichageBillet['nbCom'] ?> commentaire(s) </a>
                    <a href="<?= 'categorie/index/' .$affichageBillet['categorie_id']?>"><i style="padding-left: 10px;" class="fa fa-tag" aria-hidden="true"></i> <?= $affichageBillet['categorie'] ?></a></p>
            </div>
        </div>
    </section><!-- end top -->
    <section class="wrapper">
        <div class="content">
            <?= $affichageBillet['contenu']; ?>
        </div><!-- end content -->
    </section>
    <section class="wrapper">
        <div class="content">
            <h2 class="titreCom" id="commentaires">
                COMMENTAIRES
                <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                    <a style="font-size: 18px" href="signalement"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <?php endif; ?>
            </h2>
            <?= $messageConfirmation ?>
            <p>Laisser un commentaire</p>
            <form action="billet/commenter" method="POST">
                <label for="auteurCom">Votre pseudo</label>
                <input type="text" id="auteurCom" name="auteur" required />
                <label for="txtCommentaire">Votre commentaire</label>
                <textarea name="contenu" id="txtCommentaire" required></textarea>
                <input type="hidden" name="id" value="<?= $affichageBillet['id'] ?>">
                <input type="hidden" name="reponse" value="">
                <input type="hidden" name="niveau" value="0">
                <button style="width: 80px;" type="submit">Commenter</button>
            </form>

    <?php include 'commentaires.php'?>

        </div>
    </section>
</section><!-- end main -->