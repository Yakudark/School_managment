<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <h5 class="text-center">Discipline</h5>
    <nav class="navbar navbar-light">
        <form class="form-inline">
            <div class="input-group ms-2">
                <button class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input name="find" value="<?= isset($_GET['find']) ? $_GET['find'] : ''; ?>" type="text" class="form-control" placeholder="Rechercher" aria-label="Rechercher" aria-describedby="basic-addon1">
            </div>
        </form>
        <?php if (Auth::access('Enseignant.e')) : ?>
            <a href="<?= ROOT ?>/classes/add">
                <button class="btn btn-sm btn-primary me-2"><i class="icon-fa fa fa-plus"></i>Ajouter un discipline</button>
            </a>
        <?php endif; ?>
    </nav>
    <?php include(views_path('classes')) ?>

</div>
<?php $this->view('includes/footer') ?>