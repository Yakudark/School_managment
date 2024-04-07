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
                <option <?= get_select('gender', 'Homme') ?> value="Homme">Homme</option>
                <option <?= get_select('gender', 'Femme') ?> value="Femme">Femme</option>
            </select>

            <?php if ($mode == 'students') : ?>
                <input type="hidden" value="Étudiant.e" name="ranks" class="mt-2 form-control">

            <?php else : ?>
                <select class="mt-2 form-control" name="ranks">
                    <option <?= get_select('ranks', '') ?> value="">--Sélectionner un statut--</option>
                    <option <?= get_select('ranks', 'Étudiant.e') ?> value="Étudiant.e">Étudiant.e</option>
                    <option <?= get_select('ranks', 'Réceptionniste') ?> value="Réceptionniste">Réceptionniste</option>
                    <option <?= get_select('ranks', 'Enseignant.e') ?> value="Enseignant.e">Enseignant.e</option>
                    <option <?= get_select('ranks', 'Administrateur.trice') ?> value="Administrateur.trice">Administrateur.trice</option>

                    <?php if (Auth::getRanks() == 'super_admin') : ?>
                        <option <?= get_select('ranks', 'Super Administrateur.trice') ?> value="Super Administrateur.trice">Super Administrateur.trice</option>
                    <?php endif; ?>

                </select>
            <?php endif; ?>


            <input class="form-control mt-2" <?= get_var('password') ?> type="text" name="password" placeholder="Mot de passe">
            <input class="form-control mt-2" <?= get_var('password2') ?> type="text" name="password2" placeholder="Ressaisisser le mot de passe">

            <button class="btn btn-primary mt-4 float-end ">Enregistrer</button>

            <?php if ($mode == 'students') : ?>
                <a href="<?= ROOT ?>/students">
                    <button type="button" class="btn btn-danger mt-4 text-white">Annuler</button>
                </a>
            <?php else : ?>
                <a href="<?= ROOT ?>/users">
                    <button type="button" class="btn btn-danger mt-4 text-white">Annuler</button>
                </a>
            <?php endif; ?>

        </div>
    </form>
</div>

<?php $this->view('includes/footer') ?>