<?php $this->titre = "Jean Forteroche - Modifier le nom d'auteur"?>

<?php include 'Vue/nav.php'?>

<section class="main clearfix">
    <section class="top" style="background: url(Contenu/img/Design-tips-ebook-1-1032x581.png), no-repeat, center, fixed; background-size: cover">
        <div class="wrapper content_header clearfix infoCategorie">
            <div class="work_nav">
                <ul class="btn clearfix">
                    <li><a href="profiladmin" class="previous" data-title="Retour"></a></li>
                    <li><a href="admin" class="grid" data-title="Administration"></a></li>
                </ul>
            </div><!-- end work_nav -->
            <h1 class="title">Modifier le nom d'auteur</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content" style="margin-right: auto; margin-left: auto; text-align: center">
            <h3>Modification de votre nom d'auteur</h3>
            <form action="profiladmin/modifierAuteur" method="POST">
                <input style="display:inline-block; width: 80%" type="text" name="nvNomAuteur" value="<?= $this->nettoyageFailles($infoUtilisateur['pseudo_auteur']) ?>"/>
                <input type="hidden" name="idUtilisateur" value="<?= $infoUtilisateur['id']?>" />
                <input style="display:inline-block; width: 80px; cursor: pointer;" type="submit" value="Modifier" />
            </form>
        </div><!-- end content -->
    </section>
</section><!-- end main -->