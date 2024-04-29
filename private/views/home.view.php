<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<style>
    h1 {
        font-size: 80px;
        color: limegreen;
    }

    a {
        text-decoration: none;
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

        <?php if (Auth::access('Super Admin')) : ?>
            <a href="<?= ROOT ?>/schools" class="card cards col-3 shadow rounded m-4 border p-0 db-courses-item_link">
                <div class="db-courses-item_bg"></div>
                <div class="db-courses-item_title text-center z-2 text-dark">
                    ÉCOLES
                    <h1 class="text-center">
                        <i class="fa fa-graduation-cap"></i>
                    </h1>
                </div>
                <div class="db-courses-item_sub text-center z-2 text-dark">
                    Voir toutes les écoles
                </div>
            </a>
        <?php endif; ?>

        <?php if (Auth::access('Super Admin')) : ?>
            <a href="<?= ROOT ?>/users" class="card cards col-3 shadow rounded m-4 border p-0 db-courses-item_link">
                <div class="db-courses-item_bg"></div>
                <div class="db-courses-item_title text-center z-2 text-dark">
                    PERSONNELS
                    <h1 class="text-center">
                        <i class="fa fa-chalkboard-teacher"></i>
                    </h1>
                </div>
                <div class="db-courses-item_sub text-center z-2 text-dark">
                    Voir tout le personnel
                </div>
            </a>
        <?php endif; ?>

        <?php if (Auth::access('Réceptionniste')) : ?>
            <a href="<?= ROOT ?>/students" class="card cards col-3 shadow rounded m-4 border p-0 db-courses-item_link">
                <div class="db-courses-item_bg"></div>
                <div class="db-courses-item_title text-center z-2 text-dark">
                    ÉTUDIANTS
                    <h1 class="text-center">
                        <i class="fa fa-user-graduate"></i>
                    </h1>
                </div>
                <div class="db-courses-item_sub text-center z-2 text-dark">
                    Voir tous les étudiants
                </div>
            </a>
        <?php endif; ?>

        <a href="<?= ROOT ?>/classes" class="card cards col-3 shadow rounded m-4 border p-0 db-courses-item_link">
            <div class="db-courses-item_bg"></div>
            <div class="db-courses-item_title text-center z-2 text-dark">
                DISCIPLINES
                <h1 class="text-center">
                    <i class="fa fa-university"></i>
                </h1>
            </div>
            <div class="db-courses-item_sub text-center z-2 text-dark">
                Voir toutes les disciplines
            </div>
        </a>

        <a href="<?= ROOT ?>/tests" class="card cards col-3 shadow rounded m-4 border p-0 db-courses-item_link">
            <div class="db-courses-item_bg"></div>
            <div class="db-courses-item_title text-center z-2 text-dark">
                ÉVALUATIONS
                <h1 class="text-center">
                    <i class="fa fa-file-signature"></i>
                </h1>
            </div>
            <div class="db-courses-item_sub text-center z-2 text-dark">
                Voir tous les évaluations
            </div>
        </a>

        <?php if (Auth::access('Admin')) : ?>
            <a href="<?= ROOT ?>/statistics" class="card cards col-3 shadow rounded m-4 border p-0 db-courses-item_link">
                <div class="db-courses-item_bg"></div>
                <div class="db-courses-item_title text-center z-2 text-dark">
                    STATISTIQUES
                    <h1 class="text-center">
                        <i class="fa fa-chart-pie"></i>
                    </h1>
                </div>
                <div class="db-courses-item_sub text-center z-2 text-dark">
                    Voir tous les statistiques
                </div>
            </a>
        <?php endif; ?>

        <a href="<?= ROOT ?>/profile" class="card cards col-3 shadow rounded m-4 border p-0 db-courses-item_link">
            <div class="db-courses-item_bg"></div>
            <div class="db-courses-item_title text-center z-2 text-dark">
                PROFIL
                <h1 class="text-center">
                    <i class="fa fa-id-card"></i>
                </h1>
            </div>
            <div class="db-courses-item_sub text-center z-2 text-dark">
                Consulter votre profil
            </div>
        </a>

        <a href="<?= ROOT ?>/settings" class="card cards col-3 shadow rounded m-4 border p-0 db-courses-item_link">
            <div class="db-courses-item_bg"></div>
            <div class="db-courses-item_title text-center z-2 text-dark">
                PARAMÈTRES
                <h1 class="text-center">
                    <i class="fa fa-cogs"></i>
                </h1>
            </div>
            <div class="db-courses-item_sub text-center z-2 text-dark">
                Voir les paramètres
            </div>
        </a>

        <a href="<?= ROOT ?>/logout" class="card cards col-3 shadow rounded m-4 border p-0 db-courses-item_link">
            <div class="db-courses-item_bg"></div>
            <div class="db-courses-item_title text-center z-2 text-dark">
                DÉCONNEXION
                <h1 class="text-center">
                    <i class="fa fa-sign-out-alt"></i>
                </h1>
            </div>
            <div class="db-courses-item_sub text-center z-2 text-dark">
                Se déconnecter
            </div>
        </a>

    </div>
</div>

<?php $this->view('includes/footer') ?>