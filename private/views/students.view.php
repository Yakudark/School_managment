<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <div class="input-group">
                <button class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></button>
                <input name="find" value="<?= isset($_GET['find']) ? $_GET['find'] : ''; ?>" type="text" class="form-control" placeholder="Rechercher" aria-label="Rechercher" aria-describedby="basic-addon1">
            </div>
        </form>
        <a href="<?= ROOT ?>/signup?mode=students">
            <button class="btn btn-sm btn-primary"><i class="icon-fa fa fa-plus"></i>Ajouter un étudiant</button>
        </a>
    </nav>

    <div class="card-group justify-content-center ">

        <?php if ($rows) : ?>
            <?php
            foreach ($rows as $row) : ?>

                <?php
                include(views_path('user'));
                ?>

            <?php endforeach; ?>

        <?php else : ?>
            <div class="alert alert-warning" role="alert">
                Aucun utilisateur trouvé
            </div>

        <?php endif; ?>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="#">Précédent</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Suivant</a></li>
        </ul>
    </nav>

</div>
<?php $this->view('includes/footer') ?>