<?php $this->titre = "Jean Forteroche - Nouvel article"; ?>

<section class="main clearfix">
    <section class="top bgAdmin">
        <div class="wrapper content_header clearfix ">
            <div class="work_nav">

                <ul class="btn clearfix">
                    <li><a href="admin" class="previous" data-title="Retour"></a></li>
                </ul>

            </div><!-- end work_nav -->
            <h1 class="title">Rédaction d'un nouvel article</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content contentCatAdmin">
            <?= $messageFlash ?>
            <form action="nouvelarticle/publication" method="POST">
                <input type="hidden" name="auteurNvArticle" value="<?= $_SESSION['idUtilisateur']?>">
                <label for="titreNvArticle">Titre de l'article</label>

                <input type="text" name="titreNvArticle" id="titreNvArticle" <?= (isset($_SESSION['SaveTitre']))? 'value="'.$_SESSION['SaveTitre'].'"' : '' ?> />
                <br />

                <label for="categorieNvArticle">Catégorie</label><br/ >
                <div class="select-style" style="display: inline-block">
                    <select name="categorieNvArticle" id="categorieNvArticle">
                        <option value="">-- Sélectionner la catégorie de l'article --</option>
                        <?php foreach ($categories as $categorie) : ?>
                            <option value="<?= $categorie['id'] ?>"><?= $categorie['categorie'] ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <p>ou <a href="categorieadmin">Créer une catégorie</a></p>

                <label for="NvArticleUrlTuile">URL de l'image de l'accueil <br/>
                    <strong>Attention : </strong> L'image doit avoir une taille d'environ <strong>466x466px</strong> sous peine d'avoir des problèmes d'affichage.<br/>
                </label>
                <input type="url" id="NvArticleUrlTuile" name="urlTuile" placeholder="Une image par défaut sera générée si vous n'en avez pas" />
                <br />

                <label for="NvArticleUrlPres">URL de L'image de l'article <br/>
                    <strong>Attention : </strong> l'image doit avoir une taille d'environ <strong>1300x500px</strong> sous peine d'avoir des problèmes d'affichage.<br/>
                </label>
                <input type="url" id="NvArticleUrlPres" name="urlPres" placeholder="Une image par défaut sera générée si vous n'en avez pas" />
                <br />

                <label for="contenuNvArticle">Contenu de l'article</label>
                <textarea class="tinyMCE" name="contenuNvArticle" id="contenuNvArticle" style="height: 500px"><?= (isset($_SESSION['SaveNvContenu']))? $_SESSION['SaveNvContenu'] : '' ?></textarea>
                <br />

                <button class="buttonRepondre" type="submit">Publier</button>
            </form>
        </div><!-- end content -->
    </section>
</section><!-- end main -->