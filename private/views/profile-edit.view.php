<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <h2 class="text-center">Modifier le profil</h2>
    <?php if ($row) : ?>

        <?php
        $image = get_image($row->image, $row->gender);
        ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <img src="<?= $image ?>" alt="avatar du genre féminin" class="d-block mx-auto border" style="width:100px;">

                    <?php if (Auth::access('Réceptionniste') || Auth::i_own_content($row)) : ?>
                        <div class="text-center">
                            <label for="image_browser" class="btn btn-sm btn-success mt-4 mb-2"><i class="fa-solid fa-image me-1"></i>
                                <input onchange="display_image_name(this.files[0].name)" id="image_browser" type="file" name="image" style="display:none;">
                                Parcourir les images
                            </label>
                            <br>
                            <small class="file_info text-muted"></small>
                        </div>
                    <?php endif; ?>
                </div>
                <div class=" col-sm-8 p-2">
                    <div class="p-4 mt-5 mx-auto shadow rounded">

                        <?php if (count($errors) > 0) : ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-triangle-exclamation"></i> Erreurs :</strong>

                                <?php foreach ($errors as $error) : ?>
                                    <br> <?= $error ?>
                                <?php endforeach; ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>

                        <input class="form-control mt-2" value="<?= get_var("lastname", $row->lastname) ?>" type="lastname" name="lastname" placeholder="Nom" autofocus>
                        <input class="form-control mt-2" value="<?= get_var("firstname", $row->firstname) ?>" type="firstname" name="firstname" placeholder="Prénom" autofocus>
                        <input class="form-control mt-2" value="<?= get_var("email", $row->email) ?>" type="email" name="email" placeholder="Email" autofocus>

                        <select class="mt-2 form-control" name="gender">
                            <option <?= get_select('gender', $row->gender) ?> value="<?= $row->gender ?>"><?= ucwords($row->gender) ?></option>
                            <option <?= get_select('gender', 'Homme') ?> value="Homme">Homme</option>
                            <option <?= get_select('gender', 'Femme') ?> value="Femme">Femme</option>
                        </select>

                        <select class="mt-2 form-control" name="ranks">
                            <option <?= get_select('ranks', $row->ranks) ?> value="<?= $row->ranks ?>"><?= ucwords($row->ranks) ?></option>
                            <option <?= get_select('ranks', 'Étudiant.e') ?> value="Étudiant.e">Étudiant.e</option>
                            <option <?= get_select('ranks', 'Réceptionniste') ?> value="Réceptionniste">Réceptionniste</option>
                            <option <?= get_select('ranks', 'Enseignant.e') ?> value="Enseignant.e">Enseignant.e</option>
                            <option <?= get_select('ranks', 'Admin') ?> value="Admin">Admin</option>

                            <?php if (Auth::getRanks() == 'Super Admin') : ?>
                                <option <?= get_select('ranks', 'Super Admin') ?> value="Super Admin">Super Admin</option>
                            <?php endif; ?>

                        </select>

                        <input class="form-control mt-2" <?= get_var('password') ?> type="text" name="password" placeholder="Mot de passe">
                        <input class="form-control mt-2" <?= get_var('password2') ?> type="text" name="password2" placeholder="Ressaisisser le mot de passe">

                        <button class="float-end btn btn-sm btn-success mt-4"><i class="fa-solid fa-floppy-disk mx-1"></i>Enregistrer</button>

                        <a href="<?= ROOT ?>/profile/<?= $row->user_id ?>">
                            <button type="button" class="btn btn-sm btn-danger mt-4"><i class="fa-solid fa-rotate-left mx-1"></i>Retour au profil</button>
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <br>

    <?php else : ?>
        <div class="alert alert-danger text-center">Ce profil n'existe pas !</div>
    <?php endif ?>
</div>

<script>
    function display_image_name(file_name) {

        document.querySelector('.file_info').innerHTML = '<b>selected file:</b><br>' + file_name;

    }
</script>
<?php $this->view('includes/footer') ?>