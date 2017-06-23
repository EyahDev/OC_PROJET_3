<?php $this->titre = "Jean Forteroche - Modification d'un article"; ?>


<section class="main clearfix">
    <section class="top bgAdmin">
        <div class="wrapper content_header clearfix ">
            <div class="work_nav">

                <ul class="btn clearfix">
                    <li><a href="gestionarticles" class="previous" data-title="Retour"></a></li>
                    <li><a href="admin" class="grid" data-title="Administration"></a></li>
                </ul>

            </div><!-- end work_nav -->
            <h1 class="title">Modification d'un article</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content contentCatAdmin">
            <?= $messageFlash ?>
            <form action="gestionarticles/publication" method="POST">
                <input type="hidden" name="id" value="<?= $affichageArticle['id']?>"/>
                <label for="titreModifArticle">Titre de l'article</label>
                <input type="text" name="titreModifArticle" id="titreModifArticle" value="<?= $this->nettoyageFailles($affichageArticle['titre']) ?>" />
                <br />

                <label for="categorieNvArticle">Catégorie</label>
                <div class="select-style">
                    <select name="categorieModifArticle" id="categorieNvArticle">
                        <option value="">-- Selectionnez la catégorie de l'article --</option>
                        <?php foreach ($categories as $categorie) : ?>
                            <option value="<?= $categorie['id'] ?>"<?= ($categorie['id'] == $affichageArticle['categorie_id'])? 'selected': '' ?>><?= $this->nettoyageFailles($categorie['categorie']) ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <p>ou <a href="categorieadmin">Créer une catégorie</a></p>

                <label for="ModifArticleUrlTuile">URL de l'image de l'accueil <br/>
                    <strong>Attention : </strong> l'image doit avoir une taille d'environ <strong>466x466px</strong> sous peine d'avoir des problèmes d'affichage.
                </label>
                <input type="text" id="ModifArticleUrlTuile" name="urlTuile" value="<?= ($this->nettoyageFailles($affichageArticle['url_img_tuiles']) == 'Contenu/img/default/tuile_default.jpg')? '' : $this->nettoyageFailles($affichageArticle['url_img_tuiles']) ?>" placeholder="Une image par défaut sera généré si vous n'en avez pas"/>
                <br />

                <label for="ModifArticleUrlPres">URL de l'image de l'article <br/>
                    <strong>Attention : </strong> l'image doit avoir une taille d'environ <strong>1300x500px</strong> sous peine d'avoir des problèmes d'affichage.
                </label>
                <input type="text" id="ModifArticleUrlPres" name="urlPres" value="<?= ($this->nettoyageFailles($affichageArticle['url_img_pres']) == 'Contenu/img/default/pres_default.jpg')? '' : $this->nettoyageFailles($affichageArticle['url_img_tuiles']) ?>" placeholder="Une image par défaut sera généré si vous n'en avez pas" />
                <br />

                <label for="contenuArticleModif">Contenu de l'article</label>
                <textarea class="tinyMCE" name="contenuArticleModif" id="contenuArticleModif" style="height: 500px">
                    <?= (isset($_SESSION['SaveContenu'.$affichageArticle['id']]) ? ($_SESSION['SaveContenu'.$affichageArticle['id']] == $affichageArticle['contenu']? $affichageArticle['contenu'] : $_SESSION['SaveContenu'.$affichageArticle['id']]) : $affichageArticle['contenu'] ) ?>
                </textarea>
                <br />

                <button class="buttonRepondre" type="submit">Mettre à jour</button>
                <a class="supprimerModifArt" href="<?= "gestionArticles/suppression/" . $affichageArticle['id'] ?>"><i class="fa fa-times" aria-hidden="true"></i> Supprimer</a>
            </form>

        </div><!-- end content -->
    </section>
</section><!-- end main -->