<?php $this->titre  = "Jean Forteroche - Gerer les catégories"?>

<?php include 'Vue/nav.php'?>

<section class="main clearfix">
    <section class="top" style="background: url(Contenu/img/Design-tips-ebook-1-1032x581.png), no-repeat, center, fixed; background-size: cover">
        <div class="wrapper content_header clearfix infoCategorie">
            <div class="work_nav">
                <ul class="btn clearfix">
                    <li><a href="admin" class="previous" data-title="Retour"></a></li>
                </ul>
            </div><!-- end work_nav -->
            <h1 class="title">Gerer les catégories</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content" style="margin-right: auto; margin-left: auto;">
            <h3>Créer une nouvelle catégorie</h3>
            <?= $messageConfirmation?>
            <form action="categorieAdmin/creer" method="POST">
                <label for="nvCategorie">Indiquez le nom de votre catégorie</label><br/>
                <input type="text" name="nvCategorie" id="nvCategorie" required/>
                <label for="categorieURLPres">URL de l'image de présentation de la catatégorie<br/>
                    <strong>Attention : </strong> l'image doit avoir une taille d'environ <strong>1300x500px</strong> sous peine d'avoir des problèmes d'affichage.<br/>
                </label>
                <input type="text" id="categorieURLPres" name="categorieURLPres" placeholder="Une image par défaut sera généré si vous n'en avez pas" />
                <input style="display:inline-block; width: 80px; cursor: pointer;" type="submit" value="Créer">
            </form>
            <?php if ($categories->rowCount()) : ?>
            <h3>Catégories existante</h3>
                <div id="demo">
                    <!-- Responsive table starts here -->
                    <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
                    <div class="table-responsive-vertical shadow-z-1">
                        <!-- Table starts here -->
                        <table id="table" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Categories</th>
                                <th>Articles associés</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($categories AS $categorie) : ?>
                                <tr>
                                    <td data-title="Categories"><?= $this->nettoyageFailles($categorie['categorie']); ?></td>
                                    <td data-title="Articles associés"><?= $categorie['nbArticles']; ?></td>
                                    <td data-title="Action">
                                        <a href="<?= "categorieAdmin/modification/" . $categorie['id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Modifier</a> /
                                        <a href="<?= "categorieAdmin/suppression/" . $categorie['id'] ?>" style="color: red;"><i class="fa fa-times" aria-hidden="true"></i> Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else : ?>
                <p>Aucune catégories n'a été créer</p>
            <?php endif; ?>
        </div><!-- end content -->
    </section>

</section><!-- end main -->