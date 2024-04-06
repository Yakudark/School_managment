<?php $this->view('includes/header') ?>

<div class="container-fluid">
    <form method="POST">
        <div class="p-4 mt-5 mx-auto shadow rounded" style="width:100%; max-width: 340px;">
            <h2 class="text-center">Mon école</h2>

            <img src="<?= ROOT ?>/assets/graduate.png" alt="logo des écoles" class="d-block mx-auto" style="width:100px">
            <h3>Créer un compte</h3>

            <?php if (count($errors) > 0) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><i class="fa-solid fa-triangle-exclamation"></i> Erreurs :</strong>

                    <?php foreach ($errors as $error) : ?>
                        <br> <?= $error ?>
                    <?php endforeach; ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <input class="form-control mt-2" value="<?= get_var("lastname") ?>" type="lastname" name="lastname" placeholder="Nom" autofocus>
            <input class="form-control mt-2" value="<?= get_var("firstname") ?>" type="firstname" name="firstname" placeholder="Prénom" autofocus>
            <input class="form-control mt-2" value="<?= get_var("email") ?>" type="email" name="email" placeholder="Email" autofocus>

            <select class="mt-2 form-control" name="gender">
                <option <?= get_select('gender', '') ?> value="">--Genre--</option>
                <option <?= get_select('gender', 'male') ?> value="male">Homme</option>
                <option <?= get_select('gender', 'female') ?> value="female">Femme</option>
                <option <?= get_select('gender', 'other') ?> value="other">Autre</option>
                <option <?= get_select('gender', 'wont') ?> value="wont">Ne pas renseigner</option>
            </select>
            <select class="mt-2 form-control" name="ranks">
                <option <?= get_select('ranks', '') ?> value="">--Sélectionner un role--</option>
                <option <?= get_select('ranks', 'student') ?> value="student">Étudiant.e</option>
                <option <?= get_select('ranks', 'reception') ?> value="reception">Réceptionniste</option>
                <option <?= get_select('ranks', 'lecturer') ?> value="lecturer">Enseignant.e</option>
                <option <?= get_select('ranks', 'admin') ?> value="admin">Administrateur.trice</option>

                <?php if (Auth::getRanks() == 'super_admin') : ?>
                    <option <?= get_select('ranks', 'super_admin') ?> value="super_admin">Super Administrateur.trice</option>
                <?php endif; ?>

            </select>

            <input class="form-control mt-2" <?= get_var('password') ?> type="text" name="password" placeholder="Mot de passe">
            <input class="form-control mt-2" <?= get_var('password2') ?> type="text" name="password2" placeholder="Ressaisisser le mot de passe">

            <button class="btn btn-primary mt-4 float-end ">Enregistrer</button>
            <a href="<?= ROOT ?>/users">
                <button type="button" class="btn btn-danger mt-4 text-white">Annuler</button>
            </a>
        </div>
    </form>
</div>

<?php $this->view('includes/footer') ?>