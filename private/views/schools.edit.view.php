<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
<?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <div class="d-flex flex-column align-items-center">

        <?php if ($row) : ?>
            <form method="post">
                <h3>Modifier une école</h3>

                <?php if (count($errors) > 0) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><i class="fa-solid fa-triangle-exclamation"></i> Erreurs :</strong>

                        <?php foreach ($errors as $error) : ?>
                            <br> <?= $error ?>
                        <?php endforeach; ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <input autofocus class="form-control" value="<?= get_var('school', $row[0]->school) ?>" type="text" name="school" placeholder="Nom de l'école"><br><br>
                <input class="btn btn-primary float-end" type="submit" value="Valider">
                <a href="<?= ROOT ?>/schools">
                    <input class="btn btn-danger text-white" type="button" value="Annuler">
                </a>
            </form>
        <?php else : ?>
            <h3>L'école n'existe pas !</h3>

            <a href="<?= ROOT ?>/schools">
                <input class="btn btn-danger text-white" type="button" value="Retour">
            </a>

        <?php endif; ?>

    </div>
</div>
<?php $this->view('includes/footer') ?>


