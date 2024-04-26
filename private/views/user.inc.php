<?php
$image = get_image($row->image, $row->gender);
?>
<div class="card col-3 shadow rounded m-4 border p-0" style="min-width:13rem; max-width: 13rem;">
    <img src="<?= $image ?>" alt="avatar du genre de la personne" class="card-img-top rounded-circle w-75 d-block mx-auto mt-1">
    <div class="card-body">
        <center>
            <h6 class="card-title"><?= strtoupper($row->lastname) ?> <?= $row->firstname ?> </h6>
            <?php if ($row->ranks != 'Étudiant.e') : ?>
                <p class="card-text"><?= str_replace("_", " ", $row->ranks) ?></p>
            <?php endif; ?>
        </center>
        <a href="<?= ROOT ?>/profile/<?= $row->user_id ?>" class="btn btn-primary w-100 my-2"><i class="fa fa-id-card me-2"></i>Profil</a>

        <?php if (isset($_GET['select'])) : ?>
            <button name="selected" value="<?= $row->user_id ?>" class="float-end btn btn-danger w-100">Sélection</button>
        <?php endif; ?>
    </div>
</div>