<?php $this->titre = 'Jean Forteroche - Lettres d\'Alaska'; ?>

<?php include 'Vue/navAccueil.php'?>

<div id="accueil"></div>

<?php foreach ($recupCategories AS $categorie) : ?>
    <?php if ($categorie['nbArticles'] != 0) : ?>
<section class="main clearfix">
            <h1 id="alaska" class="categorie">
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
    <div class="work">
        <a href="<?= "categorie/index/" . $categorie['id'] ?>">
            <img src="Contenu/img/default/suite.png" class="media" alt=""/>
            <div class="caption">
                <div class="work_title">
                </div>
            </div>
        </a>
    </div>
</section><!-- end main -->
<?php endforeach; ?>


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
    <div id="contactForm">
        <?= $messageConfirmation ?>
        <form action="accueil/mailContact" method="POST">
            <label for="mail">Votre adresse mail</label><br/>
            <input type="email" name="mail" id="mail" required><br/>
            <label for="sujet">Sujet</label><br/>
            <input type="text" name="sujet" id="sujet" required><br/>
            <label for="messageContact">Votre message</label><br/>
            <textarea name="messageContact" id="messageContact" cols="30" rows="50" required></textarea><br/>
            <input type="submit" value="Envoyer">
            <input type="reset" value="Réinitialiser le formulaire">
        </form>
    </div>
</section>