<?php $this->view('includes/header') ?>

<div class="container-fluid">

    <form method="POST">


        <div class="p-4 mt-5 mx-auto shadow rounded" style="width:100%; max-width: 340px;">
            <h2 class="text-center">Mon école</h2>
            <img src="assets/graduate.png" alt="logo des écoles" class="d-block mx-auto" style="width:100px">
            <h3>Se connecter</h3>
            <?php if (count($errors) > 0) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong><i class="fa-solid fa-triangle-exclamation"></i> Erreurs :</strong>

                    <?php foreach ($errors as $error) : ?>
                        <br> <?= $error ?>
                    <?php endforeach; ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>


            <input class="form-control mt-2" value="<?= get_var('email') ?>" type="email" name="email" placeholder="Email" autofocus>
            <input class="form-control mt-2" value="<?= get_var('password') ?>" type="password" name="password" placeholder="Mot de passe">

            <button class="btn btn-primary mt-4">Se connecter</button>
        </div>
    </form>
</div>

<?php $this->view('includes/footer') ?>