<?php $this->view('includes/header') ?>
<?php $this->view('includes/nav') ?>

<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php $this->view('includes/crumbs', ['crumbs' => $crumbs]) ?>

    <div class="card-group justify-content-center ">
        <h5>École <?= Auth::getSchool_name() ?></h5>

        <table class="table table-striped table-hover">
            <tr>
                <th></th>
                <th>École</th>
                <th>Créé par</th>
                <th>Date</th>
                <th>
                    <a href="<?= ROOT ?>/schools/add">
                        <button class="btn btn-sm btn-primary"><i class="icon-fa fa fa-plus"></i>Ajouter une école</button>
                    </a>
                </th>
            </tr>
            <?php if ($rows) : ?>
                <?php foreach ($rows as $row) : ?>

                    <tr>
                        <td></td>
                        <td><?= $row->school ?></td>
                        <td><?= $row->user->firstname ?> <?= $row->user->lastname ?></td>
                        <td><?= get_date($row->date) ?></td>
                        <td>
                            <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= ROOT ?>/schools/edit/<?= $row->id ?>" title="Modifier l'école">
                                <button class="btn btn-sm btn-info text-white"><i class="fa fa-edit"></i></button>
                            </a>
                            <a class="link-offset-2 link-underline link-underline-opacity-0" href="<?= ROOT ?>/schools/delete/<?= $row->id ?>" title="Supprimer l'école">
                                <button class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </a>

                            <!-- Bouton super admin -->

                            <a href="<?= ROOT ?>/switch_school/<?= $row->id ?>" title="Changer d'école">
                                <button class="btn btn-sm  btn-success"><i class="fa-solid fa-school"></i><i class="mx-1 fa-solid fa-repeat"></i><i class="fa-solid fa-school"></i></button>
                            </a>


                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php else : ?>
                <h4>Aucune école trouvée</h4>
            <?php endif; ?>
        </table>
    </div>
</div>
<?php $this->view('includes/footer') ?>