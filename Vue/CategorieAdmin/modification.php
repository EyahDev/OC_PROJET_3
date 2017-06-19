<?php $this->titre = "Jean Forteroche - Modifier une catégorie"?>

<?php include 'Vue/nav.php'?>

<section class="main clearfix">
    <section class="top" style="background: url(Contenu/img/Design-tips-ebook-1-1032x581.png), no-repeat, center, fixed; background-size: cover">
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
        <div class="content" style="margin-right: auto; margin-left: auto;">
            <h3>Modification de la catégorie : <?= $categorie['categorie']?></h3>
            <form action="categorieAdmin/modifier" method="POST">
                <input type="hidden" name="idCategorie" value="<?= $categorie['id']?>" />
                <label for="ModifCategorie">Nom de la catégorie</label><br/>
                <input type="text" name="ModifCategorie" id="ModifCategorie" value="<?= $categorie['categorie']?>"/>
                <label for="categorieURLPres">URL de l'image de présentation de la catatégorie<br/>
                    <strong>Attention : </strong> l'image doit avoir une taille d'environ <strong>1300x500px</strong> sous peine d'avoir des problèmes d'affichage.<br/>
                </label>
                <input type="text" id="categorieURLPres" name="ModifCategorieURLPres" placeholder="Une image par défaut sera généré si vous n'en avez pas" value="<?= ($categorie['url_img_pres'] == 'Contenu/img/default/cat_pres_default.jpg')? '' : $categorie['url_img_pres'] ?>" />
                <input style="display:inline-block; width: 80px; cursor: pointer;" type="submit" value="Modifier">
            </form>
        </div><!-- end content -->
    </section>

</section><!-- end main -->