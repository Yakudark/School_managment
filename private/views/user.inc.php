<?php
$image = get_image($row->image, $row->gender);
?>
<div class="card m-2 shadow-sm" style="min-width:12rem; max-width: 12rem;">
    <img src="<?= $image ?>" alt="avatar du genre de la personne" class="card-img-top rounded-circle w-75 d-block mx-auto mt-1">
    <div class="card-body">
        <center>
            <h6 class="card-title"><?= $row->firstname ?> <?= $row->lastname ?></h6>
            <p class="card-text"><?= str_replace("_", " ", $row->ranks) ?></p>
        </center>
        <a href="<?= ROOT ?>/profile/<?= $row->user_id ?>" class="btn btn-primary">Profil</a>

        <?php if (isset($_GET['select'])) : ?>
            <button name="selected" value="<?= $row->user_id ?>" class="float-end btn btn-danger">Sélection</button>
        <?php endif; ?>
    </div>
</div>