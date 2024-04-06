<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs') ?>

    <div class="row">
        <div class="col-sm-4 col-md-3">
            <img src="<?=ROOT?>/assets/female.png" alt="avatar du genre féminin" class="d-block mx-auto rounded-circle border border-primary" style="width:100px;">
            <h3 class="text-center">Jane Doe</h3>
        </div>
        <div class="col-sm-8 col-md-9 p-2 bg-light">
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <th>Nom: </th>
                    <td>Doe</td>
                </tr>
                <tr>
                    <th>Prénom: </th>
                    <td>Jane</td>
                </tr>
                <tr>
                    <th>Genre: </th>
                    <td>Femme</td>
                </tr>
                <tr>
                    <th>Date d'inscription: </th>
                    <td>27/03/2024</td>
                </tr>
            </table>
        </div>
    </div>
    <hr>
    <div class="container-fluid">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Informations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Disciplines</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Évaluations</a>
            </li>

        </ul>

        <nav class="navbar navbar-light bg-light">
            <form class="form-inline">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control" placeholder="Rechercher" aria-label="Rechercher" aria-describedby="basic-addon1">
                </div>
            </form>
        </nav>

    </div>
</div>

<?php $this->view('includes/footer') ?>