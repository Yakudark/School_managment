<form method="post" class="form mx-auto" style="width:100% ;max-width:400px">
    <h4 class="mt-2">Ajouter un.e étudiant.e</h4>

    <?php if (count($errors) > 0) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong><i class="fa-solid fa-triangle-exclamation"></i> Erreurs :</strong>

            <?php foreach ($errors as $error) : ?>
                <br> <?= $error ?>
            <?php endforeach; ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <input value="<?= get_var('name') ?>" autofocus class="form-control" type="text" name="name" placeholder="Nom de l'étudiant.e">

    <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=students">
        <button type='button' class="btn btn-danger mt-3">Annuler</button>
    </a>

    <button class="btn btn-primary mt-3 float-end" name="search">Recherche</button>

    <div class="clearfix"></div>
</form>

<form method="post">
    <div class="card-group justify-content-center">

        <?php if (isset($results) && ($results)) : ?>

            <?php foreach ($results as $row) : ?>

                <?php include(views_path('user')) ?>
            <?php endforeach; ?>

        <?php else : ?>
            <?php if (count($_POST) > 0) : ?>
                <div class="alert alert-warning mt-4" role="alert">
                    Aucun utilisateur trouvé
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</form>