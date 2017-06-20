<?php $this->titre = "Jean Forteroche - Modifier le nom d'utilisateur"?>

<?php include 'Vue/nav.php'?>

<section class="main clearfix">
    <section class="top bgAdmin">
        <div class="wrapper content_header clearfix infoCategorie">
            <div class="work_nav">
                <ul class="btn clearfix">
                    <li><a href="profiladmin" class="previous" data-title="Retour"></a></li>
                    <li><a href="admin" class="grid" data-title="Administration"></a></li>
                </ul>
            </div><!-- end work_nav -->
            <h1 class="title">Modifier le nom d'utilisateur</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content contentAdmin">
            <h3>Modification de votre nom d'utilisateur</h3>
            <form action="profiladmin/modifierUtilisateur" method="POST">
                <input id="inlineInput" type="text" name="nvNomUtilisateur" value="<?= $this->nettoyageFailles($infoUtilisateur['login']) ?>"/>
                <input type="hidden" name="idUtilisateur" value="<?= $this->nettoyageFailles($infoUtilisateur['id']) ?>" />
                <input id="inlineButton" type="submit" value="Modifier" />
            </form>
        </div><!-- end content -->
    </section>
</section><!-- end main -->