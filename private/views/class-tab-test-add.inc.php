<div class="card-group justify-content-center ">

    <form method="post">
        <h3>Ajouter une nouvelle évaluation</h3>
        <?php if (count($errors) > 0) : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><i class="fa-solid fa-triangle-exclamation"></i> Erreurs :</strong>

                <?php foreach ($errors as $error) : ?>
                    <br> <?= $error ?>
                <?php endforeach; ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <input autofocus class="form-control mb-4" value="<?= get_var('test') ?>" type="text" name="test" placeholder="Nom de l'évaluation">

        <textarea name="description" class="form-control mb-2" placeholder="Ajouter une description de l'évaluation"><?= get_var('description') ?></textarea>
        <input class="btn btn-primary float-end" type="submit" value="Ajouter">
        <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests">
            <input class="btn btn-danger text-white" type="button" value="Annuler">
        </a>
    </form>

</div>