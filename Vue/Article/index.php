<?php $this->titre = "Jean Forteroche - " . $this->nettoyageFailles($affichageArticle['titre']); ?>

<section class="main clearfix">

    <section class="top" style="background: url(<?= $affichageArticle['url_img_pres'] ?>) no-repeat, fixed, center; background-size: cover">
        <div class="wrapper content_header clearfix">
            <div class="work_nav">

                <ul class="btn clearfix">

                    <?php if ($prev == false) : ?>
                    <?php else : ?>
                        <li><a href="<?= 'article/index/'.$prev ?>" class="previous" data-title="Précédent"></a></li>
                    <?php endif; ?>

                    <li><a href="<?= 'categorie/index/' .$affichageArticle['categorie_id']. '/1' ?>" class="grid" data-title="Articles de la catégorie"></a></li>

                    <?php if ($next == false) : ?>
                    <?php else : ?>
                        <li><a href="<?= 'article/index/'.$next ?>" class="next" data-title="Suivant"></a></li>
                    <?php endif; ?>

                </ul>

            </div><!-- end work_nav -->
            <div class="infoArticle">
                <h1 class="title">
                    <?= $this->nettoyageFailles($affichageArticle['titre']); ?>
                    <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                        <a class="voleeAdmin" href="<?= "gestionarticles/modification/" .$affichageArticle['id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <?php endif; ?>
                </h1>
                <p>
                    <i class="fa fa-calendar-o" aria-hidden="true"></i> <?= $affichageArticle['article_date']?>
                    <a href="index.php#aPropos"><i class="fa fa-user iconPresArticle" aria-hidden="true"></i> <?= $this->nettoyageFailles($affichageArticle['pseudo_auteur']) ?></a>
                    <a href="<?= 'article/index/' .$affichageArticle['id'] ?>#commentaires"><i class="fa fa-comment iconPresArticle" aria-hidden="true"></i> <?= $affichageArticle['nbCom'] ?> commentaire(s) </a>
                    <a href="<?= 'categorie/index/' .$affichageArticle['categorie_id']. '/1' ?>"><i class="fa fa-tag iconPresArticle" aria-hidden="true"></i> <?= $this->nettoyageFailles($affichageArticle['categorie']) ?></a></p>
            </div>
        </div>
    </section><!-- end top -->
    <section class="wrapper">
        <div class="content">
            <?= $affichageArticle['contenu']; ?>
        </div><!-- end content -->
    </section>
    <section class="wrapper">
        <div class="content" style="text-align: right">
            <a target="_blank" href="http://www.facebook.com/sharer.php?u=https://projet3.adriendesmet.com/article/index/<?= $affichageArticle['id'] ?>" class="facebook" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                <i class="fa fa-facebook-square" aria-hidden="true"></i>
            </a>
            <a target="_blank" href="https://plus.google.com/share?url=https://projet3.adriendesmet.com/article/index/<?= $affichageArticle['id'] ?>" class="googlePlus" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                <i class="fa fa-google-plus-square" aria-hidden="true"></i>
            </a>
            <a target="_blank" href="https://twitter.com/share?url=https://projet3.adriendesmet.com/article/index/<?= $affichageArticle['id'] ?>" class="twit"  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                <i class="fa fa-twitter-square" aria-hidden="true"></i>
            </a>

        </div><!-- end content -->
    </section>
    <section class="wrapper">
        <div class="content">
            <h2 class="titreCom" id="commentaires">
                COMMENTAIRES
                <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                    <a class="voleeAdmin" href="signalement"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <?php endif; ?>
            </h2>
            <?= $messageConfirmation ?>
            <p>Laisser un commentaire</p>
            <form action="Article/commenter" method="POST">
                <label for="auteurCom">Votre pseudo</label>
                <input type="text" id="auteurCom" name="auteur" />
                <label for="txtCommentaire">Votre commentaire</label>
                <textarea name="contenu" id="txtCommentaire" ></textarea>
                <input type="hidden" name="id" value="<?= $affichageArticle['id'] ?>">
                <input type="hidden" name="reponse" value="">
                <button class="buttonRepondre" type="submit">Commenter</button>
            </form>

    <?php include '__commentaires.php' ?>

        </div>
    </section>
</section><!-- end main -->