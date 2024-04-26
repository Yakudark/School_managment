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
        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'lecturers' ? 'active' : ''; ?> " href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=lecturers">Enseignant.e</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'students' ? 'active' : ''; ?> " href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=students">Étudiant.e</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page_tab == 'tests' ? 'active' : ''; ?> " href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests">Évaluations</a>
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

                case 'lecturer-add':
                    include(views_path('class-tab-lecturers-add'));
                    break;

                case 'lecturer-remove':
                    include(views_path('class-tab-lecturers-remove'));
                    break;

                case 'student-add':
                    include(views_path('class-tab-students-add'));
                    break;

                case 'student-remove':
                    include(views_path('class-tab-students-remove'));
                    break;

                case 'test-add':
                    include(views_path('class-tab-test-add'));
                    break;

                case 'test-edit':
                    include(views_path('class-tab-test-edit'));
                    break;

                case 'test-delete':
                    include(views_path('class-tab-test-delete'));
                    break;


                default:
                    break;
            }
            ?>
        </div>
    <?php else : ?>
        <div class="alert alert-danger text-center">Cette école n'existe pas !</div>
    <?php endif ?>
</div>

<?php $this->view('includes/footer') ?>