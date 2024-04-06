<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs') ?>

    <a href="<?= ROOT ?>/signup">
        <button class="btn btn-sm btn-primary"><i class="icon-fa fa fa-plus"></i>Ajouter un utilisateur</button>
    </a>

    <div class="card-group justify-content-center ">
        <?php if ($rows) : ?>
            <?php
            foreach ($rows as $row) : ?>
                <div class="card m-2 shadow-sm" style="min-width:14rem; max-width: 14rem;">
                    <div class="card-header text-center">Profil d'utilisateur</div>
                    <img src="<?= ROOT ?>/assets/female.png" alt="avatar du genre féminin" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row->firstname ?> <?= $row->lastname ?></h5>
                        <p class="card-text"><?= str_replace("_", " ", $row->ranks) ?></p>
                        <a href="#" class="btn btn-primary">Profil</a>
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