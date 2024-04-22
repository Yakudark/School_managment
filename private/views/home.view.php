<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<style>
    h1 {
        font-size: 80px;
        color: limegreen;
    }

    .card-header {
        font-weight: bold;
    }

    .card {
        min-width: 250px;
    }
</style>


<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <div class="row justify-content-center">

        <?php if (Auth::access('Super Administrateur.trice')) : ?>
            <a href="<?= ROOT ?>/schools" class="card col-3 shadow rounded m-4 border p-0">
                <div class="card-header">ÉCOLES</div>
                <h1 class="text-center">
                    <i class="fa fa-graduation-cap"></i>
                </h1>
                <div class="card-footer">Voir toutes les écoles</div>
            </a>
        <?php endif; ?>

        <?php if (Auth::access('Administrateur.trice')) : ?>
            <a href="<?= ROOT ?>/users" class="card col-3 shadow rounded m-4 border p-0">
                <div class="card-header">PERSONNELS</div>
                <h1 class="text-center">
                    <i class="fa fa-chalkboard-teacher"></i>
                </h1>
                <div class="card-footer">Voir tout le personnel</div>
            </a>
        <?php endif; ?>

        <?php if (Auth::access('Réceptionniste')) : ?>
            <a href="<?= ROOT ?>/students" class="card col-3 shadow rounded m-4 border p-0">
                <div class="card-header">ÉLÈVES</div>
                <h1 class="text-center">
                    <i class="fa fa-user-graduate"></i>
                </h1>
                <div class="card-footer">Voir tous les élèves</div>
            </a>
        <?php endif; ?>

        <a href="<?= ROOT ?>/classes" class="card col-3 shadow rounded m-4 border p-0">
            <div class="card-header">COURS</div>
            <h1 class="text-center">
                <i class="fa fa-university"></i>
            </h1>
            <div class="card-footer">Voir toutes les cours</div>
        </a>

        <a href="<?= ROOT ?>/tests" class="card col-3 shadow rounded m-4 border p-0">
            <div class="card-header">TESTS</div>
            <h1 class="text-center">
                <i class="fa fa-file-signature"></i>
            </h1>
            <div class="card-footer">Voir tous les tests</div>
        </a>

        <?php if (Auth::access('Administrateur.trice')) : ?>
            <a href="<?= ROOT ?>/statistics" class="card col-3 shadow rounded m-4 border p-0">
                <div class="card-header">STATISTIQUES</div>
                <h1 class="text-center">
                    <i class="fa fa-chart-pie"></i>
                </h1>
                <div class="card-footer">Voir tous les statistiques</div>
            </a>
        <?php endif; ?>

        <a href="<?= ROOT ?>/profile" class="card col-3 shadow rounded m-4 border p-0">
            <div class="card-header">PROFIL</div>
            <h1 class="text-center">
                <i class="fa fa-id-card"></i>
            </h1>
            <div class="card-footer">Consulter votre profil</div>
        </a>

        <a href="<?= ROOT ?>/settings" class="card col-3 shadow rounded m-4 border p-0">
            <div class="card-header">PARAMÈTRES</div>
            <h1 class="text-center">
                <i class="fa fa-cogs"></i>
            </h1>
            <div class="card-footer">Voir les paramètres</div>
        </a>

        <a href="<?= ROOT ?>/logout" class="card col-3 shadow rounded m-4 border p-0">
            <div class="card-header">DÉCONNEXION</div>
            <h1 class="text-center">
                <i class="fa fa-sign-out-alt"></i>
            </h1>
            <div class="card-footer">Se déconnecter</div>
        </a>

    </div>
</div>

<?php $this->view('includes/footer') ?>