<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<style>
    h1 {
        font-size: 80px;
        color: limegreen;
    }
</style>


<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <div class="row justify-content-center ">

        <div class="col-3 shadow rounded m-4 border">
            <div class="card-header">ÉCOLES</div>
            <h1 class="text-center">
                <i class="fa fa-graduation-cap"></i>
            </h1>
            <div class="card-footer">Voir toutes les écoles</div>
        </div>

        <div class="col-3 shadow rounded m-4 border">
            <div class="card-header">PERSONNELS</div>
            <h1 class="text-center">
                <i class="fa fa-chalkboard-teacher"></i>
            </h1>
            <div class="card-footer">Voir tout le personnel</div>
        </div>

        <div class="col-3 shadow rounded m-4 border">
            <div class="card-header">ÉLÈVES</div>
            <h1 class="text-center">
                <i class="fa fa-user-graduate"></i>
            </h1>
            <div class="card-footer">Voir tous les élèves</div>
        </div>

        <div class="col-3 shadow rounded m-4 border">
            <div class="card-header">CLASSES</div>
            <h1 class="text-center">
                <i class="fa fa-university"></i>
            </h1>
            <div class="card-footer">Voir toutes les classes</div>
        </div>

        <div class="col-3 shadow rounded m-4 border">
            <div class="card-header">TESTS</div>
            <h1 class="text-center">
                <i class="fa fa-file-signature"></i>
            </h1>
            <div class="card-footer">Voir tous les tests</div>
        </div>

        <div class="col-3 shadow rounded m-4 border">
            <div class="card-header">STATISTIQUES</div>
            <h1 class="text-center">
                <i class="fa fa-chart-pie"></i>
            </h1>
            <div class="card-footer">Voir tous les statistiques</div>
        </div>

        <div class="col-3 shadow rounded m-4 border">
            <div class="card-header">PROFIL</div>
            <h1 class="text-center">
                <i class="fa fa-id-card"></i>
            </h1>
            <div class="card-footer">Consulter votre profil</div>
        </div>

        <div class="col-3 shadow rounded m-4 border">
            <div class="card-header">PARAMÈTRES</div>
            <h1 class="text-center">
                <i class="fa fa-cogs"></i>
            </h1>
            <div class="card-footer">Voir les paramètres</div>
        </div>

        <div class="col-3 shadow rounded m-4 border">
            <div class="card-header">DÉCONNEXION</div>
            <h1 class="text-center">
                <i class="fa fa-sign-out-alt"></i>
            </h1>
            <div class="card-footer">Se déconnecter</div>
        </div>

    </div>
</div>

<?php $this->view('includes/footer') ?>