<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <?php if ($row) : ?>

        <div class="row">
            <center>
                <h4><?= esc(ucwords($row->class)) ?></h4>
            </center>
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <th>Créé par:</th>
                    <td><?= esc($row->user->firstname) ?> <?= esc($row->user->lastname) ?></td>
                    <th>Date:</th>
                    <td><?= get_date($row->date) ?></td>
                </tr>

            </table>
        </div>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link <?= $page_tab == 'Enseignant.e' ? 'active' : ''; ?> " href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=lecturers">Enseignant.e</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page_tab == 'Étudiant.e' ? 'active' : ''; ?> " href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=students">Étudiant.e</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $page_tab == 'Évaluations' ? 'active' : ''; ?> " href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests">Évaluations</a>
            </li>
        </ul>



        <?php
        switch ($page_tab) {
            case 'lecturers':
                include(views_path('class-tab-lecturers'));
                break;

            case 'students':
                include(views_path('class-tab-students'));
                break;

            case 'tests':
                include(views_path('class-tab-tests'));
                break;

            case 'lecturers-add':
                include(views_path('class-tab-lecturers-add'));
                break;

            case 'students-add':
                include(views_path('class-tab-students-add'));
                break;

            case 'tests-add':
                include(views_path('class-tab-tests-add'));
                break;

            default:
                break;
        }
        ?>

    <?php else : ?>
        <div class="alert alert-danger text-center">Cette discipline n'existe pas !</div>
    <?php endif ?>
</div>

<?php $this->view('includes/footer') ?>