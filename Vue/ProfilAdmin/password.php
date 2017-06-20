<?php $this->titre = "Jean Forteroche - Modifier le mot de passe"?>

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
            <h1 class="title">Modifier le mot de passe</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content contentAdmin">
            <h3>Modification de votre mot de passe</h3>
            <?= $messageErreur ?>
            <form action="profiladmin/modifierPassword" method="POST">
                <p>Saisissez votre ancien mot de passe</p>
                <input type="password" name="ancienPassword" required/>
                <p>Saisissez votre nouveau mot de passe</p>
                <input type="password" name="nvPassword" required/>
                <p>Saisissez votre nouveau mot de passe (pour être sûr)</p>
                <input type="password" name="nvPasswordVerif" required/>
                <button  class="buttonRepondre" type="submit" value="Modifier" />Modifier</button>
            </form>
        </div><!-- end content -->
    </section>

</section><!-- end main -->