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