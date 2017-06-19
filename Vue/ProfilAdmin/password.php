<?php $this->titre = "Jean Forteroche - Modifier le mot de passe"?>

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
            <h1 class="title">Modifier le mot de passe</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content" style="margin-right: auto; margin-left: auto; text-align: center">
            <h3>Modification de votre mot de passe</h3>
            <?= $messageErreur ?>
            <form action="profiladmin/modifierPassword" method="POST">
                <p>Saisissez votre ancien mot de passe</p>
                <input style="display:inline-block; width: 80%" type="password" name="ancienPassword" required/>
                <p>Saisissez votre nouveau mot de passe</p>
                <input style="display:inline-block; width: 80%" type="password" name="nvPassword" required/>
                <p>Saisissez votre nouveau mot de passe (pour être sûr)</p>
                <input style="display:inline-block; width: 80%" type="password" name="nvPasswordVerif" required/>
                <input style=" width: 80px; cursor: pointer;" type="submit" value="Modifier" />
            </form>
        </div><!-- end content -->
    </section>

</section><!-- end main -->