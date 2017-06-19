<?php $this->titre = 'Jean Forteroche - Lettres d\'Alaska'; ?>

<?php include 'Vue/navAccueil.php'?>

<section class="main clearfix">
<?php foreach ($recupCategories AS $categorie) : ?>
    <?php if ($categorie['nbArticles'] != 0) : ?>
    <h1 id="alaska" class="categorie">
        <a style="text-decoration: none" href="<?= "categorie/index/" . $categorie['id'] ?>"><?= $this->nettoyageFailles($categorie['categorie']) ?></a>
        <?php if(isset($_SESSION['idUtilisateur'])) : ?>
        <a style="font-size: 18px" href="<?= "categorieAdmin/modification/" . $categorie['id'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        <?php endif; ?>
    </h1>
    <?php endif; ?>
    <?php foreach ($recupBillets AS $affichageBillet) : ?>
        <?php if ($affichageBillet['categorie_id'] == $categorie['id']) : ?>
        <div class="work">
            <a href="<?= "billet/index/" . $affichageBillet['id'] ?>">
                <img src="<?= $this->nettoyageFailles($affichageBillet['url_img_tuiles']) ?>" class="media" alt=""/>
                <div class="caption">
                    <div class="work_title" style="margin-bottom:50px;">
                        <h1><?= $this->nettoyageFailles($affichageBillet['titre']); ?></h1>
                    </div>
                    <p class="vignDate"><i class="fa fa-calendar-o" aria-hidden="true"></i> <time><?= $affichageBillet['billet_date']?></time></p>
                    <p class="vignCom"><i class="fa fa-comment" aria-hidden="true"></i> <?= $affichageBillet['nbCom']?> commentaire(s)</p>
                </div>
            </a>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>

<?php endforeach; ?>
</section><!-- end main -->

<section>
    <h1 id="derniersCom" class="categorie">Derniers commentaires</h1>
    <div id="comContenu">

<?php if ($derniersComs->rowCount()) : ?>

    <?php foreach ($derniersComs as $affichageDerniersComs) :?>
            <div class="comAccueil">
                <p><a href="<?='billet/index/' .$affichageDerniersComs['billet_id']. '#commentaires' ?>"><?= $this->nettoyageFailles($affichageDerniersComs['titre']) ?></a></p>
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

<section>
    <div>
        <h1 id="aPropos" class="categorie">
            A propos de l'auteur
            <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                <a style="font-size: 18px" href="profiladmin/apropos"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <?php endif; ?>
        </h1>
        <div id="aProposContenu" style="text-align: center">
            <img id="imgPresentation" src="<?= $this->nettoyageFailles($aPropos['url_img_apropos']) ?>" class="media" alt=""/>
            <div id="textPresentation">
                <?= $aPropos['apropos'] ?>
            </div>
        </div>
    </div>
</section>

<section>
    <h1 id="contact" class="categorie">Contact</h1>
    <div id="contactForm">
        <form action="">
            <label for="mail">Votre adresse mail</label><br/>
            <input type="email" name="mail" id="mail"><br/>
            <label for="sujet">Sujet</label><br/>
            <input type="text" name="sujet" id="sujet"><br/>
            <label for="contenuMessage">Votre message</label><br/>
            <textarea name="contenuMessage" id="contenuMessage" cols="30" rows="50"></textarea><br/>
            <input type="submit" value="Envoyer">
            <input type="reset" value="Réinitialiser le formulaire">
        </form>
    </div>
</section>