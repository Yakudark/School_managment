<?php
$image = get_image($row->image, $row->gender);
?>
<div class="card-wrapper col-3 m-4 p-0" style="min-width:14rem; max-width: 14rem;">
    <div class="cards">
        <div class="image-content">
            <span class="overlay <?= $row->ranks == 'Étudiant.e' ? 'bg-primary' : 'bg-success' ?>"></span>
            <div class="card-image">
                <img src="<?= $image ?>" alt="avatar du genre de la personne" class="card-img">
            </div>
        </div>
        <div class="card-content">
            <center>
                <h6 class="card-title text-dark"><?= strtoupper($row->lastname) ?> <?= $row->firstname ?> </h6>
                <?php if ($row->ranks != 'Étudiant.e') : ?>
                    <p class="card-text text-dark"><?= str_replace("_", " ", $row->ranks) ?></p>
                <?php endif; ?>
            </center>
            <div class="mb-4">
                <a href="<?= ROOT ?>/profile/<?= $row->user_id ?>" class="btn me-2 <?= $row->ranks == 'Étudiant.e' ? 'btn-primary' : 'btn-success' ?> <?= !isset($_GET['select']) ? 'w-100' : 'ms-1' ?>"><i class="fa fa-id-card me-1"></i>Profil</a>
                <?php if (isset($_GET['select'])) : ?>
                    <button name="selected" value="<?= $row->user_id ?>" class="float-end btn btn-danger">Sélection</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>