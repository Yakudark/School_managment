<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <?php if ($row) : ?>

        <?php
        $image = get_image($row->image, $row->gender);
        ?>

        <div class="row">
            <div class="col-sm-4 col-md-3">
                <img src="<?= $image ?>" alt="avatar du genre féminin" class="d-block mx-auto rounded-circle border border-primary" style="width:100px;">
                <h3 class="text-center"><?= esc($row->firstname) ?> <?= esc($row->lastname) ?></h3>
                <br>
                <?php if (Auth::access('Réceptionniste') || Auth::i_own_content($row)) : ?>
                    <div class="text-center">
                        <a href="<?= ROOT ?>/profile/edit/<?= $row->user_id ?>">
                            <button class="btn btn-sm btn-success"><i class="fa-solid fa-pen mx-1"></i>Modifier</button>
                        </a>
                        <a href="<?= ROOT ?>/profile/delete/<?= $row->user_id ?>">
                            <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash mx-1"></i>Supprimer</button>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-sm-8 col-md-9 p-2 bg-light">
                <table class="table table-hover table-striped table-bordered">
                    <tr>
                        <th>Nom: </th>
                        <td><?= esc($row->firstname) ?></td>
                    </tr>
                    <tr>
                        <th>Prénom: </th>
                        <td><?= esc($row->lastname) ?></td>
                    </tr>
                    <tr>
                        <th>Email: </th>
                        <td><?= esc($row->email) ?></td>
                    </tr>
                    <tr>
                        <th>Genre: </th>
                        <td><?= esc($row->gender) ?></td>
                    </tr>
                    <tr>
                        <th>Statut: </th>
                        <td><?= esc($row->ranks) ?></td>
                    </tr>
                    <tr>
                        <th>Date d'inscription: </th>
                        <td><?= get_date($row->date) ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <hr>
        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'info' ? 'active' : ''; ?>" href="<?= ROOT ?>/profile/<?= $row->user_id ?>">Informations</a>
                </li>

                <?php if (Auth::access('Enseignant.e') || Auth::i_own_content($row)) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $page_tab == 'classes' ? 'active' : ''; ?>" href="<?= ROOT ?>/profile/<?= $row->user_id ?>?tab=classes">Mes cours</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page_tab == 'tests' ? 'active' : ''; ?>" href="<?= ROOT ?>/profile/<?= $row->user_id ?>?tab=tests">Évaluations</a>
                    </li>
                <?php endif; ?>

            </ul>

            <?php
            switch ($page_tab) {
                case 'info':
                    include(views_path('profile-tab-info'));
                    break;

                case 'classes':
                    if (Auth::access('Enseignant.e') || Auth::i_own_content($row)) {
                        include(views_path('profile-tab-classes'));
                    } else {
                        include(views_path('access-denied'));
                    }
                    break;

                case 'tests':
                    if (Auth::access('Enseignant.e') || Auth::i_own_content($row)) {
                        include(views_path('profile-tab-tests'));
                    } else {
                        include(views_path('access-denied'));
                    }
                    break;

                default:
                    break;
            }
            ?>

        </div>
    <?php else : ?>
        <div class="alert alert-danger text-center">Ce profil n'existe pas !</div>
    <?php endif ?>
</div>

<?php $this->view('includes/footer') ?>