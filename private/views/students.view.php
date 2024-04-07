<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" class="form-control" placeholder="Rechercher" aria-label="Rechercher" aria-describedby="basic-addon1">
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
                $image = get_image($row->image, $row->gender);
                ?>


                <div class="card m-2 shadow-sm" style="min-width:14rem; max-width: 14rem;">
                    <div class="card-header text-center">Profil d'utilisateur</div>
                    <img src="<?= $image ?>" alt="avatar du genre de la personne" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row->firstname ?> <?= $row->lastname ?></h5>
                        <p class="card-text"><?= str_replace("_", " ", $row->ranks) ?></p>
                        <a href="<?= ROOT ?>/profile/<?= $row->user_id ?>" class="btn btn-primary">Profil</a>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else : ?>
            <div class="alert alert-warning" role="alert">
                Aucun utilisateur trouvé
            </div>

        <?php endif; ?>

    </div>
</div>
<?php $this->view('includes/footer') ?>