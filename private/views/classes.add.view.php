<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
<?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <div class="card-group justify-content-center ">

        <form method="post">
            <h3>Ajouter une nouvelle discipline</h3>
            <?php if (count($errors) > 0) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><i class="fa-solid fa-triangle-exclamation"></i> Erreurs :</strong>

                    <?php foreach ($errors as $error) : ?>
                        <br> <?= $error ?>
                    <?php endforeach; ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <input autofocus class="form-control" value="<?= get_var('class') ?>" type="text" name="class" placeholder="Nom de la discipline"><br><br>
            <input class="btn btn-primary float-end" type="submit" value="Ajouter">
            <a href="<?= ROOT ?>/classes">
                <input class="btn btn-danger text-white" type="button" value="Annuler">
            </a>
        </form>

    </div>
</div>
<?php $this->view('includes/footer') ?>