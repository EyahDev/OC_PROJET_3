<?php $this->titre = 'Jean Forteroche - Lettres d\'Alaska'; ?>

<div id="accueil" class="contentArticles">
    <?php foreach ($recupCategories AS $categorie) : ?>
        <?php if ($categorie['nbArticles'] != 0) : ?>

    <section class="main clearfix">
                <h1 id="cat<?= $categorie['id'] ?>" class="categorie">
                    <a href="<?= "categorie/index/" . $categorie['id'].'/1' ?>"><?= $this->nettoyageFailles($categorie['categorie']) ?></a>
                    <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                        <a class="voleeAdmin" href="<?= "categorieAdmin/modification/" . $categorie['id'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <?php endif; ?>
                </h1>
        <?php endif; ?>
        <?php foreach ($recupArticles AS $affichageArticle) : ?>
            <?php if ($affichageArticle['categorie_id'] == $categorie['id']) : ?>
                <div class="work">
                    <a href="<?= "article/index/" . $affichageArticle['id'] ?>">
                        <img src="<?= $this->nettoyageFailles($affichageArticle['url_img_tuiles']) ?>" class="media" alt=""/>
                        <div class="caption">
                            <div class="work_title">
                                <h1><?= $this->nettoyageFailles($affichageArticle['titre']); ?></h1>
                            </div>
                            <p class="vignDate"><i class="fa fa-calendar-o" aria-hidden="true"></i> <time><?= $affichageArticle['article_date']?></time></p>
                            <p class="vignCom"><i class="fa fa-comment" aria-hidden="true"></i> <?= $affichageArticle['nbCom']?> commentaire(s)</p>
                        </div>
                    </a>
                </div>
            <?php endif; ?>

        <?php endforeach; ?>
        <?php if ($categorie['nbArticles'] == 12) : ?>
        <h3 class="allArticles"><a href="<?= "categorie/index/" . $categorie['id'].'/1' ?>"><< Accéder à tous les articles (<?= $categorie['nbArticles']?>) >></a></h3>
        <?php endif;?>
    </section><!-- end main -->
    <?php endforeach; ?>
<div>



    <section class="main clearfix">
        <h1 id="derniersCom" class="categorie">Derniers commentaires</h1>
        <div id="comContenu">

<?php if ($derniersComs->rowCount()) : ?>

    <?php foreach ($derniersComs as $affichageDerniersComs) :?>
            <div class="comAccueil">
                <p><a href="<?='article/index/' .$affichageDerniersComs['article_id']. '#commentaires' ?>"><?= $this->nettoyageFailles($affichageDerniersComs['titre']) ?></a></p>
                <p><?= $this->nettoyageFailles($affichageDerniersComs['auteur']) ?></p>
                <p><?= $this->nettoyageFailles($affichageDerniersComs['contenu']) ?></p>
                <p><time><?= $affichageDerniersComs['com_date']?></time></p>
            </div>
    <?php endforeach; ?>

<?php else : ?>
        <div class="comAccueil">
            <p>Aucun commentaires n'a encore été écrit</p>
        </div>
<?php endif; ?>
        </div>
</section>

<section class="main clearfix">
    <div>
        <h1 id="aPropos" class="categorie">
            A propos de l'auteur
            <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                <a class="voleeAdmin" href="profiladmin/apropos"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <?php endif; ?>
        </h1>
        <div id="aProposContenu">
            <img id="imgPresentation" src="<?= $this->nettoyageFailles($aPropos['url_img_apropos']) ?>" class="media" alt=""/>
            <div id="textPresentation">
                <?= $aPropos['apropos'] ?>
            </div>
        </div>
    </div>
</section>

<section class="main clearfix">
    <h1 id="contact" class="categorie">Contact</h1>
    <div class="content" id="contactForm">
        <?= $messageConfirmation ?>
        <form action="accueil/mailContact" method="POST">
            <label for="nomPrenom">Votre nom et prénom</label><br/>
            <input type="text" name="nomPrenom" id="nomPrenom"><br/>
            <label for="mail">Votre adresse mail</label><br/>
            <input type="email" name="mail" id="mail"><br/>
            <label for="sujet">Votre sujet</label><br/>
            <input type="text" name="sujet" id="sujet"><br/>
            <label for="messageContact">Votre message</label><br/>
            <textarea name="messageContact" id="messageContact" cols="30" rows="50" required><?= (isset($_SESSION['SaveMessage']))? $_SESSION['SaveMessage'] : '' ?></textarea><br/>
            <input type="submit" value="Envoyer">
            <input type="reset" value="Réinitialiser le formulaire">
        </form>
    </div>
</section>