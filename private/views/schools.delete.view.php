<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
<?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <div class="d-flex flex-column align-items-center">

        <?php if ($row) : ?>
            <form method="post">
                <h3>Êtes-vous sûre de vouloir supprimer cette école !? </h3>

                <input disabled autofocus class="form-control" value="<?= get_var('school', $row[0]->school) ?>" type="text" name="school" placeholder="Nom de l'école"><br><br>

                <input type="hidden" name="id">
                <input class="btn btn-danger text-white float-end" type="submit" value="Supprimer">
                <a href="<?= ROOT ?>/schools">
                    <input class="btn btn-success text-white" type="button" value="Annuler">
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