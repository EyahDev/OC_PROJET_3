<?php $this->titre  = "Jean Forteroche - Administration : Connexion"?>

<?php include 'Vue/nav.php'?>

<section class="main clearfix">

    <section class="top bgAdmin">
        <div class="wrapper content_header clearfix">
            <div class="work_nav">

            </div><!-- end work_nav -->
            <div class="infoBillet">
                <h1 class="title">Administration</h1>
            </div>
        </div>
    </section><!-- end top -->
    <section class="wrapper">
        <div class="content contentAdmin">
            <p>Vous devez être connecté pour accèder à cette zone, veuillez vous indentifier.</p>
            <?= $messageErreur ?>
            <form action="connexion/connecter" method="POST">
                <input type="text" name="login" placeholder="Entrez votre login" required autofocus />
                <input type="password" name="password" placeholder="Entrez votre mot de passe" required />
                <button class="buttonRepondre" type="submit">Connexion</button>
            </form>
        </div><!-- end content -->
    </section>
</section><!-- end main -->