<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <?php if ($row) : ?>

        <div class="row">
            <center>
                <h4><?= esc(ucwords($row->test)) ?></h4>
            </center>
            <table class="table table-hover table-striped table-bordered">
                <tr>
                    <th>Créé par:</th>
                    <td><?= esc($row->user->firstname) ?> <?= esc($row->user->lastname) ?></td>
                    <th>Date:</th>
                    <td><?= get_date($row->date) ?></td>
                    <td>
                        <a href="<?= ROOT ?>/single_class/<?= $row->class_id ?>?tab=tests">
                            <button class="btn btn-sm btn-primary"><i class="fa fa-chevron-right"></i> Voir la discipline</button>
                        </a>
                    </td>
                </tr>
                <?php $active = $row->disabled ? "Non" : "Oui"; ?>
                <tr>
                    <td><b>Active:</b> <?= $active ?></td>
                    <td colspan="5"><b>Desciption de l'évaluation:</b><br><?= esc($row->description) ?></td>
                </tr>
            </table>
        </div>
        <div class="container-fluid">


            <?php
            switch ($page_tab) {
                case 'view':
                    include(views_path('test-tab-view'));
                    break;

                    // case 'add-question':
                    //     include(views_path('test-tab-add-question'));
                    //     break;

                case 'add-subjective':
                    // code...
                    include(views_path('test-tab-add-subjective'));
                    break;

                case 'add-multiple':
                    // code...
                    include(views_path('test-tab-add-multiple'));
                    break;

                case 'add-objective':
                    // code...
                    include(views_path('test-tab-add-objective'));
                    break;

                case 'edit-question':
                    // code...
                    include(views_path('test-tab-edit-question'));
                    break;

                case 'delete-question':
                    // code...
                    include(views_path('test-tab-delete-question'));
                    break;

                case 'edit':
                    // code...
                    include(views_path('test-tab-edit'));
                    break;

                case 'delete':
                    // code...
                    include(views_path('test-tab-delete'));
                    break;

                default:
                    break;
            }
            ?>
        </div>
    <?php else : ?>
        <div class="alert alert-danger text-center">Cette évaluation n'existe pas !</div>
    <?php endif ?>
</div>

<?php $this->view('includes/footer') ?>