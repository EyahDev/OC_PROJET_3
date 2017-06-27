<?php $this->titre = "Jean Forteroche - Modifier une catégorie"?>

<section class="main clearfix">
    <section class="top bgAdmin">
        <div class="wrapper content_header clearfix infoCategorie">
            <div class="work_nav">
                <ul class="btn clearfix">
                    <li><a href="categorieadmin" class="previous" data-title="Retour"></a></li>
                    <li><a href="admin" class="grid" data-title="Administration"></a></li>
                </ul>
            </div><!-- end work_nav -->
            <h1 class="title">Modifier une catégorie</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content contentCatAdmin">
            <h3>Modification de la catégorie : <?= $this->nettoyageFailles($categorie['categorie']) ?></h3>
            <?= $messageFlash ?>
            <form action="categorieAdmin/modifier" method="POST">
                <input type="hidden" name="idCategorie" value="<?= $categorie['id']?>" />
                <label for="ModifCategorie">Nom de la catégorie</label><br/>
                <input type="text" name="ModifCategorie" id="ModifCategorie" value="<?= $this->nettoyageFailles($categorie['categorie']) ?>"/>
                <label for="categorieURLPres">URL de l'image de présentation de la catégorie<br/>
                    <strong>Attention : </strong> L'image doit avoir une taille d'environ <strong>1300x500px</strong> sous peine d'avoir des problèmes d'affichage.<br/>
                </label>
                <input type="text" id="categorieURLPres" name="ModifCategorieURLPres" placeholder="Une image par défaut sera générée si vous n'en avez pas" value="<?= ($this->nettoyageFailles($categorie['url_img_pres']) == 'Contenu/img/default/cat_pres_default.jpg')? '' : $this->nettoyageFailles($categorie['url_img_pres']) ?>" />
                <button class="buttonRepondre" type="submit">Modifier</button>
            </form>
        </div><!-- end content -->
    </section>

</section><!-- end main -->